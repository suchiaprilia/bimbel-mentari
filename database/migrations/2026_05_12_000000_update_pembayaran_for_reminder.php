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
        if (Schema::hasTable('pembayaran')) {
            Schema::table('pembayaran', function (Blueprint $table) {
                if (!Schema::hasColumn('pembayaran', 'metode_pembayaran')) {
                    $table->string('metode_pembayaran')->nullable()->after('tanggal_bayar');
                }
                if (!Schema::hasColumn('pembayaran', 'bukti_transfer')) {
                    $table->string('bukti_transfer')->nullable()->after('metode_pembayaran');
                }
                if (!Schema::hasColumn('pembayaran', 'reminder_count')) {
                    $table->integer('reminder_count')->default(0)->after('status');
                }
                if (!Schema::hasColumn('pembayaran', 'last_reminder_sent_at')) {
                    $table->timestamp('last_reminder_sent_at')->nullable()->after('reminder_count');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('pembayaran')) {
            Schema::table('pembayaran', function (Blueprint $table) {
                if (Schema::hasColumn('pembayaran', 'last_reminder_sent_at')) {
                    $table->dropColumn('last_reminder_sent_at');
                }
                if (Schema::hasColumn('pembayaran', 'reminder_count')) {
                    $table->dropColumn('reminder_count');
                }
                if (Schema::hasColumn('pembayaran', 'bukti_transfer')) {
                    $table->dropColumn('bukti_transfer');
                }
                if (Schema::hasColumn('pembayaran', 'metode_pembayaran')) {
                    $table->dropColumn('metode_pembayaran');
                }
            });
        }
    }
};
