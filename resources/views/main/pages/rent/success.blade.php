@extends('main.layouts.main-singleproduct',['prev_url'=>route('main.profile.lender.overview')])
@section('wrapper_class') pt-header @endsection
@section('main_tag_class') single-page @endsection
@section('title') Rent Payment @endsection
@section('content')
    <div class="center-block pb-40">
        <h3 class="fw-900 uppercase mb-14 text-center">Success!</h3>
        <p class="text-center mb-30">Thank you for your request. You will get a notification when the lender responds to your request.</p>
        <div class="d-flex flex-wrap justify-content-center-">
            <a href="{{route('main.profile.lender.overview')}}" class="btn btn--warning btn--sm radius-3 mt-10 mr-12 ttu">To my Profile</a>
            <a href="{{route('main.home')}}" class="btn btn--dark btn--sm radius-3 mt-10 ttu">To Home Page</a>
        </div>
    </div>
@endsection
