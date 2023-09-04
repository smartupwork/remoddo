<?php


namespace App\View\Composers;

use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HeaderMenuComposer
{

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        if (!Cache::has('header_menu'))
        {
            $headerMenu = Menu::with('items')
                ->where('code', 'header')
                ->first();
            $headerMenuItems=$headerMenu->items;
            Cache::put('header_menu', $headerMenuItems, Carbon::now()->addMinutes(1));
        }
        else{
            $headerMenuItems = Cache::get('header_menu');
        }

        $view->with('headerMenus', $headerMenuItems);
    }
}
