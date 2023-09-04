<header class="header">
    <div class="header--item bg--white py-12">
        <div class="flex-auto d-flex align-items-center">
            <div class="header--option">
                <a href="{{route('main.home')}}" class="logo">
                    <img src="{{asset('main/img/images/logo-small.svg')}}" alt="">
                </a>
            </div>
            <div class="header--option flex-500 mx-20 hidden-480">
                <form class="input-search-form w-100" action="{{route('main.product.search')}}">
                    <label class="relative">
                        <input type="text" data-url="{{route('main.product.search')}}" name="search"
                               value="{{request()->get('search')}}" class="product-search input-search-window w-100"
                               placeholder="Search for anything...">
                        <button type="submit" class="form-search__btn">
                            <img src="{{asset('main/img/icons/icon-search.svg')}}">
                        </button>
                    </label>
                    <ul class="search-window product-search-window">
                    </ul>
                </form>
            </div>
            <div class="header--option hidden-768">
                <a href="{{route('main.help-center.question',['question'=>2])}}"
                   class="btn btn--transp btn--sm -ttu radius-3">
               <span class="ico ico-24 mr-8">
                  <img src="{{asset('main/img/icons/ico-message.svg')}}" alt="">
               </span>
                    <span class="info">
                  How It Works
               </span>
                </a>
            </div>
        </div>
        <div class="d-flex">
            <div class="header--option">
                <div class="notifications-wrap">
                    <a href="#" class="btn btn--sm btn--transp px-6 radius-3 notification-btn hidden-992">
                            <span class="ico ico-24">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.50879 18.0024V18.5147C9.50879 19.1751 9.7713 19.8085 10.2385 20.2754C10.7057 20.7422 11.3393 21.0042 11.9998 21.0037V21.0037C12.6604 21.004 13.294 20.7417 13.7612 20.2747C14.2284 19.8077 14.4909 19.1742 14.4909 18.5137V18.0024" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.9499 18.0025C19.0842 18.0025 20.0037 17.0829 20.0037 15.9486V15.9486C20.0033 15.3724 19.7745 14.8198 19.3675 14.412L18.0029 13.0484V8.99872C18.0029 5.68363 15.3155 2.99622 12.0004 2.99622V2.99622C8.68531 2.99622 5.9979 5.68363 5.9979 8.99872V13.0484L4.63334 14.412C4.22632 14.8198 3.99753 15.3724 3.99707 15.9486V15.9486C3.99707 16.4933 4.21346 17.0157 4.59863 17.4009C4.9838 17.7861 5.50621 18.0025 6.05093 18.0025H17.9499Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                    </a>
                    @include('components.main.header_notification')
                </div>
                <div class="dbl-btns dbl-btns-5 align-items-center">
                    @if(auth()->check() && auth()->user()->notReadMessages->count()>0)
                        <a href="{{route('main.profile.chat.index')}}"
                           class="btn btn--sm btn--transp px-6 radius-3 hidden-992 notification" @if(isset(request()->order))data-url="{{route('main.profile.chat.message-read',['order'=>request()->order->id])}}" @endif id="message-notifications"
                           data-messages="{{auth()->user()->notReadMessages->count()}}"
                        >
                            @else
                                <a href="{{route('main.profile.chat.index')}}"
                                   class="btn btn--sm btn--transp px-6 radius-3 hidden-992">
                                    @endif
                                    <span class="ico ico-24">
                     <img src="{{asset('main/img/icons/ico-message2.svg')}}" alt="">
                  </span>
                                </a>
                                <a href="{{route('main.profile.user.likes')}}"
                                   class="btn btn--sm btn--transp px-6 radius-3 hidden-992">
                  <span class="ico ico-24">
                     <img src="{{asset('main/img/icons/ico-heart.svg')}}" alt="">
                  </span>
                                </a>
                                {{--                    <a href="#" class="btn btn--sm btn--transp px-6 radius-3 hidden-992">--}}
                                {{--                  <span class="ico ico-24">--}}
                                {{--                     <img src="{{asset('main/img/icons/ico-bag.svg')}}" alt="">--}}
                                {{--                  </span>--}}
                                {{--                    </a>--}}
                                <div class="user-dropdown dropdown btn hidden-992">
                                    @if(auth()->check())
                                        <a href="{{route('main.profile.lender.overview')}}"
                                           class="btn--sm -ttu dropdown-btn">
                                            <div class="wrapper-image photo-30 r-300">
                                                <img src="{{asset(auth()->user()->info->avatar)}}"/>
                                            </div>
                                            <span class="info ml-15">
                        {{auth()->user()->info->name}}
                         </span>
                                        </a>
                                    @else
                                        <a href="{{route('main.security.login.form')}}"
                                           class="btn btn--transp btn--sm -ttu radius-3 hidden-992">
                  <span class="info">
                     Login
                  </span>
                                        </a>
                                        <a href="{{route('main.security.registration.form')}}"
                                           class="btn btn--dark btn--sm radius-3 -ttu hidden-992">
                  <span class="info">
                     Sign Up
                  </span>
                                        </a>
                                    @endif
                                    <div class="dropdown--body"></div>
                                </div>
                </div>
                <div class="header__burger" data-burger>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
    <div class="header--item bg-yellow-100 hidden-768">
        <div class="flex-auto d-flex">
            <div class="header--option w-100 justify-content-center">
                @include('components.main.menu.desktop')
            </div>
        </div>
    </div>
