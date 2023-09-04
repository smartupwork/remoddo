<?php


namespace App\View\Composers;

use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class FooterMenuComposer
{

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        if (!Cache::has('footerMenus'))
        {
            $footerMenus = Menu::with('items')
                ->where('code', '<>', 'header')
                ->get();
            Cache::put('footerMenus', $footerMenus, Carbon::now()->addMinutes(1));
        }
        else{
            $footerMenus = Cache::get('footerMenus');
        }
        $view->with('footerMenus', $footerMenus);
    }
}
