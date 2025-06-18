<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLayanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'nama_jenis_layanan',
        'icon_jenis_layanan',
        'keterangan',
        'is_aktif',
    ];

    public function layanans()
    {
        return $this->hasMany(Layanan::class, 'jenis_layanan_id');
    }

    public function parent()
    {
        return $this->belongsTo(JenisLayanan::class, 'parent_id');
    }  
    
    public function children()
    {
        return $this->hasMany(JenisLayanan::class, 'parent_id');
    }

    public function isRoot()
    {
        return $this->parent_id == 0;
    }

    public function isLeaf()
    {
        return $this->children()->count() == 0;
    }
}
