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
        Schema::create('wargas', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nama');
            $table->string('alamat_domisili');
            $table->string('lingkungan');
            $table->string('alamat_asal')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('agama')->nullable();
            $table->string('jenis_ktp')->nullable();
            $table->string('telp_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('kode_nonpermanen')->nullable();
            $table->string('status_warga')->default('permanen'); // permanen, non-permanen, deceased
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wargas');
    }
};
