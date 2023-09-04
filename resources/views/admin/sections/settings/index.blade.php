@extends('admin.layouts.admin')

@section('title', 'Settings')

@section('content_header')
    <x-admin.title
        text="Settings"
        bcRoute="admin.settings.index"
    />
@stop

@section('content')
    <form action="{{ route('admin.settings.update') }}" method="POST" class="general-ajax-submit">
        @csrf
        @method('PUT')
        @foreach (\App\Models\Setting::EDATABLE_SETTINGS as $settingsCategory)
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">{{$settingsCategory['name']}}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($settingsCategory['settings'] as $setting => $label)
                            @if($settingsCategory['input_type']=='input')
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{$label}}</label>
                                    <input name="s[{{$setting}}]" type="text" class="form-control" value="{{\App\Models\Setting::get($setting)}}">
                                </div>
                            </div>
                      @else
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{$label}}</label>
                                    <textarea
                                        name="s[{{$setting}}]"
                                        class="form-control summernote"
                                        rows="2"
                                        cols="2"
                                        id="editor{{$setting}}"
                                    >
                                        {{\App\Models\Setting::get($setting)}}
                                    </textarea>
                                </div>
                            </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
        <button type="submit" class="btn btn-success min-w-100">Save</button>
{{--        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary text-dark min-w-100">Cancel</a>--}}
    </form>
@endsection
