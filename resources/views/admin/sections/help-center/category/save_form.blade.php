@extends('admin.layouts.admin')

@section('title', $title)

@section('content_header')
    <x-admin.title
        text="Add Help Center Category"
    />
@stop

@section('content')
    <form action="{{$url}}" method="POST" class="general-ajax-submit">
        @csrf
        @if($category->id)
            @method('PUT')
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" value="@if($category->title) {{$category->title}} @else {{old('title')}} @endif"
                                   class="form-control">
                            <span data-input="title" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content" class="form-control" id="content" cols="30" rows="10">@if($category->content) {{$category->content}} @else {{old('content')}} @endif</textarea>
                            <span data-input="content" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="form-check">
                            <input name="is_active" type="checkbox" id="is_show"
                                   @if(old('is_active')=='on' || ($category->is_active=='on')) checked
                                   @endif  class="form-check-input">
                            <label class="form-check-label" for="is_show">
                                Is active
                            </label>
                            <span data-input="is_active" class="input-error"></span>
                        </div>
                    </div>



                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success min-w-100">Save</button>
        <a href="{{ route('admin.help-center-category.index') }}" class="btn btn-outline-secondary text-dark min-w-100">Cancel</a>
    </form>
@endsection
