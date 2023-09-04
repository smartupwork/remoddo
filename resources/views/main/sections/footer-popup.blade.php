@if(request()->product)
    @php
      $categories_id=request()->product->categories->pluck('id')->toArray()
    @endphp
@else
    @php
        $product=null
    @endphp
@endif

<div id="category" class="modal modal-1 ">

    <div class="modal__dialog modal__dialog--600">
        <div class="modal__content">
            <div class="modal__header">
                <h2 class="modal__title">Category</h2>
                <a href="#" class="btn-close btn btn--secondary btn--sm-rounded rounded border-none btn-40" data-close-modal="">
                    <img src="{{asset('main/img/icons/icon-close.svg')}}">
                </a>

            </div>
            <div class="modal__body">
                <div class="input-wrap mb-30">
                    <form class="input-search-form">
                        <label class="relative">
                            <input type="text" data-url="{{route('main.profile.lender.category-search',$product)}}" class="input-search-window category-search w-100" placeholder="Search for anything...">
                            <button type="submit" class="form-search__btn">
                                <img src="{{asset('main/img/icons/icon-search.svg')}}">
                            </button>
                        </label>
                        <ul class="search-window"></ul>

                        <!-- <ul class="search-window">
                            <li>
                                <a href="#" class="search-window__item active">
                                    <span>black dress</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="search-window__item">
                                    <span class="name-artis">black dress <span class="w-700">formal</span></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="search-window__item">
                                    <span class="name-artis">black dresses <span class="w-700">for women</span></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="search-window__item">
                                    <span class="name-artis">black dress <span class="w-700">goth</span></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="search-window__item">
                                    <span class="name-artis">black dress <span class="w-700">gothic</span></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="search-window__item">
                                    <span class="name-artis">black dress <span class="w-700">white collar</span></span>
                                </a>
                            </li>
                        </ul> -->
                    </form>
                </div>



                <h4 class="ttu mb-20">All Categories</h4>
                <div class="category-list">
                @foreach($categories as $category)
                <div class="category-accordeon border-bottom parent-category parent-{{$category->id}}" data-spoller>
                    <div class="category-accordeon__btn" data-spoller-btn>
                        <span class="category-accordeon__title">{{$category->title}}</span>
                        <div class="category-accordeon__arrow">
                            <img src="{{asset('main/img/icons/arrow-right.svg')}}">
                        </div>
                    </div>
                    <div class="category-accordeon__content accordeon-{{$category->id}}" style="display: none;" data-spoller-drop>
                        <div class="d-flex flex-column">
                            @foreach($category->children as $child)
                            <label class="custom-checkbox mb-20">
                                <input type="checkbox" name="category_id[]" data-tag-title="{{$child->title}}"  data-tag-id="{{$child->id}}" value="{{$child->id}}" @if(in_array($child->id,$categories_id)) checked @endif class="category_id category-children-item custom-checkbox__input category_checkbox_{{$child->id}}">
                                <span class="custom-checkbox__input-fake">
                                </span>
                                <span class="custom-checkbox__label pl-14">{{$child->title}} ({{$child->products_count}})</span>
                            </label>
                            @endforeach

                        </div>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
