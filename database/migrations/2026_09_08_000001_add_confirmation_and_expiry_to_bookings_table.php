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
        if (Schema::hasTable('bookings')) {
            Schema::table('bookings', function (Blueprint $table) {
                if (!Schema::hasColumn('bookings', 'confirmed_at')) {
                    $table->timestamp('confirmed_at')->nullable()->after('payment_status');
                }
                if (!Schema::hasColumn('bookings', 'expires_at')) {
                    $table->timestamp('expires_at')->nullable()->after('confirmed_at');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('bookings')) {
            Schema::table('bookings', function (Blueprint $table) {
                if (Schema::hasColumn('bookings', 'expires_at')) {
                    $table->dropColumn('expires_at');
                }
                if (Schema::hasColumn('bookings', 'confirmed_at')) {
                    $table->dropColumn('confirmed_at');
                }
            });
        }
    }
};
