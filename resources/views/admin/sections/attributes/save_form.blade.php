@extends('admin.layouts.admin')

@section('title', $title)

@section('content_header')
    <x-admin.title
        text="Attribute"
    />
@stop

@section('content')
    <form action="{{$url}}" method="POST" class="general-ajax-submit">
        @csrf
        @if($attribute)
            @method('PUT')
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" value="@if($attribute) {{$attribute->title}} @else {{old('title')}} @endif"
                                   class="form-control">
                            <span data-input="title" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" value="@if($attribute) {{$attribute->name}} @else {{old('name')}} @endif"
                                   class="form-control">
                            <span data-input="name" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input name="is_required" type="checkbox"
                                   @if(old('is_required')=='on' || ($attribute && $attribute->is_required=='on') ) checked
                                   @endif
                                   id="is_required" class="form-check-input">
                            <label class="form-check-label" for="is_required">
                                Is required
                            </label>
                            <span data-input="is_required" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input name="is_show" type="checkbox" id="is_show"
                                   @if(old('is_how')=='on' || ($attribute && $attribute->is_show=='on')) checked
                                   @endif  class="form-check-input">
                            <label class="form-check-label" for="is_show">
                                Is show
                            </label>
                            <span data-input="is_show" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input name="is_multiple" type="checkbox"
                                   @if(old('is_multiple')=='on' || ($attribute && $attribute->is_multiple=='on') ) checked
                                   @endif
                                   id="is_multiple" class="form-check-input">
                            <label class="form-check-label" for="is_multiple">
                                Is multiple
                            </label>
                            <span data-input="is_multiple" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input name="show_in_products_table" type="checkbox" id="show_in_products_table"
                                   @if(old('show_in_products_table')=='on' || ($attribute && $attribute->show_in_products_table=='on')) checked
                                   @endif  class="form-check-input">
                            <label class="form-check-label" for="show_in_products_table">
                                Show in products table
                            </label>
                            <span data-input="show_in_products_table" class="input-error"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success min-w-100">Save</button>
        <a href="{{ route('admin.attributes.index') }}" class="btn btn-outline-secondary text-dark min-w-100">Cancel</a>
    </form>
@endsection
