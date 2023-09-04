<div class="d-flex mb-12">
    <div class="input-wrap w-100 mr-10">
        <label class="label-custom">Days</label>
        <input class="input rent_day" name="rent_day" type="text" placeholder="{{$page->show('rent:day')}}">
    </div>
    <div class="input-wrap w-100 mr-10">
        <label class="label-custom">Price</label>
        <div class="input-icon icon-right">
            <input class="input rent_price" name="rent_price" type="text" placeholder="{{$page->show('rent:price')}}">
            <div class="icon">
                £
            </div>
        </div>
    </div>
    <div class="group-label">
{{--        <label class="label-custom-2 rent-row-count text-end">0 left</label>--}}
        <a href="#" class="btn mt-20 btn--warning add_rent btn--md radius-3 ws-nowrap fs-14 ttu">+ Add</a>
    </div>
</div>

<div class="table-wrapper mb-30">
    <table class="table table-stick rent_table">
        <thead>
        <tr>
            <th class="text-start" style="width: 200px;">
                Days
            </th>
            <th class="text-start">
                Price
            </th>
            <th class="text-start" style="width: 10px;">
                Actions
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($product->rents as $rent)
        <tr>
            <td>
                {{$rent->day}}
            </td>
            <td>
                £{{$rent->rent_price}}
            </td>
            <td>
                <a href="" class="btn btn--outline delete-rent-row btn--sm radius-3 ttu">Delete</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

</div>
<span class="error error-rents error-message"></span>

@push('scripts')
    <script src="{{asset('main/js/rent-table.js')}}"></script>
@endpush
