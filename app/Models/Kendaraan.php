<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $guarded = [];

    public function jenis_kendaraan()
    {
        return $this->belongsTo(JenisKendaraan::class, 'jenis_kendaraans_id');
    }

    public function brand_kendaraan()
    {
        return $this->belongsTo(BrandKendaraan::class, 'brand_kendaraans_id');
    }

    public function seri_kendaraan()
    {
        return $this->belongsTo(SeriKendaraan::class, 'seri_kendaraans_id');
    }

    public function kilometer_kendaraan()
    {
        return $this->belongsTo(KategoriKilometerKendaraan::class, 'kategori_kilometer_kendaraans_id');
    }

    // public function pemesanan()
    // {
    //     return $this->hasMany(Pemesanan::class, 'id');
    // }

    // public function pelepasan_pemesanans()
    // {
    //     return $this->hasMany(PelepasanPemesanan::class, 'id');
    // }
}
