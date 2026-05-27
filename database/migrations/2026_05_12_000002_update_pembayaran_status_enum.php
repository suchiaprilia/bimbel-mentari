<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('pembayaran')) {
            DB::statement("ALTER TABLE pembayaran MODIFY status ENUM('Lunas','Belum','Menunggu') NOT NULL DEFAULT 'Belum'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('pembayaran')) {
            DB::statement("ALTER TABLE pembayaran MODIFY status ENUM('Lunas','Belum') NOT NULL DEFAULT 'Belum'");
        }
    }
};
