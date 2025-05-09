<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
        'shop_id',
         // Tambahkan ini

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi ke tabel shops
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id'); // Pastikan 'shop_id' ada di sini
    }


   protected static function boot()
{
    parent::boot();

    static::creating(function ($user) {
        if (!$user->level) {
            $user->level = 'Admin'; // Pastikan default adalah 'User'
        }
    });
}



}
