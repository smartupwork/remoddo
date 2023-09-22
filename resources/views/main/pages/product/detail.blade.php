@extends('main.layouts.main')
@section('main_tag_class')
    mt-header
@endsection
@section('title')
    {{ $product->title }}
@endsection
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* *{
          margin: 0px;
          padding: 0px;
          font-family: poppins;
          box-sizing: border-box;
      } */
        a {
            text-decoration: none;
        }

        #testimonials {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
        }

        .testimonial-heading {
            letter-spacing: 1px;
            margin: 30px 0px;
            padding: 10px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .testimonial-heading span {
            font-size: 2.8rem;
            font-weight: 900;
            color: #252525;
            margin-bottom: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .testimonial-box-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            width: 100%;
        }

        .testimonial-box {
            width: 60%;
            box-shadow: 2px 2px 30px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            padding: 20px;
            margin: 15px;
            cursor: pointer;
        }

        .profile-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 10px;
        }

        .profile-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .profile {
            display: flex;
            align-items: center;
        }

        .name-user {
            display: flex;
            flex-direction: column;
        }

        .name-user strong {
            color: #3d3d3d;
            font-size: 2.1rem;
            letter-spacing: 0.5px;
        }

        .name-user span {
            color: #979797;
            font-size: 0.8rem;
        }

        .reviews {
            color: #f9d71c;
        }

        .box-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .client-comment p {
            padding-left: 69px;
            font-weight: 400;
            color: #4b4b4b;
        }

        .testimonial-box:hover {
            transform: translateY(-10px);
            transition: all ease 0.3s;
        }

        @media(max-width:1060px) {
            .testimonial-box {
                width: 45%;
                padding: 10px;
            }
        }

        @media(max-width:790px) {
            .testimonial-box {
                width: 100%;
            }

            .testimonial-heading h1 {
                font-size: 1.4rem;
            }
        }

        @media(max-width:340px) {
            .box-top {
                flex-wrap: wrap;
                margin-bottom: 10px;
            }

            .reviews {
                margin-top: 10px;
            }
        }

        ::selection {
            color: #ffffff;
            background-color: #252525;
        }
    </style>
    @if ($product->is_rented == 1)
        @php
            $rented_html = '<div class="pill item-status-label">Not Available</div>';
            $disabled_btn = 'btn-disabled';
        @endphp
    @else
        @php
            $disabled_btn = '';
            $rented_html = '';
        @endphp
    @endif
    @if (auth()->check() && auth()->user()->id == $product->lender_id)
        @php
            $disabled_btn = 'btn-disabled';
        @endphp
    @endif
    <section>
        <div class="container-xl">
            <div class="category-page flex-column border-bottom px-10">
                <div class="d-flex align-items-center mb-5">
                    <ul class="breadcrambs">
                        <li>
                            <a href="{{ route('main.home') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ $redirect_url }}" style="z-index: 20">{{ $redirect_title }}</a>
                        </li>
                        <li>
                            <span class="fw-700">{{ $product->title }}</span>
                        </li>
                    </ul>
                </div>
                <div class="row gutters-80">
                    <div class="col-md-6">
                        <div class="d-flex">
                            <div class="swiper-pagination-images"></div>
                            <div class="swiper vertical-swiper px-10">
                                <div class="swiper-wrapper">
                                    {!! $rented_html !!}
                                    @if ($product->images->first())
                                        @foreach ($product->images as $image)
                                            <div class="swiper-slide" data-image="{{ asset($image->image) }}">
                                                <img class="product_detail_images" src="{{ asset($image->image) }}"
                                                    alt="{{ $product->title }}">
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="swiper-slide" data-image="{{ asset($product->image) }}">
                                            <img class="product_detail_images" src="{{ asset($product->image) }}"
                                                alt="{{ $product->title }}">
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-column pb-4 border-bottom">
                            <h4 class="fw-800 uppercase mb-2">{{ $product->title }}</h4>
                            <span class="fs-14 fw-700 mb-2 color-light uppercase">{{ $product->brand->title }}</span>
                        </div>
                        <div class="d-flex flex-column mb-20 py-20 border-bottom">
                            <div class="d-flex">
                                <span class="fw-800 me-3">Rent</span>
                                <span class="fw-600">from £{{ $product->price }}</span>
                            </div>
                            <div class="d-flex justify-content-between mt-20 flex-wrap">
                                <div class="d-flex mb-4px flex-wrap mr-10">

                                    @foreach ($product->rents as $rent)
                                        <a href="{{ route('main.rent.shipping-form', ['rent' => $rent->id]) }}"
                                            class="btn {{ $disabled_btn }} btn--warning btn--sm radius-3 ttu mr-8 mb-2px rent-popup"
                                            data-day="{{ $rent->day }}" data-modal="#select-date">
                                            {{ $rent->day }}- £{{ $rent->rent_price }}
                                        </a>
                                    @endforeach

                                    <a href=""
                                        data-product-url="{{ route('main.product.like', ['product' => $product->id]) }}"
                                        class="btn like_product btn--dark btn--sm radius-3 ttu mb-2px">
                                        <span class="pe-3">I like</span>
                                        @if ($product->is_liked)
                                            <img src="{{ asset('main/img/icons/heart.svg') }}" alt="">
                                        @else
                                            <img src="{{ asset('main/img/icons/heart-white.svg') }}" alt="">
                                        @endif
                                    </a>
                                </div>
                                <div class="d-flex align-items-center">
                                    <img class="w-40 h-40 r-300 mr-12" src="{{ asset($product->lender->info->avatar) }}"
                                        alt="">
                                    <div class="item-renter">
                                        <span
                                            class="item-renter__name uppercase">{{ $product->lender->info->full_name }}</span>
                                        <div class="item-renter__rating">
                                            <img src="{{ asset('main/img/icons/icon-star.svg') }}">
                                            <span class="pl-5">{{ $product->lender->rating }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <h4 class="fw-800 mb-3">Item Description</h4>
                            <p class="lh-28 mb-20">
                                {{ $product->description }}
                            </p>
                            {{--                            <div class="d-flex justify-content-between mb-3"> --}}
                            {{--                                <span class="fw-800 lh-28 uppercase">Location</span> --}}
                            {{--                                <span class="fw-600 lh-28">{{$product->address}}</span> --}}
                            {{--                            </div> --}}
                            @foreach ($attributes as $attribute)
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="fw-800 lh-28 uppercase">{{ $attribute['title'] }}</span>
                                    <span class="fw-600 lh-28">{{ $attribute['values'] }}</span>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-between">
                                <span class="fw-800 lh-28 uppercase">Minimum Rental Period</span>
                                <span class="fw-600 lh-28">{{ $product->period_day }} days</span>
                            </div>
                        </div>
                        <ul class="info-rent-list mt-auto">
                            <li class="d-flex align-items-center mb-16">
                                <div class="d-flex align-items-start flex-auto">
                                    <span class="flex min-w-20">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.5031 7.91581V5.41477C17.5031 4.2637 16.57 3.33057 15.4189 3.33057H4.58108C3.43 3.33057 2.49688 4.2637 2.49688 5.41477V6.66529"
                                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M17.5031 12.0842V14.5853C17.5031 15.7363 16.57 16.6695 15.4189 16.6695H10.8337"
                                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M1.6632 10.5002V16.1693C1.66415 16.9058 3.1562 17.5032 4.99792 17.5032C6.83964 17.5032 8.33169 16.9058 8.33264 16.1693V10.5002"
                                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M8.33169 10.5003C8.33169 11.2368 6.83869 11.8342 4.99697 11.8342C3.15525 11.8342 1.6632 11.2368 1.6632 10.5003C1.6632 9.76282 3.15715 9.16638 4.99792 9.16638C6.83869 9.16638 8.33169 9.76377 8.33264 10.5003"
                                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M1.66367 13.3347C1.66367 14.0712 3.15572 14.6686 4.99744 14.6686C6.83916 14.6686 8.33216 14.0712 8.33216 13.3347"
                                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M15.4189 7.91577H17.5031C17.9636 7.91577 18.3368 8.28902 18.3368 8.74945V11.2505C18.3368 11.7109 17.9636 12.0842 17.5031 12.0842H15.4189C14.2679 12.0842 13.3347 11.151 13.3347 9.99997V9.99997C13.3347 8.8489 14.2679 7.91577 15.4189 7.91577V7.91577Z"
                                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <p class="fs-14 fw-600 px-12">{!! replace_setting_value('{deposit_fee}', deposit_fee(), \App\Models\Setting::get('rent_1')) !!}</p>
                                </div>
                                <a href="{{ route('main.help-center.index') }}"
                                    class="btn btn--underline-warninng address-active fs-14  fw-700"
                                    style="white-space: nowrap;"> Learn More</a>
                            </li>
                            <li class="d-flex align-items-center mb-16">
                                <div class="d-flex align-items-start flex-auto">
                                    <span class="flex min-w-20">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.25 2.5V5" stroke="black" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M13.75 2.5V5" stroke="black" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M8.33333 17.5H5C3.61929 17.5 2.5 16.3807 2.5 15V6.25C2.5 4.86929 3.61929 3.75 5 3.75H15C16.3807 3.75 17.5 4.86929 17.5 6.25V9.16667"
                                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M13.3333 17.5L11.6667 15.8333L13.3333 14.1666" stroke="black"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M11.6667 15.8333H15.4167C16.5673 15.8333 17.5 14.9006 17.5 13.75V13.75C17.5 12.5994 16.5673 11.6666 15.4167 11.6666H13.3333"
                                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <p class="fs-14 fw-600 px-12">{!! replace_setting_value('{late_fee}', late_fee(), \App\Models\Setting::get('rent_2')) !!}</p>
                                </div>
                                <a href="{{ route('main.help-center.index') }}"
                                    class="btn btn--underline-warninng address-active fs-14  fw-700"
                                    style="white-space: nowrap;"> Learn More</a>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="d-flex align-items-start flex-auto">
                                    <span class="flex min-w-20">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.5867 15.2467C16.1025 15.7625 16.1025 16.5983 15.5867 17.1133C15.0708 17.6292 14.235 17.6292 13.72 17.1133C13.2042 16.5975 13.2042 15.7617 13.72 15.2467C14.2358 14.7308 15.0717 14.7308 15.5867 15.2467"
                                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M6.42 15.2467C6.93583 15.7625 6.93583 16.5983 6.42 17.1133C5.90417 17.6292 5.06833 17.6292 4.55333 17.1133C4.03833 16.5975 4.0375 15.7617 4.55333 15.2467C5.06917 14.7317 5.90417 14.7308 6.42 15.2467"
                                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M8.33333 3.33337H11.6667C12.1267 3.33337 12.5 3.70671 12.5 4.16671V12.5H1.66667"
                                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M4.16667 16.18H2.5C2.04 16.18 1.66667 15.8067 1.66667 15.3467V10.8334"
                                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M12.5 5.83337H16.1025C16.4433 5.83337 16.75 6.04087 16.8758 6.35754L18.2142 9.70254C18.2925 9.89921 18.3333 10.1092 18.3333 10.3209V15.2775C18.3333 15.7375 17.96 16.1109 17.5 16.1109H15.9742"
                                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M13.3333 16.1833H6.80833" stroke="black" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M18.3333 11.6667H15V8.33337H17.6667" stroke="black"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M1.66667 3.33335H5.83333" stroke="black" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M1.66667 5.83335H4.16667" stroke="black" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M2.5 8.33335H1.66667" stroke="black" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <p class="fs-14 fw-600 px-12">{!! \App\Models\Setting::get('rent_3') !!}</p>
                                </div>
                                <a href="{{ route('main.help-center.index') }}"
                                    class="btn btn--underline-warninng address-active fs-14 fw-700"
                                    style="white-space: nowrap;"> Learn More</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(count($reviews) > 0)
    <section id="testimonials">
        <div class="testimonial-heading">
            <span>Product Reviews</span>
        </div>
        @foreach ($reviews as $feed)
            <div class="testimonial-box">
                <div class="box-top">
                    <div class="profile">
                        <div class="profile-img">
                            <img src="{{ asset('main/img/' . $feed->user_image) }}" alt="User Image">
                        </div>
                        <div class="name-user">
                            <strong>{{ $feed->user_name }}</strong>
                        </div>
                    </div>
                    <div class="reviews">
                        @php
                            $starRating = $feed->star_rating; // Get the star rating from the review
                        @endphp

                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $starRating)
                                <i class="fa fa-star"></i>
                            @else
                                <i class="fa fa-star-o"></i>
                            @endif
                        @endfor
                    </div>
                </div>
                <div class="client-comment">
                    <p>{{ $feed->comments }}</p>
                </div>
            </div>
        @endforeach
    </section>
