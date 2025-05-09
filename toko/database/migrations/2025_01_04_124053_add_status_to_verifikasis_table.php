<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('verifikasis', function (Blueprint $table) {
            $table->enum('status', ['Diterima', 'Ditolak'])->nullable(); // Nullable allows for no initial status
        });
    }
    
    
    public function down()
    {
        Schema::table('verifikasis', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
    


};
