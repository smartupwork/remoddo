<header class="header">
    <div class="container header__container">
        <div class="header__body">
            <a href="{{route('home')}}" class="logo">
                <img src="{{asset('front/img/logo.svg')}}" alt="">
                <span>CryptoDoggies</span>
            </a>
            <nav class="header__nav">
                <ul class="header__menu menu">
                    @foreach ($headerMenu as $item)
                        @if ($item->children->isEmpty())
                            <li class="drop-menu">
                                <a href="{{url($item->link)}}" class="">
                                    {{$item->title}}
                                </a>
                            </li>
                        @else
                            <li class="drop-menu" data-dropdown="">
                                <a href="#" data-dropdown-btn="" class="">
                                    {{$item->title}}
                                    <span class="menu-arrow"><img src="{{asset('front/img/arrow-down.svg')}}" alt=""></span>
                                </a>
                                <div class="body-dropdown" data-dropdown-body="">
                                    <ul class="nav-dropdown">
                                        @foreach ($item->children as $subItem)
                                            <li>
                                                <a href="{{url($subItem->link)}}">{{$subItem->title}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <div class="header__social social">
                    <a href="{{\App\Models\Setting::get('twitter_link')}}" target="_blank" class="social__link">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.7025 4.11418C19.0067 4.42251 18.2592 4.63085 17.4733 4.72501C18.2842 4.23984 18.8908 3.47624 19.18 2.57668C18.4182 3.02917 17.5844 3.34768 16.715 3.51835C16.1303 2.89407 15.3559 2.48029 14.5119 2.34124C13.668 2.2022 12.8017 2.34567 12.0477 2.74939C11.2936 3.15311 10.694 3.79448 10.3418 4.57393C9.9896 5.35338 9.9046 6.2273 10.1 7.06001C8.5564 6.98251 7.04635 6.5813 5.66784 5.88243C4.28934 5.18356 3.07319 4.20265 2.09832 3.00335C1.76499 3.57835 1.57332 4.24501 1.57332 4.95501C1.57295 5.59418 1.73035 6.22355 2.03155 6.78729C2.33276 7.35103 2.76846 7.83171 3.29999 8.18668C2.68355 8.16707 2.08072 8.0005 1.54166 7.70085V7.75085C1.54159 8.6473 1.85168 9.51616 2.41931 10.21C2.98693 10.9039 3.77713 11.38 4.65582 11.5575C4.08398 11.7123 3.48444 11.7351 2.90249 11.6242C3.1504 12.3955 3.63332 13.07 4.28363 13.5533C4.93394 14.0365 5.71909 14.3043 6.52916 14.3192C5.15402 15.3987 3.45573 15.9843 1.70749 15.9817C1.39781 15.9818 1.08839 15.9637 0.780823 15.9275C2.55539 17.0685 4.62111 17.674 6.73082 17.6717C13.8725 17.6717 17.7767 11.7567 17.7767 6.62668C17.7767 6.46001 17.7725 6.29168 17.765 6.12501C18.5244 5.57582 19.1799 4.89576 19.7008 4.11668L19.7025 4.11418Z" fill="currentColor"></path>
                        </svg>
                    </a>
                    <a href="{{\App\Models\Setting::get('discord_link')}}" target="_blank" class="social__link">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_4_53)">
                            <path d="M16.9308 3.74333C15.6558 3.16833 14.2892 2.74333 12.86 2.50167C12.8473 2.49922 12.8341 2.5008 12.8223 2.50617C12.8105 2.51155 12.8007 2.52046 12.7942 2.53167C12.6192 2.83916 12.4242 3.24 12.2875 3.55666C10.7718 3.3302 9.23076 3.3302 7.715 3.55666C7.56278 3.20572 7.39113 2.86352 7.20084 2.53167C7.19439 2.52032 7.18463 2.51121 7.17287 2.50555C7.1611 2.49989 7.1479 2.49795 7.135 2.5C5.70667 2.74166 4.34 3.16667 3.06417 3.7425C3.05319 3.7471 3.04389 3.75495 3.0375 3.765C0.444171 7.5775 -0.266663 11.2958 0.0825038 14.9675C0.0834754 14.9765 0.0862667 14.9852 0.0907079 14.9931C0.0951491 15.0009 0.101147 15.0078 0.108337 15.0133C1.622 16.1154 3.31028 16.9548 5.1025 17.4967C5.115 17.5005 5.12836 17.5005 5.14085 17.4966C5.15334 17.4928 5.16437 17.4852 5.1725 17.475C5.55817 16.9592 5.89992 16.412 6.19417 15.8392C6.19826 15.8313 6.20061 15.8227 6.20107 15.8139C6.20154 15.8051 6.2001 15.7963 6.19686 15.788C6.19362 15.7798 6.18865 15.7724 6.18229 15.7663C6.17594 15.7601 6.16833 15.7554 6.16 15.7525C5.62167 15.5498 5.10007 15.3051 4.6 15.0208C4.59102 15.0157 4.58345 15.0084 4.57797 14.9996C4.57249 14.9909 4.56928 14.9809 4.56861 14.9705C4.56795 14.9602 4.56987 14.9499 4.57418 14.9405C4.5785 14.9311 4.58508 14.9229 4.59334 14.9167C4.69834 14.8392 4.80334 14.7583 4.90334 14.6775C4.91234 14.6702 4.92318 14.6656 4.93466 14.6641C4.94613 14.6627 4.95779 14.6644 4.96834 14.6692C8.24084 16.1392 11.785 16.1392 15.0192 14.6692C15.0297 14.6641 15.0415 14.6621 15.0532 14.6635C15.0648 14.6648 15.0758 14.6694 15.085 14.6767C15.185 14.7583 15.2892 14.8392 15.395 14.9167C15.4033 14.9228 15.41 14.9308 15.4145 14.9402C15.4189 14.9495 15.421 14.9598 15.4205 14.9701C15.42 14.9804 15.417 14.9904 15.4116 14.9993C15.4063 15.0082 15.3989 15.0156 15.39 15.0208C14.8917 15.3075 14.3733 15.55 13.8292 15.7517C13.8208 15.7547 13.8132 15.7595 13.8068 15.7657C13.8005 15.7719 13.7955 15.7794 13.7923 15.7877C13.789 15.796 13.7876 15.8048 13.7881 15.8137C13.7886 15.8226 13.7909 15.8313 13.795 15.8392C14.095 16.4117 14.4383 16.9567 14.8158 17.4742C14.8237 17.4848 14.8346 17.4927 14.8471 17.4969C14.8597 17.5011 14.8732 17.5013 14.8858 17.4975C16.6811 16.9572 18.3722 16.1173 19.8875 15.0133C19.8949 15.0082 19.9011 15.0015 19.9057 14.9937C19.9103 14.986 19.9132 14.9773 19.9142 14.9683C20.3308 10.7233 19.2158 7.035 16.9567 3.76666C16.9511 3.75604 16.942 3.74776 16.9308 3.74333ZM6.68334 12.7317C5.69834 12.7317 4.88584 11.8408 4.88584 10.7483C4.88584 9.655 5.6825 8.765 6.68334 8.765C7.69167 8.765 8.49667 9.6625 8.48084 10.7483C8.48084 11.8417 7.68417 12.7317 6.68334 12.7317ZM13.3292 12.7317C12.3433 12.7317 11.5317 11.8408 11.5317 10.7483C11.5317 9.655 12.3275 8.765 13.3292 8.765C14.3375 8.765 15.1425 9.6625 15.1267 10.7483C15.1267 11.8417 14.3383 12.7317 13.3292 12.7317Z" fill="currentColor"></path>
                            </g>
                            <defs>
                            <clipPath id="clip0_4_53">
                            <rect width="20" height="20" fill="white"></rect>
                            </clipPath>
                            </defs>
                        </svg>
                    </a>
                </div>
            </nav>
			@auth
                <div class="header__user-btn d-none-768">
                    <a href="{{route('profile.index')}}" class="btn btn-white btn-sm mr-15">
                        <span class="btn-icon btn-icon-24"><img src="{{$currentUser->avatar()}}" alt=""></span>
                        <span>{{$currentUser->name}}</span>
                    </a>
                    <a href="{{route('nfts.create')}}" class="btn btn-warning btn-sm">
                        <span class="btn-icon">Mint NFT</span>
                        <img src="{{asset('front/img/icon-btn-arrow-right.svg')}}" alt="">
                    </a>
                </div>
			@else
				<a href="#" class="btn btn-warning btn-sm" data-modal="#modal-01">
					Connect Wallet
				</a>
			@endif
            <div class="header__burger">
                <span></span>
            </div>
        </div>
    </div>
</header>
