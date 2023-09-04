<aside class="category-page__aside">
    <a href="" class="btn sidebar-open d-lg-none">
        <img src="{{asset('main/img/icons/ico-filter.svg')}}" alt="">
    </a>
    <a href="" class="btn sidebar-close  d-lg-none"><img src="{{asset('main/img/icons/icon-close.svg')}}"></a>
    <div class="category-page__aside-container">
        <p class="fs-14 fw-700 mb-4">Browse by:</p>
       @include('components.main.product.filter.category')
       @include('components.main.product.filter.brand')
       @include('components.main.product.filter.attributes')
        <div class="d-flex flex-column filters-item" data-accordeon="">
            <div class="d-flex justify-content-between pointer relative py-4" data-accordeon-btn="">
                <span class="fw-800 ttu">Price</span>
                <span class="plus"></span>
            </div>
            <div class=" accordeon-body" style="display: none;">
                <div class="pb-4">
                    <div class="price-slider" data-min="0" data-max="1500">
                        <input name="price[min]" class="price_filter min-value fs-14 fw-600"
                               id="price_min_filter"
                               value="@if(isset(request()->get('price')['min'])) {{request()->get('price')['min']}} @else 0 @endif"
                        />
                        <input name="price[max]" class="price_filter max-value fs-14 fw-600"
                               id="price_max_filter"
                               value="@if(isset(request()->get('price')['max'])) {{request()->get('price')['max']}} @else 1500 @endif"
                        >
                    </div>
                </div>
            </div>
        </div>


        <a href="" class="btn btn--underline-warninng mt-4 reset_filter-btn"><span class="fw-700 fs-14 "></span>Reset
            all filters</a>
    </div>
</aside>

@push('scripts')
    <script src="{{asset('main/js/product-filter.js')}}"></script>
@endpush
