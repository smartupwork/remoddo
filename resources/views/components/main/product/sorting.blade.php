<div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
    <h3 class="ttu fw-900 pe-4 mb-4">{{$title}}</h3>
    <div class="form-group w-200 mb-4">
        <select class="select-default product_sorting" name="sort">
            <option value="">Sort by</option>
            <option value="title" @if(request()->get('sort')=='title') selected @endif>Name</option>
            <option value="low-high" @if(request()->get('sort')=='low-high') selected @endif>Low-High</option>
            <option value="high-low" @if(request()->get('sort')=='high-low') selected @endif>High-Low</option>
            <option value="A-Z" @if(request()->get('sort')=='A-Z') selected @endif>Brand A-Z</option>
            <option value="Z-A" @if(request()->get('sort')=='Z-A') selected @endif>Brand Z-A</option>
        </select>
    </div>
</div>
