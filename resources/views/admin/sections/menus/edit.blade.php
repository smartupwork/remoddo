@extends('admin.layouts.admin')

@section('title', 'Edit Menu #' . $menu->id)

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Menu {{$menu->name}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="breadcrumb float-sm-right">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <form role="form" id="EditorForm">
                            @csrf
                            <input type="hidden" name="code" value="{{ $menu->code }}">

                            <div class="card-header">
                                <h3 class="card-title operation-title">New item</h3>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="code" value="{{ $menu->code }}">
                                <div class="form-group">
                                    <label for="inputTitle">Title</label>
                                    <input type="text" name="title" class="form-control" id="inputTitle" placeholder="">
                                    <span data-field="title" class="invalid-feedback"></span>
                                </div>
                                <div class="form-group">
                                    <label for="inputLink">Link</label>
                                    <input type="text" name="link" class="form-control" id="inputLink" placeholder="">
                                    <span data-field="link" class="invalid-feedback"></span>
                                </div>
                            </div>
                            <div class="card-footer btns-wrap">
                                <button type="submit" class="btn btn-success">
                                    Add
                                </button>
                                <button type="button" class="btn btn-danger" style="display: none;">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $menu->name }}</h3>
                            <div class="btns-wrap float-right">
                                <button type="button" id="SaveSort" disabled class="btn btn-success">Save</button>
                                <button type="button" id="CancelSort" style="display: none;" class="btn btn-danger">Cancel</button>
                            </div>
                        </div>
                        <div class="card-body" id="cont">
                            <ul id="sortable" class="sortable list-group main-sort-list">
                                @foreach ($menu->items as $item)
                                    <li class="list-group-item" data-id="{{ $item->id }}">
                                        <div class="item-handle">
                                            @if($item->icon)
                                                <img style="max-height: 14px;" src="{{ $item->icon->path }}" alt="">
                                            @endif
                                            <i class="fa fa-files-o"></i> <span class="txt">{{ $item->title }}</span>
                                            <div class="btn-group float-right">
                                                <a href="#" class="btn btn-default btn-xs edit-item">Edit</a>
                                                <a href="#" class="btn btn-danger btn-xs remove-item">X</a>
                                            </div>
                                        </div>
                                        <ul class="sortable list-group">
                                            @foreach ($item->children() as $child)
                                                <li class="list-group-item" data-id="{{ $child->id }}">
                                                    <div class="item-handle">
                                                        <i class="fa fa-files-o"></i> <span class="txt">{{ $child->title }}</span>
                                                        <div class="btn-group float-right">
                                                            <a href="#" class="btn btn-default btn-xs edit-item">Edit</a>
                                                            <a href="#" class="btn btn-danger btn-xs remove-item">X</a>
                                                        </div>
                                                    </div>
                                                    <ul class="sortableLists list-group"></ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@push('scripts')
    <script>
        var items = {};

        @foreach ($menu->itemsAll as $item)
            items[{{$item->id}}] = {
            sort: {{ $item->sort }},
            title: '{!! $item->title !!}',
            link: '{{ $item->link }}',
            icon: {
                name: '{{ $item->icon->original_name ?? '' }}',
                path: '{{ $item->icon->path ?? '' }}'
            },
            @if (!is_null($item->parent_id))
            parent: {{ $item->parent_id }},
            @endif
        };
        @endforeach
    </script>

    <script src="{{ asset('js/admin/menus.js') }}"></script>
@endpush

@push('styles')
    <style>
        .list-group{
            border: none;
        }
        .list-group-item {
            position: relative;
            display: block;
            padding: 0.75rem 1.25rem;
            background-color: #fff;
            border: 1px solid rgba(0,0,0,.125);
        }
        .btn-default {
            background-color: #f8f9fa;
            border-color: #ddd;
            color: #444;
        }
        .remove-item{
            color: #fff;
            background-color: #c82333;
            border-color: #bd2130;
        }
        .operation-button-cancel {
            color: #fff;
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
@endpush
