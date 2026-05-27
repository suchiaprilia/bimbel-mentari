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
        Schema::table('guru', function (Blueprint $table) {
            if (!Schema::hasColumn('guru', 'id_user')) {
                $table->foreignId('id_user')->nullable()->after('id')->constrained('user')->onDelete('set null');
            }
            if (!Schema::hasColumn('guru', 'id_mapel')) {
                $table->unsignedBigInteger('id_mapel')->nullable()->after('id_user');
                $table->foreign('id_mapel')->references('id_mapel')->on('mata_pelajaran')->onDelete('set null');
            }
            if (!Schema::hasColumn('guru', 'alamat')) {
                $table->text('alamat')->nullable()->after('no_whatsapp');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guru', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropForeign(['id_mapel']);
            $table->dropColumn(['id_user', 'id_mapel', 'alamat']);
        });
    }
};
