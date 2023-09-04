<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributeValues=AttributeValue::pluck('attribute_id','id');
        $childrenCategories=Category::whereNotNull('parent_id')->pluck('id');

        Product::factory(20)->create()->each(function ($product) use($attributeValues,$childrenCategories){
            $product->price=10;
            $product->save();

            foreach ($attributeValues as $value_id=>$attribute_id){
                  ProductAttribute::insert([
                      'product_id'=>$product->id,
                      'attribute_value_id'=>$value_id,
                      'attribute_id'=>$attribute_id
                  ]);
              }
            $product->rents()->create([
               'rent_day'=>1,
               'rent_price'=>10,
            ]);
              foreach ($childrenCategories as $category){
                  $product->categories()->attach($category);
              }
        });
    }
}
