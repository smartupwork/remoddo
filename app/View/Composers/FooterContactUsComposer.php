<?php


namespace App\View\Composers;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class FooterContactUsComposer
{

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        if (!Cache::has('settings'))
        {
            $settings = Setting::whereIn('key',['twitter_link','tiktok_link','instagram_link','facebook_link'])
                ->get();
            Cache::put('settings', $settings, Carbon::now()->addMinutes(1));
        }
        else{
            $settings = Cache::get('settings');
        }

        $view->with('settings', $settings);
    }
}
