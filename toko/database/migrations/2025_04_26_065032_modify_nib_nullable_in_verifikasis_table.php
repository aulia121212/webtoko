<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyNibNullableInVerifikasisTable extends Migration
{
    public function up()
    {
        Schema::table('verifikasis', function (Blueprint $table) {
            $table->string('nib')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('verifikasis', function (Blueprint $table) {
            $table->string('nib')->nullable(false)->change();
        });
    }
}
