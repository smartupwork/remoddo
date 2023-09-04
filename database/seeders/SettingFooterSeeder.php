<?php

namespace Database\Seeders;

use App\Enums\SettingInputType;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingFooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            'footer_1' => 'Some text for the information about company Remoddo',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value,SettingInputType::EDITOR);
        }
    }
}
