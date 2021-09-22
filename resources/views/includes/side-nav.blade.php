<!-- Sidenav -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
  <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="{{ route('home') }}">
        @if(App\Settings::first())
        <img class="light-logo" src="{{ asset('public-assets/images/') }}/{{ App\Settings::first()->light_logo }}" alt="{{ App\Settings::first()->dark_logo }}" />
        @else
        <img src="https://via.placeholder.com/300.png/09f/fff">
        @endif
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">

          <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="media align-items-center">
                      <span class="avatar avatar-sm rounded-circle">
                        @if(Auth::user()->photo)
                            <img src="{{ asset('admin-assets/img/profile') }}/{{ Auth::user()->photo }}" alt="{{ Auth::user()->photo }}" />
                        @else 
                        <img src="https://via.placeholder.com/300.png/09f/fff">
                        @endif
                        
                      </span>
                  </div>
              </a>
              <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">{{ __('back_end.includes.welcome') }}</h6>
                </div>
                <a href="{{ url('/') }}" class="dropdown-item" target="__blank">
                    <i class="ni ni-support-16"></i>
                    <span>{{ __('back_end.includes.back_home') }}</span>
                </a>
                <div class="dropdown-divider"></div>
                <router-link to="/profile" class="dropdown-item">
                    <i class="ni ni-single-02 text-yellow"></i>
                <span>{{ __('back_end.includes.my_profile') }}</span>
                </router-link>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ni ni-user-run text-warning"></i>
                    <span>{{ __('back_end.logout') }}</span>
                </a>
              </div>
          </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
              <div class="row">
                  <div class="col-6 collapse-brand">
                      <a href="{{ url('/') }}">
                        @if(App\Settings::first())
                            <img class="dark-logo" src="{{ asset('public-assets/images/') }}/{{ App\Settings::first()->light_logo }}" alt="{{ App\Settings::first()->light_logo }}" />
                        @else 
                            <img src="https://via.placeholder.com/300.png/09f/fff">
                        @endif
                      </a>
                  </div>
                  <div class="col-6 collapse-close">
                      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                          <span></span>
                          <span></span>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Navigation -->
          <ul class="navbar-nav">
              <li class="nav-item">
                  <router-link to="/home" class="nav-link">
                      <i class="ni ni-tv-2 text-primary"></i> {{ __('back_end.includes.nav.dashboard') }}
                  </router-link>
              </li>

              <li class="nav-item">
                  <router-link to="/users" class="nav-link">
                      <i class="ni ni-circle-08 text-pink"></i> {{ __('back_end.includes.nav.users') }}
                  </router-link>
              </li>

              <li class="nav-item">
                  <router-link to="/question-indicators" class="nav-link">
                      <i class="ni ni-key-25 text-info"></i> Indicator Pertanyaan
                  </router-link>
              </li>
              
              <li class="nav-item">
                  <router-link to="/questions" class="nav-link">
                      <i class="ni ni-key-25 text-info"></i> Pertanyaan
                  </router-link>
              </li>

            

              <li class="nav-item">
                  <router-link to="/options" class="nav-link">
                      <i class="ni ni-bullet-list-67 text-red"></i> Opsi Pertanyaan
                  </router-link>
              </li>

              <!-- <li class="nav-item">
                  <router-link to="/icon" class="nav-link">
                      <i class="ni ni-planet text-blue"></i> {{ __('back_end.includes.nav.icons') }}
                  </router-link>
              </li> -->

              <li class="nav-item">
                  <router-link to="/result" class="nav-link">
                      <i class="ni ni-palette text-green"></i> Hasil
                  </router-link>
              </li>
              <!-- <li class="nav-item">
                  <router-link to="/result-map" class="nav-link">
                      <i class="ni ni-spaceship"></i> {{ __('back_end.includes.nav.result_map') }}
                  </router-link>
              </li> -->
              <!-- <li class="nav-item">
                  <router-link to="/event" class="nav-link">
                      <i class="ni ni-ungroup text-yellow"></i> {{ __('back_end.includes.nav.event') }}
                  </router-link>
              </li> -->
              <li class="nav-item">
                  <router-link to="/subscriber" class="nav-link">
                      <i class="ni ni-ui-04 text-warning"></i> Data Responden
                  </router-link>
              </li>
              <li class="nav-item">
                  <router-link to="/settings" class="nav-link">
                      <i class="ni ni-chart-pie-35"></i> {{ __('back_end.includes.nav.system_settings') }}
                  </router-link>
              </li>
          </ul>
      </div>
  </div>
</nav>