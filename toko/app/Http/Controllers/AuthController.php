<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman registrasi
     */
    public function register()
    {
        $shops = Shop::all();
        return view('auth.register', compact('shops'));
    }

    /**
     * Menyimpan data registrasi
     */
    public function registerSave(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            // Buat toko hanya jika user adalah admin
            $shop = Shop::create([
                'name' => $request->name,
            ]);

            // Buat pengguna dengan shop_id
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'level' => 'Admin',
                'shop_id' => $shop->id,
            ]);

            return redirect()->route('login')->with('success', 'Registrasi berhasil! Anda dapat masuk sekarang.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Tampilkan halaman login
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function loginAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return redirect()->route('login')->withErrors(['login' => 'Email atau password salah.']);
        }

        $request->session()->regenerate();

         // Redirect berdasarkan level user
    if (Auth::user()->level === 'Super Admin') {
        return redirect()->route('dashboardsuper');  // Arahkan ke halaman dashboard super admin
    }

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('login'); // Pastikan ada route('login') di web.php
    }
    /**
     * Tampilkan halaman profil
     */
    public function profile()
    {
        $user = auth()->user();
        $shop = Shop::where('id', $user->shop_id)->first(); // Ambil shop sesuai user
    
        return view('profile', compact('user', 'shop'));
    }
    
    /**
     * Update foto toko (Menyimpan di tabel shops, bukan users)
     */
    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'foto_toko' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'link_wa' => 'nullable|url',
            'link_gmaps' => 'nullable|url',
            'link_marketplace' => 'nullable|string',
        ]);

        //dd($validatedData);

    
        $user = Auth::user();
        $shop = $user->shop;

        if (!$shop) {
            return redirect()->route('profile')->with('error', 'Data toko tidak ditemukan!');
        }
    
        if ($request->hasFile('foto_toko')) {
            if ($shop->foto_toko) {
                Storage::delete('public/' . $shop->foto_toko);
            }
            $path = $request->file('foto_toko')->store('foto_toko', 'public');
            $shop->foto_toko = $path;
        }
    
        $shop->link_wa = $request->input('link_wa') ;
           // ? (Str::startsWith($request->input('link_wa'), 'http') 
              //  ? $request->input('link_wa') 
               // : 'https://wa.me/' . preg_replace('/\D/', '', $request->input('link_wa')))
           // : null;
    
        $shop->link_gmaps = $request->input('link_gmaps');
        $shop->link_marketplace = $request->input('link_marketplace');
    
        $shop->save();
    
        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }



    /**
     * Mengambil data toko berdasarkan user yang sedang login
     */
    public function getUserShops(Request $request)
    {
        $user = Auth::user();
        $shop = $user->shop; // Ambil data toko terkait user

        if ($shop) {
            return response()->json([
                'id' => $shop->id,
                'name' => $shop->name,
                'foto_toko' => asset('storage/' . $shop->foto_toko), // Pastikan asset digunakan
            ]);
        }

        return response()->json(['message' => 'Toko tidak ditemukan'], 404);
    }
}
