@extends('main.layouts.main')
@section('title','Help Center')
@section('main_tag_class')
    mt-header
@endsection
@section('content')


            <section class="section-2 bg-primary">
                <div class="container">
                    <h3 class="mb-4 text-center color-primary ttu fw-800">Ask us Anything</h3>
                    <form class="input-search-form mw-500 mx-auto">
                        <label class="relative">
                            <input type="text" class="input-search-window w-100 input-shadow category-search"
                                   data-url="{{route('main.help-center.category.search')}}"
                                   placeholder="Search for anything...">
                            <button type="submit" class="form-search__btn">
                                <img src="{{asset('main/img/icons/icon-search.svg')}}">
                            </button>
                        </label>
                        <ul class="search-window category-search-window">
                        </ul>
                    </form>
                </div>
            </section>

            <section class="section-2">
                <div class="container">
                    <div class="row gutters-40">
                        @foreach($categories as $category)
                        <div class="col-lg-4">
                            <div class="design-card w-100 px-40 py-5">
                                <div class="design-card--container">
                                    <h4 class="heading fw-900 -ttu mb-10">
                                        <span class="info">{{$category->title}}</span>
                                    </h4>
                                    <div class="mb-20">
                                        <p class="def-text def-text-2">
                                            {{$category->content}}
                                        </p>
                                    </div>
                                    <a href="{{route('main.help-center.category',$category)}}" class="btn btn--warning btn--md fw-800 radius-3 ttu font-inter">
                                    <span class="info ml-3">
                                        LEARN MORE
                                    </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
@endsection
@push('scripts')
    <script src="{{asset('main/js/help-center-category-search.js')}}"></script>
@endpush
