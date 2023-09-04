@extends('admin.layouts.admin')

@section('title', $title)

@section('content_header')
    <x-admin.title
        text="Add Help Center"
    />
@stop

@section('content')
    <form action="{{$url}}" method="POST" class="general-ajax-submit">
        @csrf
        @if($helpCenter->id)
            @method('PUT')
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title</label>
                            <input name="question" type="text" value="@if($helpCenter->question) {{$helpCenter->question}} @else {{old('question')}} @endif"
                                   class="form-control">
                            <span data-input="question" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control select2" name="category_id" style="width: 100%;">
                                @foreach($categories as $id=>$category)
                                    <option @if($id==$helpCenter->category_id || $id==old('category_id')) selected
                                            @endif value="{{$id}}">{{$category}}</option>
                                @endforeach
                            </select>
                            <span data-input="category_id" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Answer</label>
                            <textarea name="answer" class="form-control summernote" id="answer" cols="30" rows="10">@if($helpCenter->answer) {{$helpCenter->answer}} @else {{old('answer')}} @endif</textarea>
                            <span data-input="answer" class="input-error"></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Meta Title</label>
                            <input name="meta_title" type="text" value="@if($helpCenter->meta_title) {{$helpCenter->meta_title}} @else {{old('meta_title')}} @endif"
                                   class="form-control">
                            <span data-input="meta_title" class="input-error"></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Meta Description</label>
                            <input name="meta_description" type="text" value="@if($helpCenter->meta_description) {{$helpCenter->meta_description}} @else {{old('meta_description')}} @endif"
                                   class="form-control">
                            <span data-input="meta_description" class="input-error"></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Meta Keyword</label>
                            <input name="meta_keyword" type="text" value="@if($helpCenter->meta_keyword) {{$helpCenter->meta_keyword}} @else {{old('meta_keyword')}} @endif"
                                   class="form-control">
                            <span data-input="meta_keyword" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="form-check">
                            <input name="is_active" type="checkbox" id="is_show"
                                   @if(old('is_active')=='on' || ($helpCenter->is_active=='on')) checked
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
        <a href="{{ route('admin.help-center.index') }}" class="btn btn-outline-secondary text-dark min-w-100">Cancel</a>
    </form>
@endsection
