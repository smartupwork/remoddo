@extends('main.layouts.main')
@section('wrapper_class') pt-header @endsection

@section('title') Requests @endsection


@section('content')

    <div class="container container-xl">
        <div class="category-page">
            @include('main.sections.pages.profile.user.sidebar')
            <div class="category-page__content">
                <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                    <h3 class="ttu fw-800 pe-4 mb-4">Requests</h3>
                    <div class="d-flex align-items-center flex-wrap">
{{--                        @include('components.main.order.filter')--}}
                        @include('main.sections.pages.requests.sorting',['title'=>'Requests'])
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
                                Name
                            </th>
                            <th class="text-start">
                                Renter
                            </th>
                            <th class="text-start">
                                Status
                            </th>
                            <th class="text-start">
                                Date
                            </th>
                            <th class="text-start" style="width: 10px">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    #{{$order->id}}
                                </td>
                                <td>
                                    <div class="item-name-group">
                                        <div class="sm_square_image mr-12">
                                            <img src="{{$order->product->image}}">
                                        </div>
                                        <span class="ws-nowrap fw-600 pl-12">{{$order->product->title}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="item-renter">
                                        <span class="item-renter__name three-dots">{{$order->renter->info->full_name}}</span>
                                        <div class="item-renter__rating">
                                            <img src="{{asset('main/img/icons/icon-star.svg')}}">
                                            <span class="pl-5">{{$order->renter->rating}}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @include('components.main.order.status',['status'=>$order->status])
                                </td>
                                <td>
                                    <span class="fw-600">{{$order->start_date}}</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        @if($order->status=='new')
                                            <a href="#"
                                               data-change-status-url="{{route('main.profile.user.order.change-status',['order'=>$order->id])}}"
                                               class="btn btn--warning btn--sm radius-3 ttu mr-10 order-status-popup"
                                               data-url="{{route('main.order.popup-detail',$order)}}"
                                               data-modal="#request-accept-order">Accept</a>
                                            <a href="#"
                                               data-url="{{route('main.profile.user.order.change-status',['order'=>$order->id])}}"
                                               class="btn btn--outline btn--sm radius-3 ttu order-status-btn"
                                               data-status="declined">Decline</a>
                                        @endif
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
    @include('main.sections.pages.requests.accept-order-popup')
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('main/js/product_sorting.js')}}"></script>
    <script src="{{asset('main/js/update_order_status.js')}}"></script>
    <script src="{{asset('main/js/order-filter.js')}}"></script>
@endpush
