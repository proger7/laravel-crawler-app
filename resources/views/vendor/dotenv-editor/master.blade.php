<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('meta::manager', [
        'title'         => 'Web Crawler App',
        'description'   => 'This is app for scrapping data',
        'image'         => '/images/crawler.png',
    ])
    @yield('head')
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-for-env-editor.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/fontawesome/css/all.css') }}">
</head>
<body>
    @yield('content')
    <div class="container">
	    <div class="input-group-btn form-group d-flex justify-content-between">
			<p>
				<a href="{{ route('home') }}" type="submit" class="btn btn-primary">Back to Home <i class="fa fa-home fa-lg" aria-hidden="true"></i></a>
			</p>
	    </div>
	</div>
</body>
</html>
