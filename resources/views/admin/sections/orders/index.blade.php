@extends('admin.layouts.admin')

@section('title', 'Orders')



@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex flex-column">
                    <div class="d-flex align-items-center flex-wrap">
                        <div class="form-group mr-4">
                            <label>Sales per Product:</label>
                            <select id="products" class="form-control select2" multiple="multiple" style="width: 100%;">
                                @foreach($products as $id=>$title)
                                    <option value="{{$id}}">{{$title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mr-4">
                            <label>Sales per Brand:</label>
                            <select id="brands" class="form-control select2" multiple="multiple" style="width: 100%;">
                                @foreach($brands as $id=>$title)
                                    <option value="{{$id}}">{{$title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mr-4">
                            <label>Sales per Renter:</label>
                            <select id="renters" class="form-control select2" multiple="multiple" style="width: 100%;">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->info->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mr-4">
                            <label>Sales per Lender:</label>
                            <select id="lenders" class="form-control select2" multiple="multiple" style="width: 100%;">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->info->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between card-header">
                    <div class="form-group">
                        <select id="status" class="form-control" style="width: 200px">
                            <option value="" selected>Select</option>
                            @foreach($orderStatuses as $key=>$status)
                                <option value="{{$key}}">{{$status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ml-auto">
                        <label>Date range:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                  <span class="input-group-text">
                  <i class="far fa-calendar-alt"></i>
                  </span>
                            </div>
                            <input type="text" class="form-control float-right" id="reservation">
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <table id="pages-table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="ids-column">Order ID</th>
                            <th>Invoice number</th>
                            <th>Product name</th>
                            <th>Order total(USD)</th>
                            <th>Order Status</th>
                            <th>Lender name</th>
                            <th>Renter name</th>
                            <th>Date</th>
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
@endsection

@push('scripts')
    <script src="{{asset('/js/admin/orders.js')}}"></script>
@endpush
