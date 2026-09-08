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
        // Update bookings table with DP and Pelunasan fields if not exists
        if (Schema::hasTable('bookings')) {
            Schema::table('bookings', function (Blueprint $table) {
                if (!Schema::hasColumn('bookings', 'dp_percentage')) {
                    $table->unsignedInteger('dp_percentage')->default(30)->after('total_price');
                }
                if (!Schema::hasColumn('bookings', 'dp_amount')) {
                    $table->unsignedBigInteger('dp_amount')->default(0)->after('dp_percentage');
                }
                if (!Schema::hasColumn('bookings', 'amount_paid')) {
                    $table->unsignedBigInteger('amount_paid')->default(0)->after('dp_amount');
                }
                if (!Schema::hasColumn('bookings', 'remaining_amount')) {
                    $table->unsignedBigInteger('remaining_amount')->default(0)->after('amount_paid');
                }
                if (!Schema::hasColumn('bookings', 'payment_proof')) {
                    $table->string('payment_proof')->nullable()->after('payment_method');
                }
                if (!Schema::hasColumn('bookings', 'payment_status')) {
                    $table->string('payment_status')->default('MENUNGGU PEMBAYARAN DP')->after('status');
                }
            });
        }

        // Create payments table for multi-transaction tracking (DP & Pelunasan)
        if (!Schema::hasTable('payments')) {
            Schema::create('payments', function (Blueprint $table) {
                $table->id();
                $table->string('booking_id');
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('payment_type')->default('dp'); // 'dp' or 'pelunasan'
                $table->unsignedBigInteger('amount')->default(0);
                $table->string('payment_method')->default('QRIS Instant');
                $table->string('payment_proof')->nullable();
                $table->string('status')->default('MENUNGGU VERIFIKASI'); // MENUNGGU VERIFIKASI, TERVERIFIKASI, DITOLAK
                $table->text('notes')->nullable();
                $table->timestamp('paid_at')->nullable();
                $table->timestamp('verified_at')->nullable();
                $table->timestamps();

                $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');

        if (Schema::hasTable('bookings')) {
            Schema::table('bookings', function (Blueprint $table) {
                $columns = ['dp_percentage', 'dp_amount', 'amount_paid', 'remaining_amount', 'payment_proof', 'payment_status'];
                foreach ($columns as $column) {
                    if (Schema::hasColumn('bookings', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
    }
};
