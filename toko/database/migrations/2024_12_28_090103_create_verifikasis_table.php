<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('verifikasis', function (Blueprint $table) { // Nama tabel verifikasis
            $table->id();
            $table->string('nama_toko');
            $table->string('nama_pemilik');
            $table->string('jenis_usaha');
            $table->text('alamat_usaha');
            $table->string('nib');
            $table->string('no_hp_wa');
            $table->timestamps(); // Tambahkan timestamps untuk mencatat waktu pembuatan dan update
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verifikasis'); // Sesuaikan nama tabel yang dihapus
    }
};
