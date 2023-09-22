@if(request()->has('brand'))
    <div class="d-flex flex-column filters-item  active-accordeon" data-accordeon="">
        @else
            <div class="d-flex flex-column filters-item " data-accordeon="">
                @endif
    <div class="d-flex justify-content-between pointer relative py-4" data-accordeon-btn="">
        <span class="fw-800 ttu">Brands</span>
        <span class="plus"></span>
    </div>
                @if(request()->has('brand'))
                    <div class=" accordeon-body" style="box-sizing: border-box; display: block;">
                        @else
                            <div class=" accordeon-body" style="display: none;">
                                @endif
        <div class="pb-4">
            <form class="input-search-form w-100 mb-4 filter_search_form"
                  data-url="{{route('main.brand.search')}}"
                  data-name="brand[]"
            >
                <label class="relative">
                    <input type="text"  class="input-search-window w-100 filter_search_input" name="search"
                           placeholder="Search...">
                    <button type="submit" class="form-search__btn">
                        <img src="{{asset('main/img/icons/icon-search.svg')}}">
                    </button>
                </label>
            </form>
            @php
            // Sort the $brands collection with custom sorting function
            $sortedBrands = $brands->sortBy(function ($brand) {
                // Place brands starting with special characters or numbers at the end
                return preg_match('/^[^A-Za-z]/', $brand->title) ? 'zzz' . $brand->title : $brand->title;
            });
        @endphp


            <div class="d-flex flex-column checkboxes_section">
                @foreach($sortedBrands as $brand)
                    <label class="custom-checkbox mb-4">
                        <input name="brand[]"
                               @if((request()->has('brand') && in_array($brand->id,request()->get('brand')))
                                  || (isset(request()->brand) &&  !is_array(request()->brand) && request()->brand->id===$brand->id)
                                   ) checked
                               @endif
                               value="{{$brand->id}}" class="custom-checkbox__input" type="checkbox">
                        <span class="custom-checkbox__input-fake "></span>
                        <span class="custom-checkbox__label">{{$brand->title}} ({{$brand->products_count}})</span>
                    </label>
                @endforeach
            </div>
        </div>
    </div>
</div>
