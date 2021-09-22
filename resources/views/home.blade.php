@extends('layouts.app')

@section('content')

  <!-- Sidenav -->
    @include('includes.side-nav')
  <!-- END Sidenav -->

  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    @include('includes.top-nav')

    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body"></div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">

      <router-view></router-view>

      <!-- Footer -->
      @include('includes.footer')


    </div>
  </div>
  <!-- Argon Scripts -->

@endsection
