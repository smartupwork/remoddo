<div id="request-accept-order" class="modal return-label accept-order ">
    <div class="modal__dialog modal__dialog--600">
        <div class="modal__content">
            <div class="modal__header flex-column pb-0">
                <h2 class="modal__title mb-2">Accept Lending</h2>
                <p class="text-center def-text-1 fw-600">
                    Are you sure you want to prepare this order for sending to the customer?
                    If yes, please send track number of your post service to customer via chat.
                </p>
                <a href="#" class="btn-close btn btn--secondary btn--sm-rounded rounded border-none btn-40" data-close-modal="">
                    <img src="{{asset('main/img/icons/icon-close.svg')}}">
                </a>

            </div>
            <div class="modal__body align-items-center">
                <ul class="info-rent-list">
                    <li class="d-flex align-items-center mb-16">
                        <div class="d-flex align-items-center flex-auto">
                                <span class="flex min-w-20">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.5867 15.2467C16.1025 15.7625 16.1025 16.5983 15.5867 17.1133C15.0708 17.6292 14.235 17.6292 13.72 17.1133C13.2042 16.5975 13.2042 15.7617 13.72 15.2467C14.2358 14.7308 15.0717 14.7308 15.5867 15.2467" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M6.42 15.2467C6.93583 15.7625 6.93583 16.5983 6.42 17.1133C5.90417 17.6292 5.06833 17.6292 4.55333 17.1133C4.03833 16.5975 4.0375 15.7617 4.55333 15.2467C5.06917 14.7317 5.90417 14.7308 6.42 15.2467" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M8.33333 3.33337H11.6667C12.1267 3.33337 12.5 3.70671 12.5 4.16671V12.5H1.66667" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M4.16667 16.18H2.5C2.04 16.18 1.66667 15.8067 1.66667 15.3467V10.8334" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.5 5.83337H16.1025C16.4433 5.83337 16.75 6.04087 16.8758 6.35754L18.2142 9.70254C18.2925 9.89921 18.3333 10.1092 18.3333 10.3209V15.2775C18.3333 15.7375 17.96 16.1109 17.5 16.1109H15.9742" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M13.3333 16.1833H6.80833" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M18.3333 11.6667H15V8.33337H17.6667" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M1.66667 3.33335H5.83333" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M1.66667 5.83335H4.16667" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M2.5 8.33335H1.66667" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            <p class="fs-14 fw-600 px-12">{!! \App\Models\Setting::get('rent_3')!!}</p>
                        </div>
                        <a href="#" class="btn btn--underline-warninng address-active fs-14 fw-700" style="white-space: nowrap;"> Learn More</a>
                    </li>
                    <li class="d-flex align-items-center">
                        <div class="d-flex align-items-center flex-auto">
                                <span class="flex min-w-20">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.25 2.5V5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M13.75 2.5V5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M8.33333 17.5H5C3.61929 17.5 2.5 16.3807 2.5 15V6.25C2.5 4.86929 3.61929 3.75 5 3.75H15C16.3807 3.75 17.5 4.86929 17.5 6.25V9.16667" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M13.3333 17.5L11.6667 15.8333L13.3333 14.1666" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M11.6667 15.8333H15.4167C16.5673 15.8333 17.5 14.9006 17.5 13.75V13.75C17.5 12.5994 16.5673 11.6666 15.4167 11.6666H13.3333" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            <p class="fs-14 fw-600 px-12">{!! replace_setting_value('{late_fee}',late_fee(),\App\Models\Setting::get('rent_2'))!!}</p>
                        </div>
                        <a href="#" class="btn btn--underline-warninng address-active fs-14  fw-700" style="white-space: nowrap;"> Learn More</a>
                    </li>

                </ul>
                <a href="#" class="post-row product-url">
                    <div class="wrapper-image mr-20 radius-3">
                        <img src="" class="product-image">
                    </div>
                    <div class="post-info">
                        <h4 class="def-text-1 fw-800 -ttu opacity-04 mb-8 brand-name">

                        </h4>
                        <p class="fw-600 lh-20 product-name">

                        </p>
                    </div>
                </a>
                <div class="d-flex align-items-center">
                    <a href="" class="btn btn--dark btn--md radius-3 min-w-150 ttu me-3 mb-10 decline-popup-btn">
                        <span class="fs-14">No</span>
                    </a>
                    <a href="" class="btn btn--warning btn--md radius-3 min-w-150 mb-10 ttu accept-popup-btn">
                        <span class="fs-14">Yes</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
