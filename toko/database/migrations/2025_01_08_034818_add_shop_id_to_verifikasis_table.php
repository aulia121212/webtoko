<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShopIdToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->nullable()->after('id'); // Kolom shop_id
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade'); // Relasi ke tabel shops
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['shop_id']); // Hapus foreign key
            $table->dropColumn('shop_id'); // Hapus kolom shop_id
        });
    }
}



