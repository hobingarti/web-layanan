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
        Schema::create('jenis_layanans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("parent_id")->default(0);
            $table->string("nama_jenis_layanan")->default("");
            $table->string("icon_jenis_layanan")->default("");
            $table->string("keterangan")->default("");
            $table->integer("is_aktif")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_layanans');
    }
};
