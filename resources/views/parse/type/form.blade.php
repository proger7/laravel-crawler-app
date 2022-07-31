@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
@endsection

@section('breadcrumbs')
    @switch(Route::current()->getName())
        @case('category')
            {{ Breadcrumbs::render('category') }}
            @break

        @case('manufacturer')
            {{ Breadcrumbs::render('manufacturer') }}
            @break

        @case('product')
            {{ Breadcrumbs::render('product') }}
            @break

        @case('subcategory')
            {{ Breadcrumbs::render('subcategory') }}
            @break
    @endswitch
@endsection

@section('parse-content')
    <div class="container">
        @switch(Route::current()->getName())
            @case('category')
                @include('parse.type.partials.category')
                @break

            @case('manufacturer')
                @include('parse.type.partials.manufacturer')
                @break

            @case('product')
                @include('parse.type.partials.product')
                @break

            @case('subcategory')
                @include('parse.type.partials.subcategory')
                @break

            @default
                @include('parse.index')
        @endswitch
    </div>
    <div class="container" id="persik"></div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i><br/>
        <span>Loading</span>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/2c7a93b259.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
@endsection