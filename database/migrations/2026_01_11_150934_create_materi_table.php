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
    Schema::create('materi', function (Blueprint $table) {
        $table->id();

        $table->foreignId('id_guru')
            ->constrained('guru', 'id')
            ->cascadeOnDelete();

        $table->foreignId('id_kelas')
            ->constrained('kelas', 'id')
            ->cascadeOnDelete();

        $table->string('judul_materi');
        $table->text('deskripsi')->nullable();
        $table->string('file_materi')->nullable();
        $table->date('tanggal_upload');

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};
