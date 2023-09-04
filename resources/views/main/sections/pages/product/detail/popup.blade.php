<div id="select-date" class="modal select-date">
    <div class="modal__dialog modal__dialog--600">
        <div class="modal__content">
            <div class="modal__header flex-column">
                <h2 class="modal__title mb-1">Select Date</h2>
                <p class="text-center">Tap to select Start Date, preferably 1-2 days before you plan to wear it.</p>
                <a href="#" class="btn-close btn btn--secondary btn--sm-rounded rounded border-none btn-40" data-close-modal="">
                    <img src="{{asset('main/img/icons/icon-close.svg')}}">
                </a>

            </div>
            <div class="modal__body align-items-center">
                <div class="data-picker-wrapper mb-40 mt-40" id="rent-calendar"></div>
            </div>
            <div class="modal__footer justify-content-between w-100">
                <div class="d-flex flex-column align-items-start">
                    <button class="btn fs-14 fw-600 mb-10" data-action="prev">
                        <span class="info">
{{--                           <svg><path d="M 17,12 l -5,5 l 5,5"></path></svg>--}}
                        </span>
                        <span class="ml-10 arrive-date"></span>
                    </button>
                    <button  class="btn fs-14 fw-600" data-action="next">
                        <span class="info" style="transform: rotate(180deg);">
{{--                           <svg><path d="M 17,12 l -5,5 l 5,5"></path></svg>--}}
                        </span>
                        <span class="ml-10 return-date"></span>
                    </button>
                </div>
                <a href="" class="btn btn--warning btn--md radius-3 ttu rent-now">
                    <span class="fs-14">Rent Now</span>
                </a>
            </div>
        </div>
    </div>
</div>
