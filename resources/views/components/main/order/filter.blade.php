<div class="dropdown-custom" data-dropdown="dropdown">
    <a href="#" class="btn btn--dark btn--md radius-3 ttu mb-4 me-3" data-role="button">
        <span class="fs-14">Filters</span>
        <span class="btn-ico ms-3 w-20">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15 4.16667H17.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M2.5 4.16667H11.6667" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M8.3335 10H17.5002" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M2.5 10H5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M15 15.8333H17.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M2.5 15.8333H11.6667" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M14.5117 2.98816C15.1626 3.63903 15.1626 4.69431 14.5117 5.34518C13.8608 5.99605 12.8055 5.99605 12.1547 5.34518C11.5038 4.69431 11.5038 3.63903 12.1547 2.98816C12.8055 2.33728 13.8608 2.33728 14.5117 2.98816" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M7.84518 8.82153C8.49605 9.4724 8.49605 10.5277 7.84518 11.1786C7.19431 11.8294 6.13903 11.8294 5.48816 11.1786C4.83728 10.5277 4.83728 9.4724 5.48816 8.82153C6.13903 8.17066 7.19431 8.17066 7.84518 8.82153" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M14.5117 14.6548C15.1626 15.3057 15.1626 16.3609 14.5117 17.0118C13.8608 17.6627 12.8055 17.6627 12.1547 17.0118C11.5038 16.3609 11.5038 15.3057 12.1547 14.6548C12.8055 14.0039 13.8608 14.0039 14.5117 14.6548" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>

                                    </span>
    </a>

    <div class="dropdown__body mw-200" data-role="dropdown">
        <ul class="list-filter">
            <li class="list-filter--item">
                <div class="label-option">Status:</div>
                <label class="custom-checkbox">
                    <input type="checkbox" name="status[]" @if(request()->has('status') && in_array('new',request()->get('status'))) checked @endif value="new" class="order-status-checkbox custom-checkbox__input" style="display:none;">
                    <span class="custom-checkbox__input-fake">
                                                </span>
                    <span class="custom-checkbox__label">
                                                    New
                                                </span>
                </label>
                <label class="custom-checkbox">
                    <input type="checkbox" name="status[]" @if(request()->has('status') && in_array('is_coming',request()->get('status'))) checked @endif value="is_coming" class="order-status-checkbox custom-checkbox__input" style="display:none;">
                    <span class="custom-checkbox__input-fake">
                                                </span>
                    <span class="custom-checkbox__label">
                                                    Is coming
                                                </span>
                </label>
                <label class="custom-checkbox">
                    <input type="checkbox" name="status[]" value="in_wardrobe" @if(request()->has('status') && in_array('in_wardrobe',request()->get('status'))) checked @endif class="order-status-checkbox custom-checkbox__input" style="display:none;">
                    <span class="custom-checkbox__input-fake">
                                                </span>
                    <span class="custom-checkbox__label">
                                                    In my wardrobe
                                                </span>
                </label>
                <label class="custom-checkbox">
                    <input type="checkbox" name="status[]" value="shipped_back" @if(request()->has('status') && in_array('shipped_back',request()->get('status'))) checked @endif class="order-status-checkbox custom-checkbox__input" style="display:none;">
                    <span class="custom-checkbox__input-fake">
                                                </span>
                    <span class="custom-checkbox__label">
                                                    Shipped back
                                                </span>
                </label>
                <label class="custom-checkbox">
                    <input type="checkbox" name="status[]" value="completed" @if(request()->has('status') && in_array('completed',request()->get('status'))) checked @endif class="order-status-checkbox custom-checkbox__input" style="display:none;">
                    <span class="custom-checkbox__input-fake">
                                                </span>
                    <span class="custom-checkbox__label">
                                                    Completed
                                                </span>
                </label>
            </li>
        </ul>
    </div>
</div>
