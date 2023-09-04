<div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
    <div class="form-group w-200 mb-4">
        <select class="select-default product_sorting" name="sort">
            <option value="">Sort by</option>
            <option value="oldest" @if(request()->get('sort')=='oldest') selected @endif>Oldest</option>
            <option value="A-Z" @if(request()->get('sort')=='A-Z') selected @endif>A-Z</option>
            <option value="Z-A" @if(request()->get('sort')=='Z-A') selected @endif>Z-A</option>
            <option value="hide-active" @if(request()->get('sort')=='hide-active') selected @endif>Hide-Active</option>
            <option value="active-hide" @if(request()->get('sort')=='active-hide') selected @endif>Active-Hide</option>
        </select>
    </div>
</div>
