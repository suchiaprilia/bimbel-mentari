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
        Schema::table('notifikasi', function (Blueprint $table) {
            $table->foreignId('id_pembayaran')->nullable()->change();
            $table->string('target_phone')->nullable()->after('pesan');
            $table->string('type')->nullable()->after('target_phone'); // 'pembayaran', 'pendaftaran', etc
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifikasi', function (Blueprint $table) {
            $table->foreignId('id_pembayaran')->nullable(false)->change();
            $table->dropColumn(['target_phone', 'type']);
        });
    }
};
