<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id(); // id_siswa

           // $table->foreignId('id_user')
               // ->constrained('users')
              //  ->onDelete('cascade');

            $table->foreignId('id_kelas')
                ->constrained('kelas')
                ->onDelete('restrict');

            $table->string('nama_siswa');
            $table->text('alamat')->nullable();
            $table->string('no_whatsapp', 15);
            $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
