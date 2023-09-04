<div class="col-lg-6 d-flex">
    <div class="card w-100">
        <div class="card-header">
            <h5>BEST PERFORMING ITEM <span class="border-underline">(LAST 30 DAYS)</span></h5>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>Product name</th>
                    <th>Brand</th>
                    @foreach($attributes as $attribute)
                        <th class="attribute-cols"
                            data-name="{{$attribute->name}}">{{$attribute->title}}</th>
                    @endforeach
                    <th>Period</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lastOrders as $order)
                    <tr>
                        <td><a href="">{{$order->product->title}}</a></td>
                        <td>{{$order->product->brand->title}}</td>
                        @foreach($attributes as $attribute)
                            <td>{{$order->product->values->where('attribute_id', '=', $attribute->id)->pluck('value')->join('|')}}</td>
                        @endforeach
                        <td>{{$order->dateRangePicker}}</td>
                        <td>£{{$order->total_price}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
