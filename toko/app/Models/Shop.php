<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'foto_toko',
        'link_wa',
        'link_gmaps',
        'link_marketplace',
    ];

    // Define the relationship with the Verifikasi model
    public function verifications()
    {
        return $this->hasMany(Verifikasi::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}