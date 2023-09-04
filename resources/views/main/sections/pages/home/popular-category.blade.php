@if($popular_categories->count()>0)
<section class="section pt-70">
    <div class="container">
        <div class="slider-head mb-10">
            <h3 class="ttu fw-900 mb-20 pe-3">Popular Categories</h3>
            <a href="" class="btn btn--dark btn--sm radius-3 ttu mb-20">
                <span class="info">
                    View All
                </span>
            </a>
        </div>
        <div class="slader-category-wrapper relative">
            <div class="btn category-btn-next ">
                <img src="{{asset('main/img/icons/arrow-slider-next.svg')}}" alt="">
            </div>
            <div class="btn category-btn-prev">
                <img src="{{asset('main/img/icons/arrow-slider-prev.svg')}}" alt="">
            </div>
            <div class="swiper slider-categoryes">
                <div class="swiper-wrapper">
                    @foreach($popular_categories as $category)
                    <div class="swiper-slide">
                        <div class="d-flex flex-column">
                            <div class="mb-3 category-image">
                                <img src="{{asset($category->image)}}" alt="{{$category->title}}">
                            </div>
                            <span class="fw-800 uppercase">{{$category->title}}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination swiper-pagination-static"></div>
            </div>
        </div>
    </div>
</section>
@endif
