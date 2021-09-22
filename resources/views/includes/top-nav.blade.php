
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
      <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('home') }}">{{ __('back_end.includes.control_panel') }}</a>
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  @if(Auth::user()->photo)
                    <img src="{{ asset('admin-assets/img/profile') }}/{{ Auth::user()->photo }}" alt="{{ Auth::user()->photo }}" />
                  @else 
                    <img src="{{ asset('admin-assets/img/profile') }}/profile.png">
                  @endif
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
                </div>
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

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            </div>
          </li>
        </ul>
      </div>
    </nav>