@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('/plugins/fontawesome/css/all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loading.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/table.css') }}">
@endsection

@section('content')
    <div id="content">
        @include('logs.partials.index')
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i><br/>
        <span>Loading</span>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/ajax-crud.js') }}"></script>
    <script src="{{ asset('js/2c7a93b259.js') }}"></script>
    <script src="{{ asset('js/notify.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
@endsection