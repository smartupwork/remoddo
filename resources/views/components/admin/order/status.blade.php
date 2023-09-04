{{-- Display general actions for admin panel data tables. Default actions is 'show' and 'destroy' --}}
<div class="table-actions d-flex align-items-center">
    @if (isset($status) && $status==='new')
        <span class="badge bg-primary">{{$status}}</span>
    @endif
    @if (isset($status) && $status==='confirmed')
        <span class="badge bg-success">{{$status}}</span>
    @endif
    @if (isset($status) && $status==='completed')
        <span class="badge bg-info">{{$status}}</span>
    @endif

    @if (isset($status) && $status==='canceled')
        <span class="badge bg-danger">{{$status}}</span>
    @endif

    @if (isset($status) && $status==='failed')
        <span class="badge bg-warning">{{$status}}</span>
    @endif

</div>
