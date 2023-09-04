<?php

use App\Enums\BrandConfirmationStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('products', function (Blueprint $table) {
            $table->enum('brand_confirmation', BrandConfirmationStatus::getValues())
                ->default(BrandConfirmationStatus::PENDING)->change();

            if (Schema::hasColumn('products', 'category_id')) {
                $table->dropForeign('products_category_id_foreign');
                $table->dropColumn('category_id');
            }

        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
