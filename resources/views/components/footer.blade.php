<a href="" class="scroll_to_top"></a>
<footer class="footer @yield('footer_class')">
    <div class="container">
        <div class="footer__body">
            <div class="footer__info">
                <a href="{{route('home')}}" class="logo">
                    <img src="{{asset('front/img/logo-white.svg')}}" alt="CryptoDoggies">
                    <span>CryptoDoggies</span>
                </a>
                <p>
                    See the range of advanced Doggies from sale on OpenSea!
                    Some are super rare. If your Doggy has some desiraable features you may want to sell it on OpenSea
                </p>
            </div>
            <nav class="footer__nav">
                <div class="footer__nav-item">
                    <h5 class="footer__nav-title">Catalogue</h5>
                    <ul class="footer__menu">
                        @foreach ($footer1Menu as $item)
                            <li><a href="{{url($item->link)}}">{{$item->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="footer__nav-item">
                    <h5 class="footer__nav-title">Help</h5>
                    <ul class="footer__menu">
                        @foreach ($footer2Menu as $item)
                            <li><a href="{{url($item->link)}}">{{$item->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="footer__nav-item">
                    <h5 class="footer__nav-title">About</h5>
                    <ul class="footer__menu">
                        @foreach ($footer3Menu as $item)
                            <li><a href="{{url($item->link)}}">{{$item->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="footer__nav-item">
                    <h5 class="footer__nav-title">Social Networks</h5>
                    <ul class="footer__menu">
                        <li>
                        	<a href="{{\App\Models\Setting::get('facebook_link')}}" target="_blank">
                        		@svg(front/img/bxl_facebook.svg)
                                Facebook
                        	</a>
                        </li>
                        <li>
                        	<a href="{{\App\Models\Setting::get('twitter_link')}}" target="_blank">
                        	@svg(front/img/bxl_twitter.svg)
                        	Twitter
                        	</a>
                        </li>
                        <li>
                        	<a href="{{\App\Models\Setting::get('instagram_link')}}" target="_blank">
                        		@svg(front/img/akar-icons_instagram-fill.svg)
                        		Instagram
                        	</a>
                        </li>
                        <li>
                        	<a href="{{\App\Models\Setting::get('discord_link')}}" target="_blank">
                        		@svg(front/img/akar-icons_discord-fill.svg)
                        		Discord
                        	</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="footer__bottom">
            <span>
                &copy;{{date('Y')}} CryptoDoggies, Inc
            </span>
        </div>
    </div>
</footer>


