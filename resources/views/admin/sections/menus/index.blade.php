@extends('admin.layouts.admin')

@section('title', 'Menus')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Menus</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-outline-default">
                        <div class="card-header border-none pb-0">
                            <h4 class="heading heading-4">Menu Table</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-block">
                                <div class="table-block-body">
                                    <table id="menu-table" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@push('scripts')
    <script src="{{asset('js/admin/menus.js')}}"></script>
@endpush
