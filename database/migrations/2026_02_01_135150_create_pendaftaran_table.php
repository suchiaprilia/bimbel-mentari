<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();

            // Data calon siswa
            $table->string('nama_siswa');
            $table->string('nama_ortu')->nullable();
            $table->string('no_whatsapp', 15);
            $table->text('alamat')->nullable();

            // Informasi jenjang/kelas yang diinginkan
            $table->string('jenjang')->nullable(); // SD/SMP/SMA (opsional)
            $table->string('kelas_dipilih')->nullable(); // misal: "VII", "X IPA", dll

            // Status proses pendaftaran
            $table->enum('status', ['Menunggu', 'Diterima', 'Ditolak'])->default('Menunggu');

            $table->date('tanggal_daftar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
