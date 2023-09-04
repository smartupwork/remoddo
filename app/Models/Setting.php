<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    const EDATABLE_SETTINGS = [
        [
            'name' => 'Socials',
            'input_type'=>'input',
            'settings' => [
                'twitter_link' => 'Twitter Link',
                'tiktok_link' => 'Tiktok Link',
                'instagram_link' => 'Instagram Link',
                'facebook_link' => 'Facebook Link',
            ]
        ],
        [
            'name' => 'Fees',
            'input_type'=>'input',
            'settings' => [
                'service_fee' => 'Service Fee',
//                'shipping_fee' => 'Shipping Fee',
                'late_fee' => 'Late Fee',
                'deposit_fee' => 'Deposit Fee',
            ]
        ],
        [
            'name' => 'Support',
            'input_type'=>'input',
            'settings' => [
                'support_default_message' => 'Default Message',
            ]
        ],
        [
            'name'=>'Rent Labels',
            'input_type'=>'editor',
            'settings'=>[
                'rent_1'=>'Rent 1',
                'rent_2'=>'Rent 2',
                'rent_3'=>'Rent 3',
            ]
        ],
        [
            'name'=>'Footer',
            'input_type'=>'input',
            'settings'=>[
                'footer_1'=>'Footer',
            ]
        ]
    ];
    protected $fillable = [
        'key',
        'data',
    ];
    protected $casts = [
        'data' => 'array'
    ];

    public static function get($key, $onlyValue = true)
    {
        try {
            $setting = self::where('key', $key)->first();
            return $onlyValue ? $setting->data['value'] : $setting->data;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function set($key, $value,?string $input_type=null)
    {
        try {
            self::updateOrCreate([
                'key' => $key
            ], [
                'key' => $key,
                'data' => is_string($value) ? ['value' => $value] : $value,
                'input_type'=>$input_type
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
