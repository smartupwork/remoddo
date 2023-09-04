<div id="add-address" class="modal">
    <div class="modal__dialog modal__dialog--600">
        <div class="modal__content">
            <div class="modal__header">
                <h2 class="modal__title">Add Address</h2>
                <a href="#" class="btn-close btn btn--secondary btn--sm-rounded rounded border-none btn-40"
                   data-close-modal="">
                    <img src="{{asset('main/img/icons/icon-close.svg')}}">
                </a>

            </div>
            <div class="modal__body">
                <div class="input-wrap mb-20">
                    <label class="label-custom">Name</label>
                    <input class="input address-name" name="name" type="text" placeholder="" value="">
                    <span class="error-message error-message-name"></span>
                </div>

                <div class="input-wrap mb-20">
                    <label class="label-custom">Address</label>
                    <input class="input address-location" type="text" name="location" placeholder="" value="">
                    <span class="error-message error-message-location"></span>
                </div>
                <div class="input-wrap mb-20">
                    <label class="label-custom">Additional Address</label>
                    <input class="input address-additional_location" type="text" name="additional_location"
                           placeholder="" value="">
                    <span class="error-message error-message-additional_location"></span>
                </div>
                <div class="input-wrap mb-24">
                    <label class="label-custom">Country</label>
                    <select class="select-default address-country" name="country">
                        @foreach($countries as $code=>$country)
                            <option value="{{$code}}">{{$country}}</option>
                        @endforeach
                    </select>
                    <span class="error-message error-message-country"></span>
                </div>
                <div class="input-wrap mb-20">
                    <label class="label-custom">City</label>
                    <input class="input address-city" type="text" name="city" placeholder="" value="">
                    <span class="error-message error-message-city"></span>
                </div>
                <div class="input-wrap mb-20">
                    <label class="label-custom">Post Code</label>
                    <input class="input address-post_code" type="text" name="post_code" placeholder="" value="">
                    <span class="error-message error-message-post_code"></span>
                </div>

                <div class="input-wrap mb-20">
                    <label class="label-custom">Phone</label>
                    <input class="input phone address-phone" name="phone" type="number" placeholder="" value="">
                    <span class="error-message error-message-phone"></span>
                </div>


                <div class="input-wrap mb-24">
                    <label class="label-custom">Status</label>
                    <select class="select-default is_main" name="is_main">
                        <option value="">Not Main Address</option>
                        <option value="on">Main Address</option>
                    </select>
                    <span class="error-message error-message-is_main"></span>
                </div>

                <a href="" class="btn btn--warning btn--md radius-3 ml-auto ttu save-address">
                    <span class="fs-14">Submit</span>
                </a>
            </div>
        </div>
    </div>
</div>
