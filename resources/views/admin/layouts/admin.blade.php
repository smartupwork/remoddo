@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/main.css')}}">
    @stack('styles')
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.0-beta.5/chart.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="{{asset('js/admin/custom.js')}}"></script>
    <script src="{{asset('js/admin/main.js')}}"></script>
    @stack('scripts')
@stop
