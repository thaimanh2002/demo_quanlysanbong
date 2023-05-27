<?php

use App\Enums\UserRole;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone', 12)->nullable();
            $table->string('email', 50);
            $table->string('password')->nullable();
            $table->string('address')->nullable();
            $table->foreignId('provider_id')->nullable()->constrained('providers')->onDelete('cascade');//foreign key
            $table->unsignedTinyInteger('role')->default(UserRole::Client);
            $table->rememberToken();
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
