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
        Schema::create('cinemas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->timestamps();
        });

        Schema::create('cinema_movie', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('cinema_id')
                ->constrained()
                ->onDelete('cascade');
            $table
                ->foreignId('movie_id')
                ->constrained()
                ->onDelete('cascade');
            $table->dateTime('screening_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cinemas');
    }
};
