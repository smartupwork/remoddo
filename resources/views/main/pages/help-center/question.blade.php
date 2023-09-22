@extends('main.layouts.main')
@section('title',$question->question)
@section('main_tag_class','mt-header')
@section('title',$question->meta_title)
@section('description',$question->meta_description)
@section('keywords',$question->meta_title)
@section('content')
    <section class="section">
        <div class="container container-xl">
            <div class="d-flex align-items-center flex-wrap justify-content-between flex-md-nowrap">
                <ul class="breadcrambs mb-2">
                    <li>
                        <a href="{{route('main.help-center.index')}}">Help Center</a>
                    </li>
                    <li>
                        <a href="{{route('main.help-center.category',$question->category)}}">Fees & Payments</a>
                    </li>
                    <li>
                        <span>{{$question->question}}</span>
                    </li>
                </ul>
                <form class="input-search-form mw-300 w-100 mb-2">
                    <label class="relative">
                        <input type="text" class="input-search-window w-100 question-search"
                               data-url="{{route('main.help-center.question.search',$question->category)}}"
                               placeholder="Search...">
                        <button type="submit" class="form-search__btn">
                            <img src="{{asset('main/img/icons/icon-search.svg')}}">
                        </button>
                    </label>
                    <ul class="search-window question-search-window">

                    </ul>
                </form>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container container-xl">
            <div class="question-page">
                <aside class="category-page__aside">
                    <a href="" class="btn sidebar-open d-lg-none">
                        <div class="user_avatar_wrpr">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                                <g fill="currentColor" data-name="Question Mark">
                                    <path d="M32 56.735A24.735 24.735 0 1 1 56.736 32 24.764 24.764 0 0 1 32 56.735Zm0-46.47A21.735 21.735 0 1 0 53.736 32 21.76 21.76 0 0 0 32 10.265Z"/>
                                    <path d="M32 44.97a2.015 2.015 0 0 1-2-2 1.722 1.722 0 0 1 .04-.39 1.643 1.643 0 0 1 .11-.38 2.329 2.329 0 0 1 .19-.341 2.174 2.174 0 0 1 .55-.549 1.589 1.589 0 0 1 .34-.19 1.757 1.757 0 0 1 .38-.11 1.994 1.994 0 0 1 1.8.55 1.419 1.419 0 0 1 .25.3 2.329 2.329 0 0 1 .19.341 1.643 1.643 0 0 1 .11.38 1.722 1.722 0 0 1 .04.39 2.015 2.015 0 0 1-2 2zm-7.3-19.141a1.5 1.5 0 0 1-1.368-2.1c.085-.192 2.159-4.7 8.669-4.7a1.5 1.5 0 0 1 0 3c-4.491 0-5.877 2.815-5.934 2.935a1.515 1.515 0 0 1-1.367.865z"/>
                                    <path d="M32 38.9a1.5 1.5 0 0 1-1.5-1.5v-1.892c0-2.311 2.01-3.587 3.953-4.82 2.755-1.75 4.4-2.97 3.455-5.777-.18-.347-1.646-2.881-5.908-2.881a1.5 1.5 0 0 1 0-3c6.51 0 8.584 4.51 8.669 4.7.017.037.031.074.044.111 1.844 5.254-2.066 7.735-4.652 9.377-1.2.762-2.561 1.626-2.561 2.288V37.4a1.5 1.5 0 0 1-1.5 1.5Z"/>
                                </g>
                            </svg>
                        </div>
                    </a>
                    <a href="" class="btn sidebar-close  d-lg-none"><img src="img/icons/icon-close.svg"></a>

                    {{-- <div class="category-page__aside-container pt-60-992">
                        <p class="fs-12 ttu fw-900 mb-3">Articles in this section</p>
                        <ul class="question-page-list">
                            @foreach($question->category->questions as $category_question)
                            <li>
                                <a href="{{route('main.help-center.question',$category_question)}}" @if($category_question->id===$question->id) class="active" @endif>{{$category_question->question}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div> --}}

                </aside>
                <div class="question-page-content">
                    <div class="mw-800">
                        <h3 class="ttu fw-900 mb-4">{{$question->question}}</h3>
                        <p class="opacity-05 fs-14 mb-40 ">{{$question->updated_at->diffForHumans()}} • Updated</p>
                        <div class="mb-40 lh-28">
                            {!! $question->answer !!}
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" class="btn me-4">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22 12C22 6.48 17.52 2 12 2C6.48 2 2 6.48 2 12C2 16.84 5.44 20.87 10 21.8V15H8V12H10V9.5C10 7.57 11.57 6 13.5 6H16V9H14C13.45 9 13 9.45 13 10V12H16V15H13V21.95C18.05 21.45 22 17.19 22 12Z" fill="black" />
                                </svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{url()->current()}}" class="btn me-4">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22.46 6C21.69 6.35 20.86 6.58 20 6.69C20.88 6.16 21.56 5.32 21.88 4.31C21.05 4.81 20.13 5.16 19.16 5.36C18.37 4.5 17.26 4 16 4C13.65 4 11.73 5.92 11.73 8.29C11.73 8.63 11.77 8.96 11.84 9.27C8.28004 9.09 5.11004 7.38 3.00004 4.79C2.63004 5.42 2.42004 6.16 2.42004 6.94C2.42004 8.43 3.17004 9.75 4.33004 10.5C3.62004 10.5 2.96004 10.3 2.38004 10V10.03C2.38004 12.11 3.86004 13.85 5.82004 14.24C5.19077 14.4122 4.53013 14.4362 3.89004 14.31C4.16165 15.1625 4.69358 15.9084 5.41106 16.4429C6.12854 16.9775 6.99549 17.2737 7.89004 17.29C6.37367 18.4904 4.49404 19.1393 2.56004 19.13C2.22004 19.13 1.88004 19.11 1.54004 19.07C3.44004 20.29 5.70004 21 8.12004 21C16 21 20.33 14.46 20.33 8.79C20.33 8.6 20.33 8.42 20.32 8.23C21.16 7.63 21.88 6.87 22.46 6Z" fill="black" />
                                </svg>
                            </a>
                        </div>
                        <hr class="separator-hr mt-20 mb-40">
                        <div class="row gutters-40">
                            <div class="col-lg-6 lh-28">
                                <h4 class="ttu fw-900 mb-20">Recently viewed articles</h4>
                                @foreach($randomQuestions as $randomQuestion)
                                    <a href="{{route('main.help-center.question',$randomQuestion)}}" class="d-block mb-20">{{$randomQuestion->question}}</a>
                                @endforeach
                            </div>
                            <div class="col-lg-6 lh-28">
                                <h4 class="ttu fw-900 mb-20">Related articles</h4>
                                @foreach($lastQuestions as $lastQuestion)
                                <a href="{{route('main.help-center.question',$lastQuestion)}}" class="d-block mb-20">{{$lastQuestion->question}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{asset('main/js/help-center-question-search.js')}}"></script>
@endpush
