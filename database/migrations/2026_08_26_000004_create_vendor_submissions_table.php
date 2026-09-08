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
        Schema::create('vendor_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('category');
            $table->string('contact_person');
            $table->string('email');
            $table->string('phone');
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->string('price_range')->nullable();
            $table->string('status')->default('PENDING'); // PENDING, APPROVED, REJECTED
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_submissions');
    }
};
