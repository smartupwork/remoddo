@extends('main.layouts.main')
@section('title',$category->title)
@section('main_tag_class')
    mt-header
@endsection
@section('content')
    <section class="section">
        <div class="container container-xl">
            <div class="d-flex align-items-center flex-wrap justify-content-between flex-md-nowrap">
                <ul class="breadcrambs mb-2">
                    <li>
                        <a href="{{route('main.help-center.index')}}">Help Center</a>
                    </li>
                    <li>
                        <span>{{$category->title}}</span>
                    </li>
                </ul>
                <form class="input-search-form mw-300 w-100 mb-2">
                    <label class="relative">
                        <input type="text" class="input-search-window w-100 question-search"
                               data-url="{{route('main.help-center.question.search',$category)}}"
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
        <div class="container">
            <div class="mw-800 mx-auto">
                <h2 class="ttu fw-900 mb-20">{{$category->title}}</h2>
                @foreach($questions as $question)
                <a href="{{route('main.help-center.question',$question)}}" class="d-block mb-20">{{$question->question}}</a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{asset('main/js/help-center-question-search.js')}}"></script>
@endpush
