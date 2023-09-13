@if(request()->has('category'))
    <div class="d-flex flex-column filters-item border-top active-accordeon" data-accordeon="">
        @else
            <div class="d-flex flex-column filters-item border-top" data-accordeon="">
                @endif
                <div class="d-flex justify-content-between pointer relative py-4" data-accordeon-btn="">
                    <span class="fw-800 ttu">Category</span>
                    <span class="plus"></span>
                </div>
                @if(request()->has('category'))
                    <div class=" accordeon-body" style="box-sizing: border-box; display: block;">
                        @else
                            <div class=" accordeon-body" style="display: none;">
                                @endif
                                
                                <div class="pb-4">
                                    <label class="custom-checkbox mb-4">
                                        <input id="select-all-checkbox" class="custom-checkbox__input" type="checkbox">
                                        <span class="custom-checkbox__input-fake "></span>
                                        <span class="custom-checkbox__label">Select All</span>
                                    </label>
                                    @foreach($categories->sortBy('title')->slice(0,9) as $category)
                                        <label class="custom-checkbox mb-4">
                                            <input name="category[]"
                                                   @if((request()->has('category') && in_array($category->id,request()->get('category')))
                                                      || (isset(request()->category) &&  !is_array(request()->category) && request()->category->slug===$category->slug)) checked
                                                   @endif
                                                   value="{{$category->id}}" class="custom-checkbox__input"
                                                   type="checkbox">
                                            <span class="custom-checkbox__input-fake "></span>
                                            <span
                                                class="custom-checkbox__label">{{$category->title}} ({{$category->products_count}})</span>
                                        </label>
                                @endforeach

                                <!-- кнопка - показать скрытые -->
                                    <a href="#" class="show-more-item btn btn--underline-warninng w-100">Show more</a>
                                    <!-- ------- -->
                                    <!-- контейнер для скрытых элементов -->
                                    <div class="more-items" style="display: none;">
                                        @foreach($categories->sortBy('title')->slice(9) as $category)
                                            <label class="custom-checkbox mb-4">
                                                <input name="category[]"
                                                       @if((request()->has('category') && in_array($category->id,request()->get('category')))
                                                          || (isset(request()->category) &&  !is_array(request()->category) && request()->category->slug===$category->slug)) checked
                                                       @endif
                                                       value="{{$category->id}}" class="custom-checkbox__input"
                                                       type="checkbox">
                                                <span class="custom-checkbox__input-fake "></span>
                                                <span class="custom-checkbox__label">{{$category->title}} ({{$category->products_count}})</span>
                                            </label>
                                        @endforeach
                                    </div>
                                    <!-- ------- -->
                                </div>
                            </div>
                    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  
    $('#select-all-checkbox').change(function() {
        
        if ($(this).is(':checked')) {            
            $('.filters-item[data-accordeon]').addClass('active-accordeon');
            window.location.href = '{{ route("main.category.list") }}';
            localStorage.setItem('select-all-checkbox', 'checked');
        }else {
                $('.filters-item[data-accordeon]').removeClass('active-accordeon');
                localStorage.removeItem('select-all-checkbox');
            }
    });

    if (localStorage.getItem('select-all-checkbox') === 'checked') {
            $('#select-all-checkbox').prop('checked', true);
        }
    
});
</script>
