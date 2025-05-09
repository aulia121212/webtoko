<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->string('link_wa')->nullable();
            $table->string('link_gmaps')->nullable();
            $table->string('link_marketplace')->nullable();
        });
    }

    public function down()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->dropColumn(['link_wa', 'link_gmaps', 'link_marketplace']);
        });
    }
};
