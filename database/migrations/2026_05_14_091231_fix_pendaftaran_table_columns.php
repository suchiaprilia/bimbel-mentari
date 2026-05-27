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
        Schema::table('pendaftaran', function (Blueprint $table) {
            if (!Schema::hasColumn('pendaftaran', 'kode_pendaftaran')) {
                $table->string('kode_pendaftaran', 25)->unique()->after('id');
            }
            if (!Schema::hasColumn('pendaftaran', 'id_kelas')) {
                $table->unsignedBigInteger('id_kelas')->nullable()->after('jenjang');
            }
            if (!Schema::hasColumn('pendaftaran', 'keterangan')) {
                $table->text('keterangan')->nullable()->after('tanggal_daftar');
            }
            if (Schema::hasColumn('pendaftaran', 'kelas_dipilih')) {
                $table->dropColumn('kelas_dipilih');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropColumn(['kode_pendaftaran', 'id_kelas', 'keterangan']);
            $table->string('kelas_dipilih')->nullable()->after('jenjang');
        });
    }
};
