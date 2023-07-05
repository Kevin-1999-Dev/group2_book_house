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
        Schema::create('ebook', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('cover')->nullable();
            $table->string('description')->nullable();
            $table->string('link');
            $table->integer('pagecount');
            $table->integer('price');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('author')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ebook');
    }
};
