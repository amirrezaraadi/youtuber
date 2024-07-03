<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('full_name')->nullable()->unique();
            $table->enum('status', \App\Models\User::$status)
                ->default(\App\Models\User::STATUS_NO_ACTIVE);
            $table->enum('state_status', \App\Models\User::$state_status)
                ->default(\App\Models\User::STATE_STATUS_NO_ACTIVE);
            $table->string('profile')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('website')->nullable();
            $table->longText('body')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