@endif
    <section class="section">
        <div class="container">
            <div class="slider-head mb-10">
                <h3 class="ttu fw-900 mb-20 pe-3">YOu might also like</h3>
                {{--                    <a href="{{route('main.category.products',['category'=>$category->slug])}}" --}}
                {{--                       class="btn btn--dark btn--sm radius-3 ttu mb-20"> --}}
                {{--                        <span class="info"> --}}
                {{--                            View All --}}
                {{--                        </span> --}}
                {{--                    </a> --}}
            </div>
            <div class="slider-pruduct-wrapper relative">
                <div class="btn category-btn-next ">
                    <img src="{{ asset('main/img/icons/arrow-slider-next.svg') }}" alt="">
                </div>
                <div class="btn category-btn-prev">
                    <img src="{{ asset('main/img/icons/arrow-slider-prev.svg') }}" alt="">
                </div>
                <div class="swiper slider-products">
                    <div class="swiper-wrapper">
                        @foreach ($random_products as $product)
                            @if ($product->is_rented == 1)
                                @php
                                    $lable_class = 'lable';
                                    $rented_html = '<div class="pill item-status-label">
                                                    Not Available
                                                </div>';
                                @endphp
                            @else
                                @php
                                    $lable_class = '';
                                    $rented_html = '';
                                @endphp
                            @endif
                            <div class="swiper-slide">

                                <div class="d-flex flex-column">
                                    <a href="{{ route('main.product.detail', ['product' => $product->id]) }}"
                                        class="relative {{ $lable_class }} mb-20 product-image">
                                        <img src="{{ asset($product->image) }}" alt="">
                                        <a href=""
                                            data-product-url="{{ route('main.product.like', ['product' => $product->id]) }}"
                                            class="btn like_product btn--light-dark btn--sm-rounded rounded border-none btn-46 absolute blur right-15 top-5">
                                            @if ($product->is_liked)
                                                <img src="{{ asset('main/img/icons/heart.svg') }}" alt="">
                                            @else
                                                <img src="{{ asset('main/img/icons/heart-white.svg') }}" alt="">
                                            @endif
                                        </a>
                                        {!! $rented_html !!}
                                    </a>
                                    <span
                                        class="fw-700 color-light uppercase fs-14 mb-2">{{ $product->brand_title }}</span>
                                    <span class="fw-700 mb-4">{{ $product->title }}</span>
                                    <h4 class="fw-800">RENT FROM £{{ $product->price }}</h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination swiper-pagination-static"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="slider-head mb-10">
                <h3 class="ttu fw-900 mb-20 pe-3">See more from
                    <a href="{{ route('main.product.lender', ['lender' => $product->lender_id]) }}"
                        class="btn--underline-warninng">
                        <span>{{ $product->lender->info->full_name }}</span></a>
                </h3>
                <a href="{{ route('main.product.lender', ['lender' => $product->lender_id]) }}"
                    class="btn btn--dark btn--sm radius-3 ttu mb-20">
                    <span class="info">
                        View All
                    </span>
                </a>
            </div>
            <div class="slider-pruduct-wrapper relative">
                <div class="btn category-btn-next ">
                    <img src="{{ asset('main/img/icons/arrow-slider-next.svg') }}" alt="">
                </div>
                <div class="btn category-btn-prev">
                    <img src="{{ asset('main/img/icons/arrow-slider-prev.svg') }}" alt="">
                </div>
                <div class="swiper slider-products">
                    <div class="swiper-wrapper">
                        @foreach ($lender_products as $product)
                            @if ($product->is_rented == 1)
                                @php
                                    $lable_class = 'lable';
                                    $rented_html = '<div class="pill item-status-label">
                                                    Not Available
                                                </div>';
                                @endphp
                            @else
                                @php
                                    $lable_class = '';
                                    $rented_html = '';
                                @endphp
                            @endif
                            <div class="swiper-slide">
                                <div class="d-flex flex-column">
                                    <a href="{{ route('main.product.detail', ['product' => $product->id]) }}"
                                        class="relative {{ $lable_class }} mb-20 product-image">
                                        <img src="{{ asset($product->image) }}" alt="">
                                        <a href=""
                                            data-product-url="{{ route('main.product.like', ['product' => $product->id]) }}"
                                            class="btn like_product btn--light-dark btn--sm-rounded rounded border-none btn-46 absolute blur right-15 top-5">
                                            @if ($product->is_liked)
                                                <img src="{{ asset('main/img/icons/heart.svg') }}" alt="">
                                            @else
                                                <img src="{{ asset('main/img/icons/heart-white.svg') }}" alt="">
                                            @endif
                                        </a>
                                        {!! $rented_html !!}
                                    </a>
                                    <span
                                        class="fw-700 color-light uppercase fs-14 mb-2">{{ $product->brand_title }}</span>
                                    <span class="fw-700 mb-4">{{ $product->title }}</span>
                                    <h4 class="fw-800">RENT FROM £{{ $product->price }}</h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination swiper-pagination-static"></div>
                </div>
            </div>
        </div>
    </section>
    @include('main.sections.pages.home.dop-block')

    @include('main.sections.pages.product.detail.popup')
@endsection
@push('scripts')
    <script src="{{ asset('main/js/rent-calendar.js') }}"></script>
@endpush
