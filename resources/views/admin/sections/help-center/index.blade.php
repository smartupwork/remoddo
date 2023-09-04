@extends('admin.layouts.admin')

@section('title', 'Help Center')

@section('content_header')
    <x-admin.title
        text="Add Help Center"
        :button="['+ Add Help Center', route('admin.help-center.create')]"
    />
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table id="pages-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="ids-column">ID</th>
                                <th>Question</th>
                                <th>Category</th>
                                <th>Is active</th>
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
    <script src="{{asset('/js/admin/help-center.js')}}"></script>
@endpush
