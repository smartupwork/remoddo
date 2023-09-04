@extends('main.layouts.main')
@section('wrapper_class')
    pt-header
@endsection

@section('title')
    {{$title}}
@endsection
@section('content')

        <div class="container container-xl">
            <div class="category-page">

                @include('components.main.product_filter')

                <div class="category-page__content">
                    <div class="d-flex align-items-center flex-wrap justify-content-between flex-md-nowrap">
                        <ul class="breadcrambs mb-4">
                            <li>
                                <a href="">Home</a>
                            </li>
                            <li>
                                <span>{{$title}}</span>
                            </li>
                        </ul>
                        <span class="fs-14 text-light ps-3 mb-4">{{$productCount}} results</span>
                    </div>
                    @include('components.main.product.sorting')

                    <div class="row gutters-30">
                        
                        @if($products->count())
                       
                        @forelse($products as $product)
                                @if($product->is_rented==1)
                                    @php
                                        $lable_class='lable';
                                        $rented_html='<div class="pill item-status-label" style="z-index:1">
                                                        Not Available
                                                    </div>';
                                    @endphp
                                @else
                                    @php
                                        $lable_class='';
                                        $rented_html='';
                                    @endphp
                                @endif
                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                            <div class="d-flex flex-column">
                                <a
{{--                                    data-redirect-url="{{url()->current()}}"--}}
{{--                                   data-redirect-title="{{$title}}"--}}
{{--                                   data-url="{{route('main.product.previous-page')}}"--}}
                                   href="{{route('main.product.detail',['product'=>$product->id])}}" class="relative {{$lable_class}} mb-20 product-image ">
                                    <img src="{{asset($product->image)}}" alt="{{$product->title}}">
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
                     {{$products->links('vendor.pagination.main.remodo')}}
                    @else
                        <div>
                            <h4 class="error-message">PRODUCTS NOT FOUND</h4>
                        </div>

                    @endif
                    @include("main.sections.pages.home.dop-block")
                </div>
            </div>
        </div>
@endsection
@push('scripts')
    <script src="{{asset('main/js/product-click.js')}}"></script>
@endpush
