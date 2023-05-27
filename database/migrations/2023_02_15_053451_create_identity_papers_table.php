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
        Schema::create('identity_papers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->string('image');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');//foreign key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identity_papers');
    }
};
