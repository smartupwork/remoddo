@extends('main.layouts.main-singleproduct',['prev_url'=>$back_url])
@section('wrapper_class') pt-header @endsection
@section('main_tag_class') single-page @endsection
@section('title') Rent Payment @endsection
@section('content')
    <div class="container container-1010">
        <div class="row rent-page gutters-80 pb-40">
            <div class="col-md-6 border-right">
                <div class="d-flex flex-column h-100" id="payment-form" data-public="{{$public_key}}">
                    <div class="d-flex align-items-center mb-5">
                        <ul class="breadcrambs breadcrambs--style-2">
                            <li class="active">
                                <span>Shipping</span>
                            </li>
                            <li class="active">
                                <span>Payment</span>
                            </li>
                            <li>
                                <span>Complete</span>
                            </li>
                        </ul>
                    </div>

                    <h4 class="fw-800 uppercase mb-20">CARD DETAILS</h4>


                    <div class="write-address" data-spoller>
                        <div class="input-wrap mb-15 address-active">
                            <label class="label-custom">Payment Methods</label>
                            <select class="select-default payment_method_id mt-3" name="payment_method_id">
                                <option value="" selected>Select Payment Method</option>
                                @foreach($paymentMethods as $pm)
                                    <option value="{{$pm->pm_id}}">{{$pm->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex mb-15">
                            <a href="#" class="btn btn--underline-warninng address-active" data-spoller-btn>Write
                                Card
                                Manually</a>
                        </div>
                        <div class="write-address__drop" data-spoller-drop style="display: none;">
                            <div class="input-wrap mb-15">
                                <label class="label-custom">CREDIT / DEBIT CARD*</label>
                                <div class="card-details">
                                    <div class="card-details__img">
                                        <img src="{{asset('main/img/icons/icon-credit-card.svg')}}">
                                    </div>

                                    <div id="cardNumber" class="card-details__number"></div>

                                    <div id="cardExp" class="card-details__month"></div>

                                    <div id="cardCVC" class="card-details__cvc"></div>
                                </div>

                            </div>
                            <div class="d-flex justify-content-between mt-auto">
                                <a href="#" class="btn btn--underline-warninng" data-spoller-btn>Select Payment Method</a>
                            </div>
                        </div>

                    </div>
                    <h4 class="fw-800 uppercase mb-20">Billing address</h4>

                    <div class="billing-address mb-30">
                        <ul class="billing-address__list">
                            <li class="fw-700">Name Surname</li>
                            <li>{{$session['name']}} {{$session['surname']}}</li>
                            <li>{{$session['address']['main_location']}}</li>
                            <li>{{$session['address']['additional_location']}}</li>
                            <li>{{$session['address']['city']}}</li>
                            <li>{{$session['address']['country']}}</li>
                        </ul>
                        <a href="{{$back_url}}" class="btn btn--underline-warninng"><span class="fw-700 fs-14"></span>Change
                            Address</a>
                    </div>


                    <h4 class="fw-800 uppercase mb-20">WHY ARE YOU RENTING?</h4>
                    <div class="input-wrap mb-15 w-100">
                        <select class="select-default">
                            <option value="">Holiday</option>
                            <option>Birthday</option>
                            <option>Daily wear</option>
                            <option>Other</option>
                        </select>
                    </div>


                    <div class="d-flex justify-content-between mt-auto">
                        <a href="{{$back_url}}" class="btn btn--outline black-border btn--md radius-3 ttu">
                                <span class="btn-ico me-3 w-20">
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.6668 7.40509L8.3335 10.7384L11.6668 14.0718" stroke="currentColor"
                                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            <span>Back</span>
                        </a>
                        <button id="card-button" class="btn btn--warning btn--sm radius-3 ttu"
                                data-secret="{{ $intent->client_secret }}">Pay & Request
                        </button>
                    </div>
                    <div id="error-message" class="error-message mt-6"></div>
                </div>
            </div>
            @include('main.sections.pages.rent.summary')
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{asset('main/js/payment.js')}}"></script>
@endpush
