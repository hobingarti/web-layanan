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
            $table->bigInteger('warga_id')->nullable()->after('jenis_layanan_id');
            $table->dropColumn('nik_warga');
            $table->dropColumn('nama_warga');
            $table->dropColumn('alamat_domisili');
            $table->dropColumn('lingkungan_domisili');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->dropColumn('warga_id');
            $table->string('nik_warga')->nullable()->after('jenis_layanan_id');
            $table->string('nama_warga')->nullable()->after('nik_warga');
            $table->string('alamat_domisili')->nullable()->after('nama_warga');
            $table->string('lingkungan_domisili')->nullable()->after('alamat_domisili');
        });
    }
};
