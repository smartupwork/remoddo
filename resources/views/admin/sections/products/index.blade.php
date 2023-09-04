@extends('admin.layouts.admin')

@section('title', 'Products')



@section('content')
    <div class="row">
        <div class="col-sm-12">


            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <select id='brand_confirmation' class="form-control" style="width: 200px">
                            <option value="" selected>Select</option>
                            @foreach($brandConfirmations as $status)
                                <option value="{{$status}}">{{$status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="table-responsive">
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
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('/js/admin/products.js')}}"></script>
@endpush
