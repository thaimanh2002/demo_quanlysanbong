<?php

use App\Enums\FootballPitchMaintenanceEnum;
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
        Schema::create('football_pitches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->time('time_start');
            $table->time('time_end');
            $table->string('description')->nullable();
            $table->unsignedDouble('price_per_hour');
            $table->unsignedDouble('price_per_peak_hour');
            $table->boolean('is_maintenance')->default(false);
            $table->foreignId('pitch_type_id')->constrained('pitch_types')->onDelete('cascade');//foreign key
            $table->foreignId('from_football_pitch_id')->nullable()->constrained('football_pitches')->onDelete('cascade');//foreign key
            $table->foreignId('to_football_pitch_id')->nullable()->constrained('football_pitches')->onDelete('cascade');//foreign key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('football_pitches');
    }
};
