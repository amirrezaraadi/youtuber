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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')
                ->nullable()
                ->unique();
            $table->enum('status', \App\Models\Manager\Tag::$status)
                ->default(\App\Models\Manager\Tag::STATUS_PENDING);
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
        Schema::create('taggable', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')
                ->nullable()
                ->unique();
            $table->enum('status', \App\Models\Manager\Tag::$status)
                ->default(\App\Models\Manager\Tag::STATUS_PENDING);
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