</header>

<div class="header-mob">
    <div class="header-mob--header">
        <a href="#" class="header-mob--close" data-burger>
         <span class="ico">
            <img src="{{asset('main/img/icons/icon-close.svg')}}"/>
         </span>
        </a>
        <a href="{{route('main.home')}}" class="logo">
            <img src="{{asset('main/img/images/logo-small.svg')}}" alt="">
        </a>
    </div>
    <div class="visible-480 search-container">
        <form class="input-search-form w-100" action="{{route('main.product.search')}}">
            <label class="relative">
                <input type="text" data-url="{{route('main.product.search')}}" name="search"
                       value="{{request()->get('search')}}" class="product-search input-search-window w-100"
                       placeholder="Search for anything...">
                <button type="submit" class="form-search__btn">
                    <img src="{{asset('main/img/icons/icon-search.svg')}}">
                </button>
            </label>
            <ul class="search-window product-search-window">
            </ul>
        </form>
    </div>
    <div class="header-mob--body">
        <div class="header-mob-item visible-992">
            <div class="dbl-btns dbl-btns-5">

                <div class="visible-992 menu--item">
                    <div class="dbl-btns">
                        <a href="{{route('main.profile.chat.index')}}"
                           class="btn btn--sm btn--transp px-6 radius-3 mb-3 justify-content-start bb-none-390">
                     <span class="ico ico-24 mr-10">
                           <img src="{{asset('main/img/icons/ico-message2.svg')}}" alt="">
                     </span>
                            <span class="info -ttu">My Messages</span>
                        </a>
                        <a href="{{route('main.profile.user.likes')}}"
                           class="btn btn--sm btn--transp px-6 radius-3 mb-3 justify-content-start">
                     <span class="ico ico-24 mr-10">
                        <img src="{{asset('main/img/icons/ico-heart.svg')}}" alt="">
                     </span>
                            <span class="info -ttu">My Likes</span>
                        </a>
                        <a href="#" class="btn btn--sm btn--transp px-6 radius-3 mb-3 justify-content-start">
                     <span class="ico ico-24 mr-10">
                         <img src="{{asset('main/img/icons/ico-bag.svg')}}" alt="">
                     </span>
                            <span class="info -ttu">My Card</span>
                        </a>
                    </div>
                </div>

                <div class="visible-768 menu--item">
                    <div class="dbl-btns">
                        <a href="{{route('main.help-center.question',['question'=>2])}}"
                           class="btn btn--transp btn--sm -ttu radius-3 mb-3 justify-content-start">
                     <span class="ico ico-24 mr-8">
                        <img src="{{asset('main/img/icons/ico-message.svg')}}" alt="">
                     </span>
                            <span class="info">
                        How It Works
                     </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-mob-item visible-768">
            <nav class="header__menu flex-column">
                <h3 class="ttu fw-900 mb-15 pe-3 header__menu__heading">
                    Categories
                </h3>
                @include('components.main.menu.mobile')
            </nav>
        </div>
    </div>
    <div class="header-mob--footer">
        <div class="visible-992 menu--item">
            <div class="dbl-btns dbl-btns--row">
                <div class="flex-100">
                    <div class="visible-992 menu--item">
                        <div class="user-dropdown dropdown btn r-3">
                            @if(auth()->check())
                                <a href="{{route('main.profile.lender.overview')}}"
                                   class="btn btn--sm -ttu btn--transp dropdown-btn">
                                    <div class="wrapper-image photo-30 r-300">
                                        <img src="{{asset(auth()->user()->info->avatar)}}"/>
                                    </div>
                                    <span class="info ml-15">
                           {{auth()->user()->info->name}}
                        </span>
                                </a>
                            @else
                                <div>
                                    <a href="{{route('main.security.login.form')}}"
                                       class="btn btn--dark btn--sm radius-3 -ttu mb-3 w-100">

                  <span class="info">
                     Login
                  </span>
                                    </a>
                                </div>
                                <div>
                                    <a href="{{route('main.security.registration.form')}}"
                                       class="btn btn--warning btn--sm radius-3 ttu mb-3 w-100">
                  <span class="info">
                     Sign Up
                  </span>
                                    </a>
                                </div>
                            @endif
                            <div class="dropdown--body"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="overlay" data-burger></div>
