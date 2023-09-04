<div id="add-payment" class="modal add-payment">
    <div class="modal__dialog modal__dialog--600">
        <div class="modal__content">
            <div class="modal__header">
                <h2 class="modal__title">Add payment method</h2>
                <a href="#" class="btn-close btn btn--secondary btn--sm-rounded rounded border-none btn-40"
                   data-close-modal="">
                    <img src="{{asset('main/img/icons/icon-close.svg')}}">
                </a>

            </div>
            <div id="payment-form" class="modal__body" data-public="{{$public_key}}">
                <div class="input-colums colums-5">
                    <div class="input-wrap input-col-6 mb-20">
                        <label class="label-custom">Card Number</label>
                        <div class="card-element">
                            <div id="cardNumber" class="input-wrap"></div>
                        </div>
                    </div>

                    <div class="input-wrap input-col-3 mb-20">
                        <label class="label-custom">Expire Date</label>
                        <div class="card-element">
                            <div id="cardExp" class="input-wrap"></div>
                        </div>
                    </div>
                    <div class="input-wrap input-col-3 mb-20">
                        <label class="label-custom">Cvc</label>
                        <div class="card-element">
                            <div id="cardCVC" class="input-wrap"></div>
                        </div>
                    </div>
                </div>

                <div class="input-wrap mb-24">
                    <label class="label-custom">Status</label>
                    <select class="select-default default_payment_method" name="default_payment_method">
                        <option value="">Not default</option>
                        <option value="on">Is default</option>
                    </select>
                </div>
                <div class="d-flex justify-content-evenly">
                    <div class="error-message" id="payment-error" ></div>
                    <div id="card-button" data-url="{{route('main.profile.user.payment-method.store')}}"
                         data-secret="{{ $intent->client_secret }}"
                         class="btn btn--warning btn--md radius-3 ml-auto ttu">
                        <span class="fs-14">Submit</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{asset('main/js/stripe-payment-element.js')}}"></script>
@endpush
@push('styles')
    <style>
        .card-element{
            font-weight: 600;
            font-size: 16px;
            line-height: 20px;
            background-color: #FFFFFF;
            box-shadow: 0px 0px 1px rgba(26, 32, 36, 0.32), 0px 1px 2px rgba(91, 104, 113, 0.32);
            border-radius: 3px;
            color: #000000;
            border: none;
            padding: 10px 12px;
        }
    </style>
@endpush
