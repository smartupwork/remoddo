@extends('main.layouts.main-singleproduct',['prev_url'=>route('main.profile.lender.overview')])
@section('wrapper_class') pt-header @endsection
@section('main_tag_class') single-page @endsection
@section('title') Rent Shiping @endsection

@section('content')

    <div class="container container-1010">
        <div class="row rent-page gutters-80 pb-40">
            <div class="col-md-6 border-right">
                <div class="d-flex flex-column h-100">
                    <div class="d-flex align-items-center mb-5">
                        <ul class="breadcrambs breadcrambs--style-2">
                            <li class="active">
                                <span>Shipping</span>
                            </li>
                            <li>
                                <span>Payment</span>
                            </li>
                            <li>
                                <span>Complete</span>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex mb-20">
                        <h4 class="fw-800 uppercase">DELIVERY DETAILS</h4>
                    </div>
                    <div class="row gutters-20 mb-15">
                        <div class="col-6">
                            <div class="input-wrap">
                                <label class="label-custom">First Name*</label>
                                <input class="input rent-name" value="{{$session_data_name}}" name="name" type="text" placeholder="Add name...">
                                <span class="error-rent-name error-message"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-wrap">
                                <label class="label-custom">Last Name*</label>
                                <input class="input rent-surname" name="surname" value="{{$session_data_surname}}" type="text" placeholder="Add last name...">
                                <span class="error-rent-surname error-message"></span>
                            </div>
                        </div>

                    </div>

                    <div class="write-address" data-spoller>
                        <div class="input-wrap mb-15 address-active">
                            <label class="label-custom">SEARCH ADDRESS*</label>
                            <select class="select-default rent-address_id" name="address_id">
                                <option value="">Select your address</option>
                                @foreach($addresses as $address)
                                    <option value="{{$address->id}}" @if($session_data_address_id==$address->id) selected @endif>{{$address->name}}</option>
                                @endforeach
                            </select>
                            <span class="error-rent-address_id error-message"></span>
                        </div>
                        <div class="d-flex mb-15">
                            <a href="#" class="btn btn--underline-warninng address-active" data-spoller-btn>Write
                                Address
                                Manually</a>
                        </div>
                        <div class="write-address__drop" data-spoller-drop style="display: none;">
                            <div class="input-wrap mb-15">
                                <label class="label-custom">ADDRESS LINE 1*</label>
                                <input class="input rent-location" name="location" type="text" placeholder="Add address line 1...">
                                <span class="error-rent-main_location error-message"></span>
                            </div>
                            <div class="input-wrap mb-15">
                                <label class="label-custom">ADDRESS LINE 2</label>
                                <input class="input rent-additional_location" type="text" name="additional_location" placeholder="Add address line 2...">
                            </div>
                            <div class="row gutters-20 mb-15">
                                <div class="col-6">
                                    <div class="input-wrap">
                                        <label class="label-custom">TOWN/CITY*</label>
                                        <input class="input rent-city" type="text" placeholder="Add town/city...">
                                        <span class="error-rent-city error-message"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-wrap">
                                        <label class="label-custom">POSTCODE*</label>
                                        <input class="input rent-post_code" name="post_code" type="text" placeholder="Add postcode...">
                                        <span class="error-rent-post_code error-message"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-15">
                                <div class="input-wrap">
                                    <label class="label-custom">Phone Number*</label>
                                    <input class="input rent-phone" name="phone" type="number" placeholder="Add phone number...">
                                    <span class="error-rent-phone error-message"></span>
                                </div>
                            </div>
                            <div class="input-wrap mb-15">
                                <label class="label-custom">COUNTRY*</label>
                                <select class="select-default rent-country" name="country">
                                    <option value="">Select your country</option>
                                    @foreach($countries as $code=>$country)
                                        <option value="{{$code}}">{{$country}}</option>
                                    @endforeach
                                </select>
                                <span class="error-rent-country error-message"></span>
                            </div>
                            <label class="custom-checkbox mb-15">
                                <input type="checkbox" class="custom-checkbox__input" checked="">
                                <span class="custom-checkbox__input-fake"></span>
                                <span class="custom-checkbox__label pl-14">
                                        Billing address is same as above
                                    </span>
                            </label>

                            <div class="d-flex justify-content-between mt-auto">
                                <a href="#" class="btn btn--underline-warninng" data-spoller-btn>Select Address</a>
                                <a href="" class="btn btn--warning btn--sm radius-3 ttu next_step">Next Step</a>
                            </div>

                        </div>
                        <div class="address-active mt-auto">
                            <div class="d-flex justify-content-end">
                                <a href="" class="btn btn--warning btn--sm radius-3 ttu next_step">Next Step</a>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="d-flex justify-content-end mt-auto">
                        <a href="" class="btn btn--warning btn--sm radius-3 ttu">Next Step</a>
                    </div> -->
                </div>
            </div>
            @include('main.sections.pages.rent.summary')
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{asset('main/js/rent-shipping.js')}}"></script>
@endpush
