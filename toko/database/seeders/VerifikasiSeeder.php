<?php

use Illuminate\Database\Seeder;
use App\Models\Verifikasi; // Pastikan import model yang benar

class VerifikasiSeeder extends Seeder
{
    public function run()
    {
        Verifikasi::create([
            'nama_toko' => 'Kopi Mangrove',
            'nama_pemilik' => 'Aulia Azizah',
            'jenis_usaha' => 'Minuman',
            'alamat_usaha' => 'Graha Indah',
            'nib' => '1234567890',
            'no_hp_wa' => '081234567890',
        ]);
        // Tambahkan data lainnya di sini
    }
}
