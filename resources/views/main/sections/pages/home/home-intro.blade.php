<section class="pt-50 pb-20 bg-gray">
    <div class="container-xl">
        <div class="swiper intro-swiper hidden-768">
            <div class="swiper-wrapper">

                @foreach($page->show("sliders:items") as $slider)


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
        <div class="swiper intro-swiper-cards visible-768">
            <div class="swiper-wrapper">
                @foreach($page->show("sliders:items") as $slider)
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
</section>
