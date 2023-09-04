<div id="withdraw" class="modal add-payment">
    <div class="modal__dialog modal__dialog--600">
        <div class="modal__content">
            <div class="modal__header">
                <h2 class="modal__title">Connection</h2>
                <a href="#" class="btn-close btn btn--secondary btn--sm-rounded rounded border-none btn-40"
                   data-close-modal="">
                    <img src="{{asset('main/img/icons/icon-close.svg')}}">
                </a>

            </div>
            <div class="modal__body">

                <div class="input-wrap mb-24">
                    @if($user->stripeAccount)
                        <label class="label-custom">Payment method</label>
                        <select class="select-default account">
                            <option value="{{$user->stripeAccount->id}}">{{$account_name}}</option>
                        </select>
                    @else
                        <a href="{{route('main.stripe.connect')}}" class="btn btn--dark btn--md radius-3 ttu">Connect
                            stripe</a>
                    @endif
                </div>
                @if($user->stripeAccount)
                    <div class="mb-12">
                        <label class="label-custom">Payment method</label>
                        <div class="d-flex mb-12">
                            <input name="payment-method" id="available" type="radio">
                            <label class="pointer" for="available">
                                All available amount £{{$user->user_balance}}
                            </label>
                        </div>
                        <div class="d-flex">
                            <input name="payment-method" id="part-amount" checked type="radio">
                            <label class="pointer" for="part-amount">
                                Withdraw part amount
                            </label>
                        </div>
                    </div>
                    <div class="input-wrap mb-50">
                        <input class="input amount" type="text" placeholder="$0.00" value="">
                        <span class="error-message error-amount"></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="" class="btn btn--dark btn--md radius-3 ttu cancel-btn">
                            <span class="fs-14">Cancel</span>
                        </a>
                        <a href="" data-url="{{route('main.stripe.withdraw')}}" class="btn btn--warning btn--md radius-3 ttu withdraw-btn">
                            <span class="fs-14">Withdraw</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
