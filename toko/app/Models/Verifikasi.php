<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_toko', 'nama_pemilik', 'jenis_usaha', 'alamat_usaha', 'no_hp_wa', 'status',
    ];
    
}