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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('category');
            $table->unsignedBigInteger('price')->default(0);
            $table->string('price_formatted')->nullable();
            $table->string('image')->nullable();
            $table->string('location')->nullable();
            $table->string('rating')->nullable();
            $table->string('capacity')->nullable();
            $table->string('badge')->nullable();
            $table->text('description')->nullable();
            $table->json('highlights')->nullable();
            $table->json('addons')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
