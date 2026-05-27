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
    Schema::create('pendaftaran_mapel', function (Blueprint $table) {
        $table->id();
        
        // Referensi ke tabel pendaftaran (Primary Key: id)
        $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->onDelete('cascade');

        // Referensi ke tabel mata_pelajaran (Primary Key: id_mapel) 
        $table->unsignedBigInteger('mapel_id');
        $table->foreign('mapel_id')->references('id_mapel')->on('mata_pelajaran')->onDelete('cascade');
        
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('pendaftaran_mapel');
}
};
