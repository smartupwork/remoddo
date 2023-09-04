@extends('main.layouts.main')
@section('wrapper_class')
    pt-header
@endsection

@section('title')
    {{-- {{$title}} --}}
@endsection
@section('content')

        <h1>Hello world</h1>
@endsection
@push('scripts')
    <script src="{{asset('main/js/product-click.js')}}"></script>
@endpush
