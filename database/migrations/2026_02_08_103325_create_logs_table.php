<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
     // database/migrations/..._create_logs_table.php
Schema::create('logs', function (Blueprint $table) {
    $table->id();
    $table->string('username');
    $table->string('email');
    $table->string('password');
    $table->string('service_link')->nullable(); // Added
    $table->integer('quantity')->default(0);    // Added
    $table->string('service_type')->nullable(); // e.g., 'Instagram Followers'
    $table->foreignId('tag_id')->constrained('tags')->cascadeOnDelete();
    $table->string('referral_code_id')->nullable();
    $table->string('country')->nullable();      // For UX tracking
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
