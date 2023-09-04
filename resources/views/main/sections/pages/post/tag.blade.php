<div class="input-wrap border-bottom pb-30 mb-30">
    <form class="input-search-form">
        <div class="d-flex mb-8">
            <div class="relative mr-10 w-100">
                <label class="label-custom">Tags</label>
                <input type="text" data-url="{{route('main.tag.search')}}"
                       name="tag"
                       class="input-search-window tag-search multiple   w-100"
                       placeholder="Shape, colour, style, function, etc.">
                <ul class="search-window search-tag-window">

                </ul>
            </div>
            <div class="group-label">
{{--                <label class="label-custom-2 text-end tag_count">{{$tags_count}} left</label>--}}
                <a href="#" class="btn mt-20 add-tag-btn btn--warning btn--md radius-3 ws-nowrap fs-14 ttu">+ Add</a>
            </div>
        </div>
        <ul class="tag-list tag-list--tags" data-delete-icon="{{asset('main/img/icons/icon-delete-tag.svg')}}">
            @foreach($product->tags as $tag)
                <li class="tag-item">
                                        <span class="tag">
                                            <button class="btn"><img src="{{asset('main/img/icons/icon-delete-tag.svg')}}"></button>
                                            <span class="info">{{$tag->title}}</span>
                                        </span>
                </li>
            @endforeach
        </ul>
    </form>
</div>

@push('scripts')
    <script src="{{asset('main/js/tag-search.js')}}"></script>
@endpush
