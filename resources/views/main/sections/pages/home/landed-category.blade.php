<section class="section">
    <div class="container">
        <div class="slider-head mb-10">
            <h3 class="ttu fw-900 mb-20 pe-3">Just Landed</h3>
            <a href="" class="btn btn--dark btn--sm radius-3 ttu mb-20">
                <span class="info">
                    View All
                </span>
            </a>
        </div>
        <div class="slider-pruduct-wrapper relative">
            <div class="btn category-btn-next ">
                <img src="{{asset('main/img/icons/arrow-slider-next.svg')}}" alt="">
            </div>
            <div class="btn category-btn-prev">
                <img src="{{asset('main/img/icons/arrow-slider-prev.svg')}}" alt="">
            </div>
            <div class="swiper slider-products">
                <div class="swiper-wrapper">
                    @foreach($random_products as $product)
                        @if($product->is_rented==1)
                            @php
                                $lable_class='lable';
                                $rented_html='<div class="pill item-status-label">
                                                Not Available
                                            </div>';
                            @endphp
                        @else
                            @php
                                $lable_class='';
                                $rented_html='';
                            @endphp
                        @endif
                    <div class="swiper-slide">
                        <div class="d-flex flex-column">
                            <a href="{{route('main.product.detail',['product'=>$product->id])}}" class="relative {{$lable_class}} mb-20 product-image">
                                <img src="{{asset($product->image)}}" alt="">
                                <button type="button" data-product-url="{{route('main.product.like',['product'=>$product->id])}}" class="btn btn--light-dark like_product btn--sm-rounded rounded border-none btn-46 absolute blur right-15 top-5">
                                    @if($product->is_liked)
                                        <img src="{{asset('main/img/icons/heart.svg')}}" alt="">
                                    @else
                                        <img src="{{asset('main/img/icons/heart-white.svg')}}" alt="">
                                    @endif
                                </button>
                                {!! $rented_html !!}
                            </a>
                            <span class="fw-700 color-light uppercase fs-14 mb-2">{{$product->brand_title}}</span>
                            <span class="fw-700 mb-4">{{$product->title}}</span>
                            <h4 class="fw-800">RENT FROM £{{$product->price}}</h4>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination swiper-pagination-static"></div>
            </div>
        </div>
    </div>
</section>
