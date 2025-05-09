<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Product extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'name',
        //'image',
        'price',
        'stock',
       // 'category_id',
        'description',
        'image', 
        'shop_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function shop()
{
    return $this->belongsTo(Shop::class, 'shop_id', 'id');
}


    public function user()
{
    return $this->belongsTo(User::class, 'user_id'); // Sesuaikan dengan kolom di tabel products
}


}