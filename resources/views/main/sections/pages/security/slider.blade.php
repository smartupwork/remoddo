<div class="login-page__images hidden-768">
    <div class="logonpage-big-logo">
        <img src="{{asset('main/img/images/Remoddo-big-logo.svg')}}" alt="">
    </div>
    <div class="swiper intro-swiper login-page-slider-init ">
        <div class="swiper-wrapper">
            @foreach($sliders as $slider)

            <div class="swiper-slide">
                <div class="intro-card">
                    <img class="intro-card__image" src="{{$slider['image']}}" alt="{{$slider['title']}}">
                    <div class="intro-card__label">
                        <img class="intro-card__icon" src="{{$slider['icon']}}" alt="{{$slider['title']}}">
                        <span class="intro-card__name">{{$slider['title']}}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination swiper-pagination-static"></div>
    </div>
</div>
