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
        Schema::create('siswa_mapel', function (Blueprint $table) {

            $table->id();

            // relasi ke siswa
            $table->unsignedBigInteger('siswa_id');

            // relasi ke mata pelajaran
            $table->unsignedBigInteger('mapel_id');

            $table->timestamps();

            // foreign key siswa
            $table->foreign('siswa_id')
                  ->references('id')
                  ->on('siswa')
                  ->onDelete('cascade');

            // foreign key mapel
            $table->foreign('mapel_id')
                  ->references('id_mapel')
                  ->on('mata_pelajaran')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_mapel');
    }
};