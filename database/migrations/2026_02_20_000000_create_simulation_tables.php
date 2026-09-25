<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Builds the security-awareness simulation schema.
 *
 * Design invariant, enforced at the schema level rather than by convention:
 * this platform must never be able to persist a credential that a participant
 * typed. `logs.password` existed as a plain string column and is dropped here.
 * Nothing in the new schema has a column capable of holding a secret value.
 * `simulation_events` records *that* a submission happened, never its contents.
 */
return new class extends Migration
{
    public function up(): void
    {
        // 1. Add the super_admin role to the existing enum.
        DB::statement(
            "ALTER TABLE users MODIFY COLUMN role ENUM('customer','user','admin','super_admin') NOT NULL DEFAULT 'user'"
        );

        // 2. Remove the credential column. Any code that tried to write it will
        //    now fail loudly instead of quietly harvesting a password.
        if (Schema::hasColumn('logs', 'password')) {
            Schema::table('logs', function (Blueprint $table) {
                $table->dropColumn('password');
            });
        }

        // 3. A campaign is a single authorized simulation exercise.
        if (! Schema::hasTable('campaigns')) {
            Schema::create('campaigns', function (Blueprint $table) {
                $table->id();

                // The admin who runs the campaign and sees its results.
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();

                $table->string('name');
                $table->string('slug')->unique();

                // Lure theme key (see config/lures.php). Never a real brand asset.
                $table->string('platform')->default('generic');

                $table->enum('status', ['draft', 'active', 'paused', 'completed'])->default('draft');

                // Authorization record. A campaign cannot be activated without it.
                $table->string('authorized_by')->nullable();
                $table->string('authorized_email')->nullable();
                $table->string('authorization_ref')->nullable();
                $table->text('scope')->nullable();
                $table->timestamp('authorized_at')->nullable();
                $table->timestamp('authorization_expires_at')->nullable();

                $table->timestamps();
            });
        }

        // 4. Only enrolled participants can ever be served a lure.
        if (! Schema::hasTable('campaign_targets')) {
            Schema::create('campaign_targets', function (Blueprint $table) {
                $table->id();
                $table->foreignId('campaign_id')->constrained()->cascadeOnDelete();

                $table->string('name');
                $table->string('email');
                $table->string('department')->nullable();

                // Unguessable per-participant token. Without it the simulation
                // is never served, so links cannot be sprayed at strangers.
                $table->string('token', 64)->unique();

                $table->timestamp('enrolled_at')->nullable();
                $table->timestamp('first_opened_at')->nullable();
                $table->timestamp('first_clicked_at')->nullable();
                $table->timestamp('submitted_at')->nullable();
                $table->timestamp('reported_at')->nullable();
                $table->timestamp('debrief_seen_at')->nullable();
                $table->timestamps();

                $table->unique(['campaign_id', 'email']);
            });
        }

        // 5. Append-only engagement log. Holds no submitted values, by design.
        if (! Schema::hasTable('simulation_events')) {
            Schema::create('simulation_events', function (Blueprint $table) {
                $table->id();
                $table->foreignId('campaign_id')->constrained()->cascadeOnDelete();
                $table->foreignId('campaign_target_id')->nullable()->constrained()->nullOnDelete();
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

                // sent | opened | clicked | submitted | reported | debrief_viewed
                $table->string('event_type', 32);

                $table->string('ip', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->json('meta')->nullable();
                $table->timestamps();

                $table->index(['campaign_id', 'event_type']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('simulation_events');
        Schema::dropIfExists('campaign_targets');
        Schema::dropIfExists('campaigns');

        // The dropped credential column is intentionally NOT restored: bringing
        // it back would restore the ability to store plaintext passwords.
        DB::statement(
            "ALTER TABLE users MODIFY COLUMN role ENUM('customer','user','admin') NOT NULL DEFAULT 'user'"
        );
    }
};
