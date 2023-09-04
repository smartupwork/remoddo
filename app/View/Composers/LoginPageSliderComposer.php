<?php


namespace App\View\Composers;

use App\Models\Category;
use App\Models\Page;
use Illuminate\View\View;

class LoginPageSliderComposer
{

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $page = Page::get('/');

        $view->with('sliders', $page->show("sliders:items"));
    }
}
