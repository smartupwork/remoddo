<?php

namespace Database\Factories;

use App\Enums\BrandConfirmationStatus;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $colors=['red','yellow','green','black','white','brown','blue'];
        $dresses=['hat','glove','pants','shirt','coat','scarf','clothes','bag'];
        $color=$colors[array_rand($colors,1)];
        $dress=$dresses[array_rand($dresses,1)];

        $title="$color $dress";

        return [
            'title'=>$title,
            'slug'=>Str::slug($title),
            'period_day'=>$this->faker->numberBetween(1,10),
            'address'=>$this->faker->text(20),
            'price'=>$this->faker->numberBetween(100,1000),
            'brand_confirmation'=>$this->faker->randomElement(BrandConfirmationStatus::getValues()),
            'description'=>$this->faker->text(20),
            'brand_id'=>Brand::factory(),
            'lender_id'=>2
        ];
    }
}
