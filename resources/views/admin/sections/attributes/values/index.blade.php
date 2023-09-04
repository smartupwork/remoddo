@extends('admin.layouts.admin')

@section('title', 'Attribute Values')

@section('content_header')
    <x-admin.title
        text="Attributes"
        :button="['+ Add Attribute values', route('admin.attributes.values.create',['attribute'=>$attribute->id])]"
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
                                <th>Value</th>
                                <th>Attribute</th>
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
    <script src="{{asset('/js/admin/attribute_values.js')}}"></script>
@endpush
