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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('twofactor')->nullable();
            $table->string('address');
            $table->string('image');
            $table->boolean('role');
            $table->boolean('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
