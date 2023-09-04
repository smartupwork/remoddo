@extends('admin.layouts.admin')

@section('title', 'Renter Edit')
@section('content_header')
    <x-admin.title
        text="Edit Renter"
    />
@stop
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                @include('components.admin.user_info',['user'=>$renter])
                @include('components.admin.user_payment_credentials',['user'=>$renter])
            </div>

            <div id="remove-user" class="d-flex align-items-center justify-content-between">
                <button data-link="{{route("admin.renters.destroy", $renter)}}" type="button" class="delete-resource btn btn-danger btn-sm">Delete</button>
            </div>
            <h3 class="mb-3">Products list</h3>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="pages-table"  class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th class="ids-column">ID</th>
                                        <th>Product name</th>
                                        <th>Brand</th>
                                        @foreach($attributes as $attribute)
                                            <th class="attribute-cols"
                                                data-name="{{$attribute->name}}">{{$attribute->title}}</th>
                                        @endforeach
                                        <th>Period</th>
                                        <th>Violations</th>
                                        <th>Paid Amount</th>
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
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
@push('scripts')
    <script src="{{asset('/js/admin/renter-products.js')}}"></script>
@endpush

