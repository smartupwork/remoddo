<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributes = [
            [
                'name' => 'color',
                'title' => 'Color',
                'is_required' => true,
                'is_show' => true,
                'is_multiple' => false,
                'show_in_products_table' => false,
                'values' => ['red', 'black', 'yellow', 'green']
            ],
            [
                'name' => 'size',
                'title' => 'Size',
                'is_required' => true,
                'is_show' => true,
                'is_multiple' => true,
                'show_in_products_table' => true,
                'values' => ['ML', 'XL', 'XXL', 'XS']
            ],
            [
                'name' => 'item_type',
                'title' => 'Item type',
                'is_required' => true,
                'is_show' => true,
                'is_multiple' => true,
                'show_in_products_table' => false,
                'values' => ['Dress', 'Bags', 'Tops', 'Shoes']
            ],
            [
                'name' => 'availability',
                'title' => 'Availability',
                'is_required' => true,
                'is_show' => true,
                'is_multiple' => false,
                'show_in_products_table' => false,
                'values' => ['Man', 'Woman']
            ]
        ];

        foreach ($attributes as $attribute){
            $model=Attribute::updateOrCreate([
                'name'=>$attribute['name'],
                'title'=>$attribute['title'],
                'is_required'=>$attribute['is_required'],
                'is_show'=>$attribute['is_show'],
                'is_multiple'=>$attribute['is_multiple'],
                'show_in_products_table'=>$attribute['show_in_products_table'],
            ]);
            foreach ($attribute['values'] as $value){
                AttributeValue::insert([
                    'attribute_id'=>$model->id,
                    'value'=>$value
                ]);
            }
        }
    }
}
