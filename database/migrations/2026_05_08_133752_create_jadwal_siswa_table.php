<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_siswa', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('jadwal_id');
            $table->unsignedBigInteger('siswa_id');

            $table->foreign('jadwal_id')
                ->references('id_jadwal')
                ->on('jadwal')
                ->onDelete('cascade');

            $table->foreign('siswa_id')
                ->references('id')
                ->on('siswa')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_siswa');
    }
};