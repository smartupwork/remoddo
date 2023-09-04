@extends('admin.layouts.admin')

@section('title', 'Attributes')

@section('content_header')
    <x-admin.title
        text="Attributes"
        :button="['+ Add Attribute', route('admin.attributes.create')]"
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
                                <th>Title</th>
                                <th>Name</th>
                                <th>Values count</th>
                                <th>Is required</th>
                                <th>Is show</th>
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
    <script src="{{asset('/js/admin/attributes.js')}}"></script>
@endpush
