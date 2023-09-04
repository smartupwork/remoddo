@extends('main.layouts.main')
@section('wrapper_class') pt-header @endsection

@section('title') Payment Methods @endsection

@section('content')

    <div class="container container-xl">
        <div class="category-page">
            @include('main.sections.pages.profile.user.sidebar')
            <div class="category-page__content">
                <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                    <h3 class="ttu fw-800 pe-4 mb-4">Payment Methods</h3>
                    <div class="d-flex align-items-center flex-wrap">
                        {{--                        <a href="{{route('main.profile.user.payment-method.create')}}"--}}
                        {{--                           class="btn btn--dark btn--md radius-3 ttu mb-4 me-3">--}}
                        {{--                            <span class="fs-14">+ Add Payment</span>--}}
                        {{--                        </a>--}}
                        <a href="#" class="btn btn--dark btn--sm -ttu radius-3 mb-20 mr-10" data-modal="#add-payment">
                              <span class="info">
                                Add payment method
                              </span>
                        </a>
                    </div>

                </div>
                @if($paymentMethods->count())
                    <div class="table-wrapper">
                        <table class="table table-stick">
                            <thead class="fsz-12">
                            <tr>
                                <th class="text-start">
                                    Card Number
                                </th>
                                <th class="text-start">
                                    Expiration Date
                                </th>
                                <th class="text-start">
                                    CVC
                                </th>
                                <th class="text-start">
                                    Status
                                </th>
                                <th class="text-start" style="width: 10px">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paymentMethods as $paymentMethod)
                                <tr>
                                    <td>
                                        <div class="card-number">
                                            <span class="ico mr-10"><img src="{{asset($paymentMethod->image)}}"></span>
                                            <span class="info fw-600">
                                              •••• •••• •••• {{$paymentMethod->card_number}}
                                                </span>

                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="fw-600">{{$paymentMethod->exp_month}} / {{$paymentMethod->exp_year}}</span>
                                    </td>
                                    <td>
                                        <span class="fw-600">•••</span>
                                    </td>
                                    <td class="w-100">
                                        @if($paymentMethod->default_method)
                                            <span class="pill btn--warning radius-3">
                                            Main Method
                                        </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown dropdownPay__action" data-dropdown="dropdown"
                                             data-position="bottom-end">
                                            <button class="btn btn--dark btn--sm radius-3 ttu" data-role="button">
                                                <span class="dropdown-text-btn mr-8">Actions</span>
                                                <span class="dropdown-arrow">
                                                    <img src="{{asset('main/img/icons/select-arrow-white.svg')}}">
                                                </span>
                                            </button>

                                            <div class="dropdown__body dropdownPay__action" data-role="dropdown" style="">
                                                <ul class="dropdownPay__action-list">
                                                    <li class="dropdown__item">
                                                        <a href="{{route('main.profile.user.payment-method.destroy',['payment_method'=>$paymentMethod->id])}}" class="dropdown__action-item delete-data-btn"
                                                           data-modal="#data-delete"
                                                        >Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div>
                        <h4 class="error-message">NOT FOUND</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    @include('main.sections.pages.payment.popup')
    @include('components.main.common.popup_delete')
@endsection

@push('scripts')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('main/js/delete-popup.js')}}"></script>

@endpush
