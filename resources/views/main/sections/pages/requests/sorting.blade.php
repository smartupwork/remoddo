<div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">

    <div class="form-group w-200 mb-4">
        <select class="select-default product_sorting" name="sort">
            <option value="">Sort by</option>
            <option value="newest" @if(request()->get('sort')=='newest') selected @endif>Newest</option>
            <option value="oldest" @if(request()->get('sort')=='oldest') selected @endif>Oldest</option>
            <option value="by-rating" @if(request()->get('sort')=='by-rating') selected @endif>By Rating</option>
        </select>
    </div>
</div>
