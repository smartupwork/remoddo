<?php

namespace App\Providers;

use App\View\Composers\CategoryPopuPComposer;
use App\View\Composers\DopBlockComposer;
use App\View\Composers\FooterContactUsComposer;
use App\View\Composers\FooterMenuComposer;
use App\View\Composers\HeaderMenuComposer;
use App\View\Composers\HeaderNotificationComposer;
use App\View\Composers\LoginPageSliderComposer;
use App\View\Composers\ProductFilterComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('components.main.product_filter', ProductFilterComposer::class);
        View::composer('components.main.header_notification', HeaderNotificationComposer::class);
        View::composer('main.sections.pages.home.dop-block', DopBlockComposer::class);
        View::composer('main.sections.footer-popup', CategoryPopuPComposer::class);
        View::composer(['components.main.menu.mobile', 'components.main.menu.desktop'], HeaderMenuComposer::class);
        View::composer(['main.sections.footer'], FooterMenuComposer::class);
        View::composer(['main.sections.footer'], FooterContactUsComposer::class);
        View::composer(['main.sections.pages.security.slider'], LoginPageSliderComposer::class);
    }
}
