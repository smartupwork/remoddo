<div class="col-md-7 col-sm-12 col-12 d-flex">
    <div class="card w-100">
        <div class="card-header">
            <h3 class="card-title">
                Payment credentials
            </h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>Card Number</th>
                    <th>Expiration Date</th>
                    <th>CVC</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->localPaymentMethods as $pm)
                <tr>
                    <td>
                        <div class="card-number">
                          <span class="d-flex mr-2">
                            <img src="{{asset($pm->image)}}">
                          </span>
                            <b>•••• •••• •••• {{$pm->card_number}}</b>
                        </div>
                    </td>
                    <td>
                        {{$pm->exp_year}} / {{$pm->exp_month}}
                    </td>
                    <td>
                        •••
                    </td>
                    <td>
                        @if($pm->default_method)
                        <span class="badge bg-warning">
                          Main Method
                        </span>
                        @else
                            -
                        @endif
                    </td>

                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
