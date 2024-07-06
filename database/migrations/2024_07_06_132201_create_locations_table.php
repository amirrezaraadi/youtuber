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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('latitude')
                ->nullable();
            $table->string('longitude')
                ->nullable();
            $table->string('building_number')
                ->nullable();
            $table->unsignedBigInteger('unit')
                ->nullable();
            $table->boolean("is_default")
                ->nullable()
                ->default(0);
            $table->string("mobile")
                ->nullable()
                ->unique();
            $table->string("telephone")
                ->nullable();
            $table->unsignedBigInteger("postal_code")
                ->nullable();
            $table->longText("address")
                ->nullable();
            $table->foreignId('province_id')
                ->constrained('provinces')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('city_id')
                ->constrained('cities')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
