<a href="" class="scroll_to_top"></a>
<footer class="footer border-top">
    <div class="footer--item py-40 bg--white">
        <div class="container">
            <div class="footer-row">
                <div class="footer-col">
                    <div class="block-menu">
                        <div class="block-menu--head">
                            <a href="{{route('main.home')}}" class="logo">
                                <img src="{{asset('main/img/images/logo-small.svg')}}">
                            </a>
                        </div>
                        <div class="block-menu--body mt-20">
                            <p class="def-text def-text-1 opacity-05">
                                 {{\App\Models\Setting::get('footer_1')}}
                            </p>
                        </div>
                    </div>
                </div>
                @foreach($footerMenus as $menu)
                    <div class="footer-col">
                        <div class="block-menu">
                            <div class="block-menu--head">
                                <h4 class="heading fw-900 -ttu">
                                    <span class="info">{{$menu->name}}</span>
                                </h4>
                            </div>
                            <div class="block-menu--body mt-20">
                                <ul class="list-column">
                                    @foreach($menu->items as $childMenu)
                                        <li class="mb-12">
                                            <a href="{{$childMenu->link}}" class="def-text link-def">
                                        <span class="info fw-600">
                                            {{$childMenu->title}}
                                        </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach


                <div class="footer-col">
                    <div class="block-menu">
                        <div class="block-menu--head">
                            <h4 class="heading fw-900 -ttu">
                                <span class="info">Contact Us</span>
                            </h4>
                        </div>
                        <div class="block-menu--body mt-20">
                            <ul class="list-column">
                                @foreach($settings as $setting)
                                <li class="mb-12">
                                    <a href="{{$setting->data['value']}}" class="def-text link-def">
                                        <span class="info fw-600">
                                            {{ucfirst(str_replace('_link','',$setting->key))}}
                                        </span>
                                    </a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="footer--item pb-40 bg--white">
        <div class="container">
            <div class="footer-row">
                <div class="footer-col col-100">
                    <div class="copyright">
                        <div class="logo">
                            <img src="{{asset('main/img/images/logo-big.svg')}}"/>
                        </div>
                        <p class="copyright-text text-center mt-40">
                            © 2022 COPYRIGHT. ALL RIGHTS RESERVED.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@stack('footer-popup')


