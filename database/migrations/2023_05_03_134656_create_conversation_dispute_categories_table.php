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
        Schema::create('conversation_dispute_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_message_id')->references('id')->on('chat_messages')->cascadeOnDelete();
            $table->foreignId('dispute_category_id')->references('id')->on('dispute_categories')->cascadeOnDelete();
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
        Schema::dropIfExists('conversation_dispute_categories');
    }
};
