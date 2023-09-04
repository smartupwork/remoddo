<div class="col-lg-6">
    <div class="card">
        <div class="card-header">
            <h5 class="flex-auto">Best Performing  <span class="border-underline"> Lenders </span></h5>
        </div>
        <div class="card-body  table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>
                        User name
                    </th>
                    <th>
                        Rating
                    </th>
                    <th>
                        Orders/months
                    </th>
                    <th>
                        Amount per months
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($lenders as $lender)
                <tr>
                    <td><a href="{{route('admin.lenders.edit',$lender)}}">{{$lender->info->full_name}}</a> </td>
                    <td>{{$lender->rating}} <i class="fas fa-star text-warning"></i></td>
                    <td>
                        {{$lender->myRequests->count()}}
                    </td>
                    <td>
                        £{{$lender->myRequests->sum('total_price')}}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-lg-6">
    <div class="card">
        <div class="card-header">
            <h5 class="flex-auto">Best Performing  <span class="border-underline"> Renters </span></h5>
        </div>
        <div class="card-body  table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>
                        User name
                    </th>
                    <th>
                        Rating
                    </th>
                    <th>
                        Orders/months
                    </th>
                    <th>
                        Amount per months
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($renters as $renter)
                    <tr>
                        <td><a href="{{route('admin.renters.edit',$renter)}}">{{$renter->info->full_name}}</a> </td>
                        <td>{{$renter->rating}} <i class="fas fa-star text-warning"></i></td>
                        <td>
                            {{$renter->rentals->count()}}
                        </td>
                        <td>
                            £{{$renter->rentals->sum('total_price')}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
