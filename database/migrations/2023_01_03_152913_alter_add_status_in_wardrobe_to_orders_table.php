<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wardrobe_to_orders', function (Blueprint $table) {
            \Illuminate\Support\Facades\DB::statement("alter table orders modify status enum('new', 'confirmed', 'canceled', 'failed', 'in_wardrobe') default 'new' not null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wardrobe_to_orders', function (Blueprint $table) {
            //
        });
    }
};
