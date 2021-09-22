@extends('layouts.app')

@section('styles')

    <style type="text/css">
        .invalid-feedback{
            display: block;
        }

        .login .form-group span{
          color: #adb5bd;
        }
        .form-group span.invalid-feedback{
          color: #fb6340;
        }

        .navbar-brand img{
          max-width: 80px;
          max-height: 80px;
        }
    </style>

@endsection

@section('content')
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="#" >
          <img src="{{ asset('public-assets/images/') }}/{{ App\Settings::first()->dark_logo }}" alt="{{ App\Settings::first()->dark_logo }}" /> 
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
 
          <!-- Navbar items -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="{{ route('login') }}">
                <i class="ni ni-key-25"></i>
                <span class="nav-link-inner--text">{{ __('back_end.login.sign_in')}}</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">{{ __('back_end.login.welcome')}}</h1>
            <p class="text-lead text-white">{{ __('back_end.login.provide_info') }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">

        <!-- Table -->
        <div class="row justify-content-center login">
            <div class="col-lg-5 col-md-7">
              <div class="card bg-secondary shadow border-0">
       
                <div class="card-body px-lg-5 py-lg-5">
                  <div class="text-center text-muted mb-4">
                    <small>{{ __('back_end.login.permission_details') }}</small>
                  </div>
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="form-group mb-3">
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                        </div>
                        <input id="email" type="email" placeholder="{{__('back_end.login.email')}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        
                      </div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                        </div>
                         <input id="password" placeholder="{{__('back_end.login.password')}}" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="current-password">
                      </div>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="custom-control custom-control-alternative custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="remember" id="customCheckLogin" {{ old('remember') ? 'checked' : '' }}>
                      <label class="custom-control-label" for="customCheckLogin">
                        <span class="text-muted">{{__('back_end.login.remember_me')}}</span>
                      </label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary my-4">{{__('back_end.login.sign_in_btn')}}</button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-6">
                @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}" class="text-light"><small>{{__('back_end.login.forget_pass')}}</small></a>
                @endif
                </div>
              </div>
            </div>
        </div>


    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-12">
          <div class="copyright text-center text-xl-center text-muted">
            &copy; {{ now()->year }} {{ __('back_end.developed_by') }} <a href="https://codeshaper.net/" class="font-weight-bold ml-1" target="_blank">{{ __('back_end.developer') }}</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Argon Scripts -->
@endsection
