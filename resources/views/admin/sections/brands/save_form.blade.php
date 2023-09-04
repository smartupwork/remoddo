@extends('admin.layouts.admin')

@section('title', $title)

@section('content_header')
    <x-admin.title
        text="Brand"
    />
@stop

@section('content')
    <form action="{{$url}}" method="POST" class="general-ajax-submit">
        @csrf
        @if($brand)
            @method('PUT')
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" value="@if($brand) {{$brand->title}} @else {{old('title')}} @endif"
                                   class="form-control">
                            <span data-input="title" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="form-check">
                            <input name="is_show" type="checkbox" id="is_show"
                                   @if(old('is_show')=='on' || ($brand && $brand->is_show=='on')) checked
                                   @endif  class="form-check-input">
                            <label class="form-check-label" for="is_show">
                                Is show
                            </label>
                            <span data-input="is_show" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Image</label>
                            <input name="image" type="file" class="form-control">
                            <span data-input="image" class="input-error"></span>
                        </div>
                        @if($brand)
                        <img src="{{asset($brand->image)}}" alt="">
                        @endif
                    </div>


                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success min-w-100">Save</button>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary text-dark min-w-100">Cancel</a>
    </form>
@endsection
