@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('/plugins/fontawesome/css/all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loading.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/bs-dialog/css/bootstrap-dialog.css') }}">
@endsection

@section('content')

<div id="content">
    {{ Breadcrumbs::render('statistics') }}

    <div class="container">
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops! Something went wrong!</strong>
                <br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="input-group-btn form-group d-flex justify-content-between">
              <a class="btn btn-danger" type="submit" href="{{ route('logs') }}">
                <i class="fas fa-backward"></i>&nbsp; Go to Logs
              </a>
              <a href="{{ route('home') }}" type="submit" class="btn btn-primary">
                <i class="fas fa-forward"></i>&nbsp; Prev
              </a>
        </div>

        @include('statistics.partials.graphs')

    </div>
</div>

@endsection

@section('js')
    {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}
    {!! $chart2->renderJs() !!}
    {!! $chart3->renderJs() !!}
    {!! $chart4->renderJs() !!}
    {!! $chart5->renderJs() !!}
    {!! $chart6->renderJs() !!}
    <script src="{{ asset('/plugins/bs-dialog/js/bootstrap-dialog.js') }}" defer></script>
    <script src="{{ asset('js/ajax-crud.js') }}" defer></script>
    <script src="{{ asset('js/2c7a93b259.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
@endsection