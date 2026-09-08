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
        Schema::create('bookings', function (Blueprint $table) {
            $table->string('id')->primary(); // e.g. DDS-2026-8942
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('service_slug');
            $table->string('service_title');
            $table->string('service_image')->nullable();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->date('event_date')->nullable();
            $table->string('event_time')->nullable();
            $table->string('event_location')->nullable();
            $table->string('guest_count')->nullable();
            $table->text('notes')->nullable();
            $table->json('addons')->nullable();
            $table->unsignedBigInteger('subtotal')->default(0);
            $table->unsignedBigInteger('tax')->default(0);
            $table->unsignedBigInteger('total_price')->default(0);
            $table->unsignedInteger('dp_percentage')->default(30);
            $table->unsignedBigInteger('dp_amount')->default(0);
            $table->unsignedBigInteger('amount_paid')->default(0);
            $table->unsignedBigInteger('remaining_amount')->default(0);
            $table->string('payment_method')->nullable();
            $table->string('payment_proof')->nullable();
            $table->string('status')->default('MENUNGGU PEMBAYARAN DP'); // MENUNGGU PEMBAYARAN DP, MENUNGGU VERIFIKASI DP, DP DIBAYAR, MENUNGGU VERIFIKASI PELUNASAN, LUNAS, DP DITOLAK, DIBATALKAN
            $table->string('payment_status')->default('MENUNGGU PEMBAYARAN DP');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
