@extends('main.layouts.main-intro')
@section('title'){{$page->title}}@endsection
@section('keywords'){{$page->meta_keywords}}@endsection
@section('description'){{$page->meta_description}}@endsection

@section('main_tag_class') mt-header @endsection


@section('content')
        @include("main.sections.pages.home.home-intro")
        @include("main.sections.pages.home.popular-category")
        @include("main.sections.pages.home.trending-product")
        @include("main.sections.pages.home.landed-category")
        @include("main.sections.pages.home.dop-block")
        @include("main.sections.pages.home.what-is")
@endsection
