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
        Schema::table('layanans', function (Blueprint $table) {
            $table->string('kode_arsip')->nullable()->after('lingkungan_domisili');
            $table->string('hasil_pelayanan')->nullable()->after('kode_arsip');
            $table->text('keterangan')->nullable()->after('hasil_pelayanan');
            $table->text('file_pendukung')->nullable()->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->dropColumn(['kode_arsip', 'hasil_pelayanan', 'keterangan', 'file_pendukung']);
        });
    }
};
