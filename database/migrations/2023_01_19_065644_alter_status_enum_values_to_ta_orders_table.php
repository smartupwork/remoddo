<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ta_orders', function (Blueprint $table) {
            DB::statement("alter table orders modify status enum('new','confirmed','canceled', 'accepted', 'declined', 'failed', 'in_wardrobe', 'completed') default 'new' not null");
            DB::statement("UPDATE orders  SET status = 'accepted' where status='confirmed'");
            DB::statement("UPDATE orders  SET status = 'declined' where status='canceled'");
            DB::statement("alter table orders modify status enum('new','accepted','declined','failed', 'in_wardrobe', 'completed') default 'new' not null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ta_orders', function (Blueprint $table) {
            //
        });
    }
};
