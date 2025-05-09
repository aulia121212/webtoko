<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\ShopController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::post('/register', [AuthController::class, 'registerApi']);

Route::post('/register', [AuthController::class, 'registerSave']);
Route::post('/login', [AuthController::class, 'loginAction']);
Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/mobile', [ProductController::class, 'apiIndex']); 
//Route::post('/user/shops', [AuthController::class, 'getUserShops']);
Route::get('/products', action: [ProductController::class, 'getProductsByShopId']);
Route::get('/product/detail', [ProductController::class, 'getProductDetail']); // Untuk detail produk dengan deskripsi

Route::get('/product/langsung/{product_id}', [ProductController::class, 'getSingleProductDetail']);


//Route::middleware('auth:sanctum')->get('/user/shops', [AuthController::class, 'getUserShops']);

//Route::middleware('auth:sanctum')->get('/user/shops', [AuthController::class, 'getUserShops']);

Route::get('/shops', [ShopController::class, 'index']);

Route::get('/shops/{id}', [ShopController::class, 'getDetail']);

//Route::get('/shops', [ShopController::class, 'listShops']); // API untuk daftar toko
//Route::get('/shops/{id}', [ShopController::class, 'detailShop']); // API untuk detail toko


Route::post('/umkm/daftar', [VerifikasiController::class, 'storeFromMobile']);
//Route::post('/verifikasi/mobile', [VerifikasiController::class, 'storeFromMobile']);
//Route::post('login', 'Api\UserController@login');
//Route::post('register', 'Api\UserController@register');
//Route::get('produk', 'Api\ProdukController@index');