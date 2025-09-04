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

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }

    public function newKodeArsip()
    {
        $lastLayanan = Layanan::where(DB::raw('YEAR(created_at)'), date('Y'))
            ->orderBy('created_at', 'desc')
            ->first();
        if ($lastLayanan) {
            $lastNumber = (int)explode('/', $lastLayanan->kode_arsip)[1];
            $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '00001';
        }

        return '100'.'/'.$newNumber.'/VII'.'/'.date('Y');
    }

    public function assignKodeArsip()
    {
        $this->kode_arsip = $this->newKodeArsip();
    }
}
