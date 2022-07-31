<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    @yield('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
</head>

@yield('breadcrumbs')

<body class="secondary-color">
    @include('layouts.partials.header')
    @yield('menu')
    @yield('parse-content')

    <main class="py-4">
        @yield('content')
        @yield('js')
    </main>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/recaptcha-api.js') }}"></script>
</body>

@include('layouts.partials.footer')

</html>
