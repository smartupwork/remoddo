@extends('admin.layouts.admin')

@section('title', 'Problems Edit')
@section('content_header')
    <x-admin.title
        text="Problems"
    />
@stop

@section('content')
    <form action="{{ route('admin.problems.update',$problem) }}" method="POST" class="general-ajax-submit">
        @method('PUT')
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" class="form-control" value="{{$problem->title??old('title')}}">
                            <span data-input="title" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Description</label>
                            <input name="description" type="text" class="form-control" value="{{$problem->description??old('description')}}">
                            <span data-input="title" class="input-error"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success min-w-100">Save</button>
        <a href="{{ route('admin.problems.index') }}" class="btn btn-outline-secondary text-dark min-w-100">Cancel</a>
    </form>
@endsection
