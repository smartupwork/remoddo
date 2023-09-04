<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h5>Products for <span class="border-underline"> confirmation </span></h5>

        </div>
        <div class="card-body  table-responsive p-0">
            <table id="pages-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="ids-column">ID</th>
                    <th>Product name</th>
                    <th>Brand</th>
                    @foreach($attributes as $attribute)
                        <th class="attribute-cols"
                            data-name="{{$attribute->name}}">{{$attribute->title}}</th>
                    @endforeach
                    <th>Liked</th>
                    <th>Sales per month</th>
                    <th>Trending</th>
                    <th>Brands</th>
                    <th class="actions-column-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('/js/admin/products.js')}}"></script>
@endpush
