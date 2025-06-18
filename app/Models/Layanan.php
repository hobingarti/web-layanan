<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'jenis_layanan_id',
        'nik_warga',
        'nama_warga',
        'alamat_domisili',
        'lingkungan_domisili',
    ];

    public function jenisLayanan()
    {
        return $this->belongsTo(JenisLayanan::class, 'jenis_layanan_id');
    }
}
