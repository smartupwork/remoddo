@foreach($attributes as $attribute)
    @php
        $attribute_value_ids =$attribute->values->pluck('id')->toArray();
        $is_checked=request()->has('value') && in_array($attribute->id,array_keys(request()->get('value')));
    @endphp



    @if($is_checked)
        <div class="d-flex flex-column filters-item  active-accordeon" data-accordeon="">
            @else
                <div class="d-flex flex-column filters-item " data-accordeon="">
                    @endif
        <div class="d-flex justify-content-between pointer relative py-4" data-accordeon-btn="">
            <span class="fw-800 ttu">{{$attribute->title}}</span>
            <span class="plus"></span>
        </div>
                    @if($is_checked)
                        <div class=" accordeon-body" style="box-sizing: border-box; display: block;">
                            @else
                                <div class=" accordeon-body" style="display: none;">
                                    @endif
            <div class="pb-4">
                <form class="input-search-form w-100 mb-4 filter_search_form"
                      data-url="{{route('main.attribute.search',['attribute'=>$attribute->id])}}"
                      data-name="value[{{$attribute->id}}][]">
                    <label class="relative">
                        <input type="text" class="input-search-window w-100 filter_search_input" placeholder="Search...">
                        <button type="submit" class="form-search__btn">
                            <img src="{{asset('main/img/icons/icon-search.svg')}}">
                        </button>
                    </label>
                </form>
                <div class="d-flex flex-column checkboxes_section">
                    @foreach($attribute->values->sortBy('value') as $value)
                        <label class="custom-checkbox mb-4">
                            <input name="value[{{$attribute->id}}][]"
                                   @if(request()->has("value")
                                       && isset(request()->get('value')[$attribute->id])
                                       && in_array($value->id,request()->get('value')[$attribute->id])
                                       ) checked
                                   @endif
                                   value="{{$value->id}}" class="custom-checkbox__input" type="checkbox">
                            <span class="custom-checkbox__input-fake "></span>
                            <span class="custom-checkbox__label">{{$value->value}} ({{$value->products_count}})</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endforeach
