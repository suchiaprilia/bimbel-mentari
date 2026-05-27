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
        Schema::table('materi', function (Blueprint $table) {
            if (!Schema::hasColumn('materi', 'id_mapel')) {
                $table->unsignedBigInteger('id_mapel')->nullable()->after('id_kelas');
                $table->foreign('id_mapel')->references('id_mapel')->on('mata_pelajaran')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materi', function (Blueprint $table) {
            //
        });
    }
};
