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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lender_id')->references('id')->on('users')->cascadeOndelete();
            $table->foreignId('renter_id')->references('id')->on('users')->cascadeOndelete();
            $table->foreignId('rent_id')->references('id')->on('rents')->cascadeOndelete();
            $table->foreignId('product_id')->references('id')->on('products')->cascadeOndelete();
            $table->integer('total_price');
            $table->string('payment_intent');
            $table->enum('status',[\App\Enums\OrderStatus::getValues()])->default(\App\Enums\OrderStatus::NEW);
            $table->timestamps();
            });
        \Illuminate\Support\Facades\DB::statement("alter table orders modify status enum('new', 'confirmed', 'canceled','failed') default 'new' not null");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
