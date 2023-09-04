<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Factory::create();
        Category::factory(5)->create()->each(function ($category) use($faker){
            $child_categories=[];


              for($i=0;$i<3;$i++){

                  $title=$faker->text(30);
                  $child_categories[]=new Category([
                      'title'=>$title,
                      'slug'=>Str::slug($title),
                      'image'=>$faker->image,
                      'is_show'=> (bool)rand(0, 1),
                      'is_show'=> true,
                  ]);
              }
              $category->children()->saveMany($child_categories);
        });

        $categories_for_menu=[
            [
                'title'=>'Menswear',
                'slug'=>Str::slug('Menswear'),
                'image'=>$faker->image,
                'parent_id'=>1,
                'is_show'=> true,
            ],
            [
                'title'=>'Womenswear',
                'slug'=>Str::slug('Womenswear'),
                'image'=>$faker->image,
                'parent_id'=>1,
                'is_show'=> true,
            ],
            [
                'title'=>'Jewellery',
                'slug'=>Str::slug('Jewellery'),
                'image'=>$faker->image,
                'parent_id'=>1,
                'is_show'=> true,
            ]
        ];

        Category::insert($categories_for_menu);

    }
}
