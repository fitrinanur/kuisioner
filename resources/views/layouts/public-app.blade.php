<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ App\Settings::first() ? App\Settings::first()->site_title : 'page title' }}</title>
    <!-- End Make Inline CSS -->
    <link rel="icon" href="{{ asset('public-assets/images/') }}/{{ App\Settings::first()->favicon }}" />
   
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('public-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public-assets/css/all.min.css') }}">
    <!-- Font awesome css -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,900" rel="stylesheet">
    <!-- Owl carousel css -->
    <link rel="stylesheet" href="{{ asset('public-assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public-assets/css/owl.theme.default.min.css') }}">
    <!-- Custom Stylesheet after this line -->
    <link rel="stylesheet" href="{{ asset('public-assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public-assets/css/responsive.css') }}">
    @yield('styles')    

</head>

<body class="{{ App\Settings::first()->theme_style == 1 ? 'dark' : 'light'}}" >
    
	@yield('content')


    <!-- Scripts -->
    <script src="{{ asset('public-assets/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('public-assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('public-assets/js/bootstrap.min.js') }}"></script>
    <!-- owl carousel js -->
    <script src="{{ asset('public-assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public-assets/js/copy-to-clipboard.js') }}"></script>
    <script src="{{ asset('public-assets/js/slick.js') }}"></script>
    @yield('scripts')
    <script src="{{ asset('public-assets/js/main.js') }}"></script>

</body>

</html>