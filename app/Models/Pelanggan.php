<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $guarded = [];

    public function kelengkapan_pelanggan()
    {
        return $this->belongsTo(KelengkapanPelanggan::class, 'id');
    }
}
