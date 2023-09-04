<?php


namespace App\View\Composers;

use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class DopBlockComposer
{

    /**
     * @param View $view
     */
    public function compose(View $view)
    {

        if (!Cache::has('page'))
        {
            $page = Page::get('/');
            Cache::put('page', $page, Carbon::now()->addMinutes(1));
        }
        else{
            $page = Cache::get('page');
        }
        $view->with('page', $page);
    }
}
