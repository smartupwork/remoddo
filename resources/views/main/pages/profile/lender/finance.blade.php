@extends('main.layouts.main')
@section('wrapper_class','pt-header')
@section('title','Finances')
@section('content')
    <div class="container container-xl">
        <div class="category-page">
            @include('main.sections.pages.profile.user.sidebar')
            <div class="category-page__content">
                <div
                    class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h3 class="ttu fw-900 pe-4 mb-4">Finances</h3>
                    {{-- @if(auth()->user()->stripeAccount)
                        <a href="#" class="btn btn--dark btn--sm radius-3 -ttu mb-4">
                            <span class="info def-text-1">
                                Stripe Connected
                            </span>
                        </a>
                    @else
                        <a href="#" class="btn btn--dark btn--sm radius-3 -ttu mb-4 stripe-popup"
                           data-modal="#withdraw" >
                            <span class="info def-text-1">
                                Stripe Connection
                            </span>
                        </a>
                    @endif --}}
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 d-flex">
                        <div class="widget-profile">
                            <div class="widget--body">
                                <div class="widget-element radius-3 pt-30">
                                    <div class="custom-columns">
                                        <div class="custom-col custom-col--3 pb-30">
                                            <div class="stata">
                                                <h4 class="stata-heading text-center">
                                                        <span class="fw-800 -ttu">
                                                            Total earnings
                                                        </span>
                                                </h4>
                                                <div class="stata-option text-center mt-6">
                                                    <h3 class="--value fw-800">
                                                        £{{$total_earning}}
                                                    </h3>
                                                    <span class="--info mt-6 fw-600">
                                                            Just Now
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom-col custom-col--3 pb-30">
                                            <div class="stata">
                                                <h4 class="stata-heading text-center">
                                                        <span class="fw-800 -ttu">
                                                            Avg earnings per month
                                                        </span>
                                                </h4>
                                                <div class="stata-option text-center mt-6">
                                                    <h3 class="--value fw-800">
                                                        £{{$monthly_earning}}
                                                    </h3>
                                                    <span class="--info mt-6 fw-600">
                                                            Just Now
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom-col custom-col--3 pb-30">
                                            <div class="stata">
                                                <h4 class="stata-heading text-center">
                                                        <span class="fw-800 -ttu">
                                                            Orders
                                                        </span>
                                                </h4>
                                                <div class="stata-option text-center mt-6">
                                                    <h3 class="--value fw-800">
                                                        {{$order_count}}
                                                    </h3>
                                                    <span class="--info mt-6 fw-600">
                                                            Just Now
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom-col custom-col--3 pb-30">
                                            <div class="stata">
                                                <h4 class="stata-heading text-center">
                                                        <span class="fw-800 -ttu">
                                                            Current ballance
                                                        </span>
                                                </h4>
                                                <div class="stata-option text-center mt-6">
                                                    <h3 class="--value fw-800">
                                                        £{{$current_balance}}
                                                    </h3>
                                                    <span class="--info mt-6 fw-600">
                                                            Just Now
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 mt-30 d-flex">
                        <div class="tabs">
                            <div class="tabs-header">
                                <nav data-tab-nav>
                                    <ul class="tabs-list">
                                        <li class="tabs-list--item active-tab mb-4" data-href="#payments-history">
                                            <a href="#" class="tab-link">
                                                <span class="info">Payments History</span>
                                            </a>
                                        </li>
                                        <li class="tabs-list--item mb-4" data-href="#transaction-history">
                                            <a href="#" class="tab-link">
                                                <span class="info">Transactions History</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>

                                <a href="" data-url="{{route('main.profile.lender.export')}}" class="btn btn--dark btn--sm download-csv radius-3 -ttu mb-4" download>
                                        <span class="info def-text-1">
                                            Download CSV
                                        </span>
                                </a>
                            </div>
                            <div class="tabs-body">
                                <div class="tab-content active-tab" id="payments-history">
                                    <div class="table-wrapper">
                                        <table class="table table-stick">
                                            <thead class="fsz-12">
                                            <tr>
                                                <th class="text-start" style="width:10px;">
                                                    #
                                                </th>
                                                <th class="text-start">
                                                    ID
                                                </th>
                                                <th class="text-start">
                                                    Renter
                                                </th>
                                                <th class="text-start">
                                                    Date
                                                </th>
                                                <th class="text-start">
                                                    Status
                                                </th>
                                                <th class="text-start">
                                                    Amount
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php  $i=1;?>
                                            @foreach($payment_history as $order)
                                                <tr>
                                                    <td>
                                                        <span class="fw-600">{{$i}}</span>
                                                    </td>
                                                    <td>
                                                        <span class="fw-600">#{{$order->id}}</span>
                                                    </td>
                                                    <td>
                                                        <div class="item-renter">
                                                            <span
                                                                class="item-renter__name">{{$order->renter->info->full_name}}</span>
                                                            <div class="item-renter__rating">
                                                                <div class="sm_square_image mr-12">
                                                                    <img src="{{$order->renter->info->avatar}}">
                                                                </div>
                                                                <span class="pl-5">{{$order->renter->rating}}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="fw-600">{{$order->start_date}}</span>
                                                    </td>
                                                    <td>
                                                        <span class="pill btn--warning radius-3">Pending</span>
                                                    </td>
                                                    <td>
                                                        <span class="fw-600">£{{$order->total_price}}</span>
                                                    </td>
                                                </tr>
                                                <?php  $i++;?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{$payment_history->links('vendor.pagination.main.remodo')}}
                                </div>


                                <div class="tab-content" id="transaction-history">
                                    <div class="table-wrapper">
                                        <table class="table table-stick">
                                            <thead class="fsz-12">
                                            <tr>
                                                <th class="text-start" style="width:10px;">
                                                    #
                                                </th>
                                                <th class="text-start">
                                                    ID
                                                </th>
                                                <th class="text-start">
                                                            <span style="opacity:0;">
                                                                Renter
                                                            </span>
                                                </th>
                                                <th class="text-start">
                                                    Date
                                                </th>
                                                <th class="text-start">
                                                    Status
                                                </th>
                                                <th class="text-start">
                                                    Amount
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $j=1;?>
                                           @foreach($transaction_history as $order)
                                            <tr>
                                                <td>
                                                    <span class="fw-600">{{$j}}</span>
                                                </td>
                                                <td>
                                                    <span class="fw-600">#{{$order->id}}</span>
                                                </td>
                                                <td style="opacity:0;">
                                                    <div class="item-renter">
                                                        <span class="item-renter__name">Jane Smith</span>
                                                        <div class="item-renter__rating">
                                                            <img src="{{asset('main/img/icons/icon-star.svg')}}">
                                                            <span class="pl-5">{{$order->renter->rating}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fw-600">{{$order->start_date}}</span>
                                                </td>
                                                <td>
                                                    <span class="pill btn--success radius-3">Success</span>
                                                </td>
                                                <td>
                                                    <span class="fw-600">£{{$order->total_price}}</span>
                                                </td>
                                            </tr>
                                               <?php $j++?>
                                           @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{$transaction_history->links('vendor.pagination.main.remodo')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('main.sections.pages.finance.stripe-popup',['user'=>auth()->user()])
@endsection
@push('scripts')
    <script src="{{asset('main/js/export-excel.js')}}"></script>
    <script src="{{asset('main/js/withdraw-popup.js')}}"></script>
@endpush
