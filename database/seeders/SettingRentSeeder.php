<?php

namespace Database\Seeders;

use App\Enums\SettingInputType;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingRentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            'rent_1' => '{deposit_fee}% deposit will be applied as a pending charge until the rental is returned',
            'rent_2' => "Late return incur a daily late fee <span class='fw-800'>{late_fee}%</span> of rental price",
            'rent_3' => 'Purchasing of postage is completely manual',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value,SettingInputType::EDITOR);
        }
    }
}
