<div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
    <div class="form-group w-200 mb-4">
        <select class="select-default product_sorting" name="sort">
            <option value="">Sort by</option>
            <option value="oldest" @if(request()->get('sort')=='oldest') selected @endif>Oldest</option>
            <option value="new-completed" @if(request()->get('sort')=='new-completed') selected @endif>New-Completed</option>
            <option value="completed-new" @if(request()->get('sort')=='completed-new') selected @endif>Completed-New</option>
        </select>
    </div>
</div>
