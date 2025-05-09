<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Shop; // Jangan lupa import model Shop


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        // Logika yang disederhanakan
        if ($user->level === 'Admin' && $user->shop_id) {
            $products = Product::where('shop_id', $user->shop_id)->get();
            $shop = $user->shop; // Ambil data toko hanya jika user adalah admin dan memiliki toko
        } else {
            // Jika bukan admin atau tidak memiliki toko, redirect atau tampilkan pesan error
            abort(403, 'Unauthorized'); // Atau redirect ke halaman lain
        }
    
        $totalStock = $products->sum('stock'); // Hitung stok hanya untuk produk yang ditampilkan
        $totalProduct = $products->count(); // Hitung produk hanya untuk produk yang ditampilkan
        $totalCategory = Category::count(); // Ini bisa tetap, atau di filter per toko jika dibutuhkan
    
    
        return view('dashboard', compact('products', 'totalStock', 'totalProduct', 'totalCategory', 'shop'));
    }


    public function index_super_admin()
    {
        $user = Auth::user();

        // Jika user adalah Super Admin
        if ($user->level === 'Super Admin') {
            // Mengambil jumlah toko dan produk dari semua admin toko
            $totalShops = Shop::count();  // Mengambil jumlah toko
            $totalProduct = Product::count();  // Mengambil jumlah produk dari semua toko
        } else {
            // Jika bukan Super Admin, hanya bisa melihat data toko mereka
            abort(403, 'Unauthorized');
        }


        // Kirim data ke view
        return view('dashboardsuper', compact('totalShops', 'totalProduct'));
    }
    

}
