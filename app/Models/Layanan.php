<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisLayanan;

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

    public function monthKodeArsip($month)
    {
        $months = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        ];

        return $months[$month] ?? '';
    }

    public function assignKodeArsip()
    {
        // create new year and nomor based on last record
        $year = date('Y');
        $month = $this->monthKodeArsip(date('n'));
        $lastLayanan = Layanan::where('tahun', $year)->orderBy('nomor', 'desc')->first();
        if ($lastLayanan) {
            $newNomor = $lastLayanan->nomor + 1;
        } else {
            $newNomor = 1;
        }

        $jenisLayanan = JenisLayanan::find($this->jenis_layanan_id);
        $kodeJenisLayanan = $jenisLayanan ? $jenisLayanan->kode : 100; // Default kode if not found

        $this->tahun = $year;
        $this->nomor = $newNomor;
        $this->kode_arsip = $kodeJenisLayanan.'/'.str_pad($newNomor, 3, '0', STR_PAD_LEFT).'/'.$month.'/'.$year;
    }
}
