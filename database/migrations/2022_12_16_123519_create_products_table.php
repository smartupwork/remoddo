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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->integer('period_day');
            $table->float('price');
            $table->string('address');
            $table->enum('brand_confirmation',\App\Enums\BrandConfirmationStatus::getValues());
            $table->foreignId('category_id')->references('id')->on('categories')->cascadeOndelete();
            $table->foreignId('brand_id')->references('id')->on('brands')->cascadeOndelete();
            $table->foreignId('lender_id')->references('id')->on('users')->cascadeOndelete();
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
