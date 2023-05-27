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
        Schema::create('football_pitch_details', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->foreignId('football_pitch_id')->constrained('football_pitches')->onDelete('cascade');//foreign key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('football_pitch_details');
    }
};
