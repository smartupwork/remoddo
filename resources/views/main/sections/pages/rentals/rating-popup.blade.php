<div id="rate-lander" class="modal return-label">
    <div class="modal__dialog modal__dialog--600">
        <div class="modal__content">
            <div class="modal__header flex-column pb-0">
                <h2 class="modal__title mb-2 uppercase">Rate LANDER</h2>
                <p class="text-center def-text-1">Did you like item that you rent? Please rate a lender</p>
                <a href="#" class="btn-close btn btn--secondary btn--sm-rounded rounded border-none btn-40" data-close-modal="">
                    <img src="{{asset('main/img/icons/icon-close.svg')}}">
                </a>

            </div>
            <div class="modal__body align-items-center">
                <div class="post-row flex-column">
                    <div class="d-flex align-items-center mb-20">
                        <img class="w-40 h-40 r-300 mr-12 rating-user-avatar" src="" alt="">
                        <div class="item-renter">
                            <span class="item-renter__name uppercase rating-user-fullname"></span>
                            <div class="item-renter__rating ">
                                <img src="{{asset('main/img/icons/icon-star.svg')}}">
                                <span class="pl-5 rating-total-rate"></span>
                            </div>
                        </div>
                    </div>
                    <div class="stars-container mb-3">
                        <?php for ($i=0; $i < 5; $i++) { ?>
                        <a href="#" class="btn star" data-index="{{5-$i}}">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15 1.34399L19.4025 10.3335L29.25 11.784L22.125 18.777L23.8065 28.656L15 23.9895L6.1935 28.656L7.875 18.777L0.75 11.784L10.596 10.3335L15 1.34399Z" stroke="#DFDFDF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <?php }?>
                    </div>
                    <span class="error-message error-rating"></span>
                </div>


                <a href="" class="btn btn--warning btn--md radius-3 ttu rating-btn" data-url="">
                    <span class="fs-14">Submit</span>
                </a>
            </div>
        </div>
    </div>
</div>
