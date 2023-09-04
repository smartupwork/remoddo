<aside class="category-page__aside">
    <a href="" class="btn sidebar-open d-lg-none">
        <div class="user_avatar_wrpr">
            <img src="{{asset(auth()->user()->info->avatar)}}" alt="">
        </div>
    </a>
    <a href="" class="btn sidebar-close  d-lg-none"><img src="{{asset('main/img/icons/icon-close.svg')}}"></a>

    <div class="category-page__aside-container">
        <div class="profile-user">
            <div class="d-flex align-items-center">
                <div class="user_avatar_wrpr">
                    <img src="{{asset(auth()->user()->info->avatar)}}" alt="">
                </div>
                <h3>{{auth()->user()->info->full_name}}</h3>
            </div>
            <a href="{{route('main.security.logout')}}">
                <img src="{{asset('main/img/icons/logout.svg')}}" alt="">
            </a>
        </div>
        <div class="mt-3 d-flex justify-content-between align-items-center">
            <span class="fw-700">Lend</span>
            <label class="switch">
                <input type="checkbox"  data-role="{{$role}}" id="checkbox-switcher"
                >
                <span class="slider round change_sidebar" data-url="{{route('main.profile.sidebar-change',['role'=>'renter'])}}"></span>
            </label>
            <span class="fw-700">Rent</span>
        </div>
        <ul class="sidebar_nav mt-20 mb-16">
            @foreach(config('profile-sidebar.renter') as $key=>$menu)
                @php
                    $url= !empty($menu['url']) ? route($menu['url'])  : ''
                @endphp
                <li>
                    <a href="{{$url}}"  @if(url()->current()===$url) class="active" @endif>
                        <div class="icon_wrpr">
                            <img src="{{asset($menu['icon'])}}" alt="">
                        </div>
                        {{$key}}
                    </a>
                </li>
            @endforeach
            <li class="devider_line"></li>
            @include('main.sections.pages.profile.sidebar_questions')
        </ul>
        <ul class="info-rent-list mt-auto">
            <li class="d-flex align-items-center mb-16">
                <div class="d-flex align-items-start flex-auto">
                                    <span class="flex min-w-20">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.5867 15.2467C16.1025 15.7625 16.1025 16.5983 15.5867 17.1133C15.0708 17.6292 14.235 17.6292 13.72 17.1133C13.2042 16.5975 13.2042 15.7617 13.72 15.2467C14.2358 14.7308 15.0717 14.7308 15.5867 15.2467" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M6.42 15.2467C6.93583 15.7625 6.93583 16.5983 6.42 17.1133C5.90417 17.6292 5.06833 17.6292 4.55333 17.1133C4.03833 16.5975 4.0375 15.7617 4.55333 15.2467C5.06917 14.7317 5.90417 14.7308 6.42 15.2467" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M8.33333 3.33337H11.6667C12.1267 3.33337 12.5 3.70671 12.5 4.16671V12.5H1.66667" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M4.16667 16.18H2.5C2.04 16.18 1.66667 15.8067 1.66667 15.3467V10.8334" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12.5 5.83337H16.1025C16.4433 5.83337 16.75 6.04087 16.8758 6.35754L18.2142 9.70254C18.2925 9.89921 18.3333 10.1092 18.3333 10.3209V15.2775C18.3333 15.7375 17.96 16.1109 17.5 16.1109H15.9742" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M13.3333 16.1833H6.80833" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M18.3333 11.6667H15V8.33337H17.6667" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M1.66667 3.33335H5.83333" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M1.66667 5.83335H4.16667" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M2.5 8.33335H1.66667" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                    <p class="fs-14 fw-600 px-12">{!! \App\Models\Setting::get('rent_3')!!}</p>
                </div>
            </li>
            <li class="d-flex align-items-center ">
                <div class="d-flex align-items-start flex-auto">
                                    <span class="flex min-w-20">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.25 2.5V5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M13.75 2.5V5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M8.33333 17.5H5C3.61929 17.5 2.5 16.3807 2.5 15V6.25C2.5 4.86929 3.61929 3.75 5 3.75H15C16.3807 3.75 17.5 4.86929 17.5 6.25V9.16667" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M13.3333 17.5L11.6667 15.8333L13.3333 14.1666" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M11.6667 15.8333H15.4167C16.5673 15.8333 17.5 14.9006 17.5 13.75V13.75C17.5 12.5994 16.5673 11.6666 15.4167 11.6666H13.3333" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                    <p class="fs-14 fw-600 px-12">{!! replace_setting_value('{late_fee}',late_fee(),\App\Models\Setting::get('rent_2'))!!}</p>
                </div>
            </li>

        </ul>
    </div>
</aside>
