<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $fillable = [
        'nik',
        'nama',
        'alamat_domisili',
        'lingkungan_domisili',
        'jenis_kelamin',
        'agama',
        'pendidikan_terakhir',
        'jenis_ktp',
        'status_perkawinan',
        'pekerjaan',
        'telp_hp',
        'email',
        'kode_nonpermanen',
        'alamat_asal',
        'tempat_lahir',
        'tanggal_lahir'
    ];
}
