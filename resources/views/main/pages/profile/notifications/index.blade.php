@extends('main.layouts.main')
@section('wrapper_class','pt-header')
@section('title','Finances')
@section('content')
    <div class="container container-xl">
        <div class="category-page notifications-page">
            @include('main.sections.pages.profile.user.sidebar')
            <div class="category-page__content">
                <h3 class="ttu fw-800 pe-4 mb-20">Notifications</h3>
{{--                <p class="fs-12 mb-2 ttu fw-700" style="opacity:.4">Today</p>--}}
                @foreach($notifications as $notification)
                <div class="notifications-drop-item ">
                    <div class="notifications-drop-item__img mr-14 align-self-start">
                        <img src="{{$notification->image}}" alt="">
                    </div>
                    <div class="notifications-drop-item__text-block flex-auto">
                        <div class="flex justify-between items-center mb-1">
                            <span class="fw-700 ">{{$notification->title}}</span>
                        </div>
                        <p class="fw-600 mb-2">{{$notification->context}}</p>
                        <span class="opacity-30 fs-12">{{$notification->created_at->diffForHumans()}}</span>
                    </div>
                    <a href="{{route('main.profile.notification.is_read',$notification)}}" class="btn btn--outline p-7 fs-14 radius-3 ttu mr-10" style="white-space:nowrap">Show More</a>
                </div>
                @endforeach
                {{$notifications->links('vendor.pagination.main.remodo')}}
            </div>
        </div>
    </div>
@endsection
