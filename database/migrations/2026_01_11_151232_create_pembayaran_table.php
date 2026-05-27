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
Schema::create('pembayaran', function (Blueprint $table) {
    $table->id();

    $table->foreignId('id_siswa')
        ->constrained('siswa', 'id')
        ->cascadeOnDelete();

    $table->integer('jumlah');
    $table->date('tanggal_jatuh_tempo');
    $table->date('tanggal_bayar')->nullable();
    $table->enum('status', ['Lunas', 'Belum'])->default('Belum');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
