@extends('main.layouts.main')
@section('wrapper_class')
    pt-header
@endsection
@section('title') My Rentals @endsection

@section('content')

    <main class="content ">
        <div class="container container-xl">
            <div class="category-page">
                @include('main.sections.pages.profile.user.sidebar')
                <div class="category-page__content">
                    <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                        <h3 class="ttu fw-800 pe-4 mb-4">My Rentals</h3>
                        <div class="d-flex align-items-center flex-wrap">
{{--                            @include('components.main.order.filter')--}}
                            @include('main.sections.pages.rentals.sorting')
                        </div>
                    </div>
                    @if($orders->count())
                    <div class="table-wrapper">
                        <table class="table table-stick">
                            <thead class="fsz-12">
                            <tr>
                                <th class="text-start">
                                    Order Id
                                </th>
                                <th class="text-start">
                                    Lender Name
                                </th>
                                <th class="text-start">
                                    Status
                                </th>
                                <th class="text-start">
                                    Date / Exp. Date
                                </th>
                                <th class="text-start">
                                    Tracking Number
                                </th>
                                <th class="text-start w-100">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>
                                    <a href="#">#{{$order->id}}</a>
                                </td>
                                <td>
                                    <div class="item-renter">
                                        <span class="item-renter__name three-dots">{{$order->lender->info->name}}</span>
                                        <div class="item-renter__rating">
                                            <img src="{{asset('main/img/icons/icon-star.svg')}}">
                                            <span class="pl-5">{{$order->lender->rating}}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @include('components.main.order.status',['status'=>$order->status])
                                </td>
                                <td>
                                    <span class="fw-600">{{$order->start_date}} / {{$order->exp_date}}</span>
                                </td>
                                <td>
                                    <span class="fw-600">-</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        @if($order->status=='completed' && !$order->rating)
                                            <a href="#" data-url="{{route('main.profile.user.lender-by-order',$order)}}" class="btn btn--dark btn--sm radius-3 ttu mr-10 fs-12 rating-popup " data-modal="#rate-lander">RATE</a>
                                        @else
                                            <a href="#"
                                               data-url="{{route('main.order.popup-detail',$order)}}"
                                               data-send-back-url="{{route('main.profile.user.send-back',$order)}}" class="btn btn--dark btn--sm radius-3 ttu mr-10 fs-12 send-back-popup @if($order->status!='in_wardrobe') disable @endif" data-modal="#rental-send-back">Send Back</a>
                                        @endif
                                        <a href="{{route('main.profile.lender.order-detail',$order)}}" class="btn btn--outline btn--sm radius-3 ttu mr-10 fs-12">Order Details</a>
                                        <a href="{{route('main.profile.chat.edit',$order)}}" class="btn btn--outline btn--sm radius-3 ttu fs-12">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M16.4999 8.40918C16.4999 12.1917 13.1265 15.2275 8.99988 15.2275C8.46572 15.2275 7.94572 15.175 7.44238 15.0783" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M4.49917 13.855C2.68333 12.6133 1.5 10.645 1.5 8.40918" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M4.49913 13.855C4.4983 14.5666 4.49996 15.5266 4.49996 16.5341" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M1.5 8.40917C1.5 4.62667 4.87333 1.59167 9 1.59167C13.1267 1.59167 16.5 4.62751 16.5 8.41001" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M7.44167 15.075L4.5 16.5333" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9.14723 8.43598C9.22859 8.51734 9.22859 8.64925 9.14723 8.73061C9.06587 8.81197 8.93396 8.81197 8.8526 8.73061C8.77125 8.64925 8.77125 8.51734 8.8526 8.43598C8.93396 8.35462 9.06587 8.35462 9.14723 8.43598" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12.4807 8.43598C12.5621 8.51734 12.5621 8.64925 12.4807 8.73061C12.3994 8.81197 12.2675 8.81197 12.1861 8.73061C12.1047 8.64925 12.1047 8.51734 12.1861 8.43598C12.2675 8.35462 12.3994 8.35462 12.4807 8.43598" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.81398 8.43598C5.89534 8.51734 5.89534 8.64925 5.81398 8.73061C5.73262 8.81197 5.60071 8.81197 5.51935 8.73061C5.43799 8.64925 5.43799 8.51734 5.51935 8.43598C5.60071 8.35462 5.73262 8.35462 5.81398 8.43598" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$orders->links('vendor.pagination.main.remodo')}}
                    @else
                        <div>
                            <h4 class="error-message">NOT FOUND</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
    @include('main.sections.pages.rentals.send-back-popup')
    @include('main.sections.pages.rentals.rating-popup')
@endsection
@push('scripts')
    <script src="{{asset('main/js/product_sorting.js')}}"></script>
    <script src="{{asset('main/js/renter-send-back.js')}}"></script>
    <script src="{{asset('main/js/rating-popup.js')}}"></script>
    <script src="{{asset('main/js/order-filter.js')}}"></script>
@endpush
