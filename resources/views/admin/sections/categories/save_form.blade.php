@extends('admin.layouts.admin')

@section('title', $title)

@section('content_header')
    <x-admin.title
        text="Category"
    />
@stop

@section('content')
    <form action="{{$url}}" method="POST" class="general-ajax-submit">
        @csrf
        @if($category)
            @method('PUT')
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" value="@if($category) {{$category->title}} @else {{old('title')}} @endif"
                                   class="form-control">
                            <span data-input="title" class="input-error"></span>
                        </div>
                    </div>
                    @if($category)
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Slug</label>
                            <input  type="text" readonly value="{{$category->slug}}" class="form-control">
                        </div>
                    </div>
                    @endif
                    <div class="col-md-6 mt-5">
                        <div class="form-check">
                            <input name="is_show" type="checkbox" id="is_show"
                                   @if(old('is_how')=='on' || ($category && $category->is_show=='on')) checked
                                   @endif  class="form-check-input">
                            <label class="form-check-label" for="is_show">
                                Is show
                            </label>
                            <span data-input="is_show" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="form-check">
                            <input name="is_popular" type="checkbox" id="is_popular"
                                   @if(old('is_popular')=='on' || ($category && $category->is_popular=='on')) checked
                                   @endif  class="form-check-input">
                            <label class="form-check-label" for="is_popular">
                                Is popular
                            </label>
                            <span data-input="is_popular" class="input-error"></span>
                        </div>
                    </div>




                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Image</label>
                            <input name="image" type="file" class="form-control">
                            <span data-input="image" class="input-error"></span>
                        </div>
                        @if($category)
                        <img src="{{asset($category->image)}}" alt="">
                        @endif
                    </div>


                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success min-w-100">Save</button>
        <a href="{{ $cancel_url }}" class="btn btn-outline-secondary text-dark min-w-100">Cancel</a>
    </form>
@endsection
