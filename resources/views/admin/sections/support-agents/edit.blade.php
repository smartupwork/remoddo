@extends('admin.layouts.admin')

@section('title', 'Support Agent Edit')
@section('content_header')
    <x-admin.title
        text="Support Agent"
    />
@stop

@section('content')
    <form action="{{ route('admin.supports.update',$support) }}" method="POST" class="general-ajax-submit">
        @method('PUT')
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>FIRST NAME</label>
                            <input name="name" type="text" class="form-control" value="{{$support->info->name??old('name')}}">
                            <span data-input="name" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>LAST NAME</label>
                            <input name="surname" type="text" class="form-control" value="{{$support->info->surname??old('surname')}}">
                            <span data-input="surname" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>EMAIL</label>
                            <input name="email"  type="text" class="form-control" value="{{$support->email??old('email')}}">
                            <span data-input="email" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>PASSWORD</label>
                            <input name="password" type="password" class="form-control">
                            <span data-input="password" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>CONFIRM PASSWORD</label>
                            <input name="password_confirmation" type="password" class="form-control">
                            <span data-input="password_confirmation" class="input-error"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success min-w-100">Save</button>
        <a href="{{ route('admin.supports.index') }}" class="btn btn-outline-secondary text-dark min-w-100">Cancel</a>
    </form>
@endsection
