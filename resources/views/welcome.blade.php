<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('meta::manager', [
        'title'         => __('account.logo'),
        'description'   => __('account.meta_desc'),
        'image'         => __('account.meta_img'),
    ])
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" crossorigin="anonymous">
</head>

{{ Breadcrumbs::render('home') }}

<body class="secondary-color">
    @include('layouts.partials.header')
    
    <div class="flex-center position-ref full-height">
        <div id="app" class="content">
            <menu-component></menu-component>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/notify.js') }}"></script>
</body>

@include('layouts.partials.footer')

</html>
