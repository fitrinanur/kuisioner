<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="{{ App\Settings::first() ? App\Settings::first()->site_title : 'page title' }}">
  <meta name="author" content="{{ __('back_end.author') }}">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ App\Settings::first() ? App\Settings::first()->site_title : 'page title' }}</title>
  <!-- Favicon -->
  <link href="{{ asset('admin-assets/img/brand/favicon.png') }}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300&family=Open+Sans:ital,wght@0,600;0,700;1,300;1,400&display=swap" rel="stylesheet">
  <!-- Icons -->
  <link href="{{ asset('admin-assets/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
  <link href="{{ asset('admin-assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="{{ asset('admin-assets/css/argon.css?v=1.0.0') }}" rel="stylesheet">
  <link href="{{asset('css/app.css')}}">
  @yield('styles')
</head>

<body>

    <div id="app">
        <!-- Page Container -->
        @yield('content')
        <!-- END Page Container -->
    </div>

  <!-- Argon Scripts -->
  <!-- Core -->
  
  <script src="{{asset('js/app.js')}}"></script>
  <script src="{{ asset('admin-assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('admin-assets/js/argon.js?v=1.0.0') }}"></script>
  @yield('scripts')
</body>

</html>