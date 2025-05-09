<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    // Mengambil semua data toko
    public function index()
    {
        $shops = Shop::select('id', 'name', 'foto_toko')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data toko berhasil diambil',
            'data' => $shops
        ]);
    }


    public function getDetail($id)
{
    $shop = Shop::find($id);

    if (!$shop) {
        return response()->json([
            'success' => false,
            'message' => 'Toko tidak ditemukan'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'message' => 'Detail toko berhasil diambil',
        'data' => [
            'id' => $shop->id,
            'name' => $shop->name,
            'foto_toko' => asset('storage/' . $shop->foto_toko),
            'link_wa' => $shop->link_wa,
            'link_gmaps' => $shop->link_gmaps,
            'link_marketplace' => $shop->link_marketplace
        ]
    ]);
}



}