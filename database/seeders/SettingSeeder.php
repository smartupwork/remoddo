<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            'twitter_link' => 'https://twitter.com/home',
            'discord_link' => 'https://discord.com/',
            'instagram_link' => 'https://www.instagram.com/',
            'facebook_link' => 'https://www.facebook.com/',
            'service_fee'=>config('rent.service_fee'),
//            'shipping_fee'=>config('rent.shipping_fee'),
            'late_fee'=>config('rent.late_fee'),
            'deposit_fee'=>config('rent.deposit_fee'),
            'support_default_message'=>"Hi, my name Jack Smith. I’m your support manager. You have opened dispute about {{dispute_category}}. Please, describe your situation and how can I help you?"
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }
    }
}
