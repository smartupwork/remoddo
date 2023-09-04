@extends('admin.layouts.admin')

@section('title', $title)

@section('content_header')
    <x-admin.title
        text="Attribute value"
    />
@stop

@section('content')
    <form action="{{$url}}" method="POST" class="general-ajax-submit">
        @csrf
        @if($data)
            @method('PUT')
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Value</label>
                            <input name="value" type="text" value="@if($data) {{$data->value}} @else {{old('value')}} @endif"
                                   class="form-control">
                            <span data-input="value" class="input-error"></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success min-w-100">Save</button>
        <a href="{{ route('admin.attributes.values.index',['attribute'=>$attribute->id]) }}" class="btn btn-outline-secondary text-dark min-w-100">Cancel</a>
    </form>
@endsection
