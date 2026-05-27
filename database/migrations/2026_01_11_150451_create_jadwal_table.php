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
Schema::create('jadwal', function (Blueprint $table) {
    $table->id('id_jadwal');

    $table->foreignId('id_guru')
        ->constrained('guru', 'id')
        ->cascadeOnDelete();

    $table->foreignId('id_kelas')
        ->constrained('kelas', 'id')
        ->cascadeOnDelete();

    $table->foreignId('id_mapel')
        ->constrained('mata_pelajaran', 'id_mapel')
        ->cascadeOnDelete();

    $table->date('tanggal');
    $table->time('jam_mulai');
    $table->time('jam_selesai');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
