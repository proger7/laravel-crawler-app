@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('parse') }}
@endsection

@section('menu')
    <div class="flex-center position-ref full-height">
        <div id="app" class="content">
            <parse-component></parse-component>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
@endsection