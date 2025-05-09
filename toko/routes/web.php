<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VerifikasiController;


Route::get('/', function () {
    return view('home');
});



// In your web.php routes file
Route::post('/register', [AuthController::class, 'registerSave'])->name('register.save');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('shopAccess');

Route::middleware(['auth', 'super_admin'])->group(function () {
    Route::get('/super-admin/dashboard', [DashboardController::class, 'index_super_admin'])->name('dashboardsuper');
});


Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('', 'index')->name('dashboard');
        Route::get('/api', 'api')->name('dashboard.api');
    });

    Route::controller(ProductController::class)->prefix('products')->group(function () {
        Route::get('', 'index')->name('products');
        Route::get('create', 'create')->name('products.create');
        Route::post('store', 'store')->name('products.store');
        Route::get('show/{id}', 'show')->name('products.show');
        Route::get('edit/{id}', 'edit')->name('products.edit');
        Route::put('edit/{id}', 'update')->name('products.update');
        Route::delete('destroy/{id}', 'destroy')->name('products.destroy');
    });

    Route::controller(CategoryController::class)->prefix('categories')->group(function () {
        Route::get('', 'index')->name('categories');
        Route::get('create', 'create')->name('categories.create');
        Route::post('store', 'store')->name('categories.store');
        Route::get('show/{id}', 'show')->name('categories.show');
        Route::get('edit/{id}', 'edit')->name('categories.edit');
        Route::put('edit/{id}', 'update')->name('categories.update');
        Route::delete('destroy/{id}', 'destroy')->name('categories.destroy');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
        Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update'); 
    });
    
    // Rute untuk Super Admin di dalam middleware auth
    Route::middleware(['auth', 'super_admin'])->group(function () {

        // Route custom DULUAN
        Route::get('verifikasi/export', [VerifikasiController::class, 'export'])->name('verifikasi.export');
    
        // Route update status custom
        Route::put('verifikasi/{id}/update-status', [VerifikasiController::class, 'updateStatus'])->name('verifikasi.updateStatus');
    
        // Baru kemudian route resource
        Route::resource('verifikasi', VerifikasiController::class);
    });
    
    
});

