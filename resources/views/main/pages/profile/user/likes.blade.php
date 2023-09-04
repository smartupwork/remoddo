@extends('main.layouts.main')
@section('wrapper_class')
    pt-header
@endsection

@section('title') My Likes @endsection

@section('content')

        <div class="container container-xl">
            <div class="category-page">
                @include('main.sections.pages.profile.user.sidebar')
                <div class="category-page__content">
                    @include('components.main.product.sorting',['title'=>'My Likes'])
                     <div class="row gutters-30">
                        @if($likeProducts->count())
                      @foreach($likeProducts as $product)
                            <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                                <div class="d-flex flex-column">
                                    <a href="{{route('main.product.detail',['product'=>$product->id])}}" class="relative mb-20 product-image">
                                        <img src="{{asset($product->image)}}" alt="{{$product->title}}">
                                        <button type="button" data-product-url="{{route('main.product.like',['product'=>$product->id])}}" class="btn btn--light-dark like_product btn--sm-rounded rounded border-none btn-46 absolute blur right-15 top-5">
                                            @if($product->is_liked)
                                                <img src="{{asset('main/img/icons/heart.svg')}}" alt="">
                                            @else
                                                <img src="{{asset('main/img/icons/heart.svg')}}" alt="">
                                            @endif


                                        </button>
                                    </a>
                                    <span class="fw-700 color-light uppercase fs-14 mb-2">{{$product->brand->title}}</span>
                                    <span class="fw-700 mb-4">{{$product->title}}</span>
                                    <h4 class="fw-800">RENT FROM £{{$product->price}}</h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{$likeProducts->links('vendor.pagination.main.remodo')}}
                    @else
                        <div>
                            <h4 class="error-message">NOT FOUND</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>

@endsection
@push('scripts')
    <script src="{{asset('main/js/product-sorting.js')}}"></script>
@endpush
