@extends('main.layouts.main')
@section('wrapper_class')
    pt-header
@endsection
@section('title') {{$title}} @endsection

@section('content')
    <div class="container container-xl">
        <div class="category-page">
            @include('main.sections.pages.profile.user.sidebar')
            <div class="category-page__content">

                <div class="border-card">
                    <form action="{{$url}}" method="POST" class="max-w-630">
                        @csrf
                        @if($address)
                            @method('PUT')
                        @endif
                        <div class="input-colums">
                            <div class="input-wrap input-col-6 mb-20">
                                <label class="label-custom">Name</label>
                                <input class="input" name="name" type="text" value="@if($address) {{$address->name}} @else {{old('name')}} @endif">
                                @error('name')
                                    <span class="error-message">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input-wrap input-col-6 mb-20">
                                <label class="label-custom">Phone</label>
                                <input class="input" name="phone" type="text" value="@if($address) {{$address->phone}} @else {{old('phone')}} @endif">
                                @error('phone')
                                 <span class="error-message">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input-wrap input-col-6 mb-20">
                                <label class="label-custom">Is main</label>
                                <select class="select-default brand_id" name="is_main">
                                    <option value="" >Not main</option>
                                    <option value="on"
                                            @if(old('is_main')=='on' || ($address && $address->is_main=='on')) selected
                                        @endif >Is main</option>
                                </select>
                            </div>

                        </div>
                        <div class="input-wrap mb-30">
                            <label class="label-custom">Location</label>
                            <input class="input" name="location" type="text" value="@if($address) {{$address->location}} @else {{old('location')}} @endif">
                            @error('location')
                                <span class="error-message">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-30 pb-30 border-bottom">
                            <button  class="btn btn--warning  btn--md radius-3 ttu">Save Changes</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
