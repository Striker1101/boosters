<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('ref_id')->nullable()->unique()->after('role');
        });

        Schema::table('logs', function (Blueprint $table) {
            $table->string('ref_id')->nullable()->index()->after('referral_code_id');
        });

        // Every admin / super admin needs a ref id so attempts can be attributed.
        DB::table('users')
            ->whereIn('role', ['admin', 'super_admin'])
            ->whereNull('ref_id')
            ->orderBy('id')
            ->pluck('id')
            ->each(function ($id) {
                DB::table('users')->where('id', $id)->update([
                    'ref_id' => $this->generateRefId(),
                ]);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logs', function (Blueprint $table) {
            $table->dropColumn('ref_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['ref_id']);
            $table->dropColumn('ref_id');
        });
    }

    /**
     * Build a unique, URL friendly ref id (e.g. "34a-890-asw").
     */
    private function generateRefId(): string
    {
        do {
            $refId = strtolower(Str::random(3)) . '-' . random_int(100, 999) . '-' . strtolower(Str::random(3));
        } while (DB::table('users')->where('ref_id', $refId)->exists());

        return $refId;
    }
};
