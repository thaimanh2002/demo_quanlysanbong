<?php

use App\Enums\OrderStatusEnum;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone', 12)->nullable();
            $table->string('email', 50)->nullable();
            $table->unsignedDouble('deposit');
            $table->string('code', 20);
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->unsignedDouble('total');
            $table->unsignedTinyInteger('status')->default(OrderStatusEnum::Wait);
            $table->text('note')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');//foreign key
            $table->foreignId('football_pitch_id')->constrained('football_pitches')->onDelete('cascade');//foreign key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
