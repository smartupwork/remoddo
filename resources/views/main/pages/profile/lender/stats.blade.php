@extends('main.layouts.main')
@section('wrapper_class','pt-header')
@section('title','Stats')
@section('content')
    <div class="container container-xl">
        <div class="category-page">
            @include('main.sections.pages.profile.user.sidebar')

            <div class="category-page__content">
                <div
                    class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h3 class="ttu fw-900 pe-4 mb-4">Stats</h3>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 d-flex">
                        <div class="widget-profile">
                            <div class="widget--header">
                                <div class="widget--option">
                                    <h4 class="def-text-1 fw-800 -ttu mb-12 mr-12">
                                        Stats overview for:
                                    </h4>
                                    <div class="form-group height-34px fs-14px lh-20px mb-12">
                                        <select class="select-default product_sorting" name="range">
                                            <option value="" selected>Today</option>
                                            <option value="week" @if(request()->get('range')=='week') selected @endif>7
                                                days ago
                                            </option>
{{--                                            <option value="12 days"--}}
{{--                                                    @if(request()->get('range')=='12 days') selected @endif>12 days ago--}}
{{--                                            </option>--}}
                                            <option value="month"
                                                    @if(request()->get('range')=='month') selected @endif>30 days ago
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @include('main.sections.pages.profile.lender.stats.statistic')
                        </div>
                    </div>
                    @include('main.sections.pages.profile.lender.stats.chart')
                    <div class="col-lg-6 col-md-6 mt-30 d-flex">
                        <div class="widget-profile">
                            <div class="widget--header">
                                <div class="widget--option">
                                    <h4 class="def-text-1 fw-800 -ttu mb-12 mr-12">
                                        My Wardrobe
                                    </h4>
                                </div>
                            </div>
                            <div class="widget--body">
                                <div class="widget-element widget-element--row p-26 pb-0">
                                    <div class="chart pr-26 mr-26 border-right mb-26">
                                        <canvas class="donut-chart w-152 h-152">
                                        </canvas>
                                    </div>
                                    <div class="chart-info d-flex flex-auto mb-26">
                                        <ul class="chart-info--list flex-auto justify-content-center">
                                            <li class="chart-info--item">
                                                <span class="info info-1 ttu">Active listings</span>
                                                <span class="info info-2 rented_amount">
                                                        {{$active_product_count}}
                                                    </span>
                                            </li>
                                            <li class="chart-info--item">
                                                <span class="info info-1 ttu">Lent</span>
                                                <span class="info info-2 rented_count">
                                                    {{$rented_count}}
                                                    </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 mt-30">
                        <div class="table-wrapper">
                            <table class="table table-stick">
                                <thead class="fsz-12">
                                <tr>
                                    <th class="text-start">
                                        Item Id
                                    </th>
                                    <th class="text-start">
                                        Name
                                    </th>
                                    <th class="text-start">
                                        Status
                                    </th>
                                    <th class="text-start">
                                        Views
                                    </th>
                                    <th class="text-start">
                                        Rented
                                    </th>
                                    <th class="text-start" style="width: 10px">
                                        Date
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($wardrobes as $product)
                                    <tr>
                                        <td>
                                            <span class="fw-600">#{{$product->id}}</span>
                                        </td>
                                        <td>
                                            <div class="item-name-group">
                                                <div class="sm_square_image mr-12">
                                                    <img src="{{asset($product->image)}}">
                                                </div>
                                                <span class="ws-nowrap fw-600 pl-12">{{$product->title}}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="item-renter">
                                                @if($product->status=='active')
                                                    @php
                                                        $status_title='HIDE'
                                                    @endphp
                                                    <span class="pill btn--green radius-3">Active</span>
                                                @else
                                                    @php
                                                        $status_title='ACTIVE'
                                                    @endphp
                                                    <span class="pill btn--warning radius-3">Hide</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-600">{{$product->views_count}}</span>
                                        </td>
                                        <td>
                                            <span class="fw-600">{{$product->orders_count}}</span>
                                        </td>
                                        <td>
                                            <span class="fw-600">{{$product->created_at}}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$wardrobes->links('vendor.pagination.main.remodo')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('main/js/product_sorting.js')}}"></script>
@endpush
