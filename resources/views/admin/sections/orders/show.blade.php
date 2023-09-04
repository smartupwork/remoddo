@extends('admin.layouts.admin')

@section('title') Order @endsection



@section('content')
    <div class="container-fluid">

        <div class="row">
{{--            <div class="col-md-4 d-flex flex-column">--}}
{{--                <h3 class="mb-3">Invoice Document</h3>--}}
{{--                <div class="product-image-wrap p-5">--}}
{{--                    <div class="invoice">--}}
{{--                        <img src="img/basic-invoice-template.png" class="product-image" alt="Product Image">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="d-flex flex-column mt-2">--}}
{{--                    <button type="button" class="btn btn-secondary mb-2">--}}
{{--                        <i class="fas fa-download mr-2"></i>--}}
{{--                        <span>Download PDF</span>--}}
{{--                    </button>--}}
{{--                    <button type="button" class="btn btn-primary">--}}
{{--                        <i class="fas fa-sync-alt"></i>--}}
{{--                        <span>Reset Invoice</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
            <form method="post" action="{{route('admin.orders.update',['order'=>$order->id])}}" class="col-md-8 d-flex flex-column">
                @csrf
                @method('PUT')
                <h3 class="mb-3">Details:</h3>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product name</label>
                            <input type="text" class="form-control" value="{{$order->product->title}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Order Total</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" value="{{$order->total_price}}" disabled>
                                <div class="input-group-append">
                                    <span class="input-group-text">£</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Order Status</label>
                            <select class="form-control" name="status">
                                @foreach($statuses as $code=>$status)
                                <option value="{{$code}}" @if($code==$order->status) selected @endif>{{$status}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Lenders name</label>
                            <input type="text" class="form-control" value="{{$order->lender->info->full_name}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Renters' name</label>
                            <input type="text" class="form-control" value="{{$order->renter->info->full_name}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="text" class="form-control" value="{{$order->created_at->format('m/d/Y')}}" disabled>
{{--                            <div class="input-group date">--}}
{{--                                <input type="text" class="form-control datepicker-single" value="dq3wewer"/>--}}
{{--                                <div class="input-group-append">--}}
{{--                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date Period</label>
                            <input type="text" class="form-control" value="{{$order->date_range_picker}}" disabled>
{{--                            <div class="input-group">--}}
{{--                                <div class="input-group-prepend">--}}
{{--                      <span class="input-group-text">--}}
{{--                        <i class="far fa-calendar-alt"></i>--}}
{{--                      </span>--}}
{{--                                </div>--}}
{{--                                <input type="text" class="form-control float-right date-period">--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-auto">
                    <button type="submit"  class="btn btn-success mb-0">Save Order</button>
                </div>
            </form>
        </div>
        <!-- Small boxes (Stat box) -->

        <!-- /.row -->
    </div>
@endsection
