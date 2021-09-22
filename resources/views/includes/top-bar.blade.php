<header class="header-area">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <a href="{{ url('/')}}" class="logo">
            @if(App\Settings::first())
            <img class="light-logo" src="{{ asset('public-assets/images/') }}/{{ App\Settings::first()->dark_logo }}" alt="{{ App\Settings::first()->dark_logo }}" />
            <img class="dark-logo" src="{{ asset('public-assets/images/') }}/{{ App\Settings::first()->light_logo }}" alt="{{ App\Settings::first()->light_logo }}" />
            @else 
            <img src="https://via.placeholder.com/300.png/09f/fff">
            @endif
        </a>

        <div class="themeIcon">
            <button class="dark-btn" value="light"><i class="fas fa-moon"></i></button>
            <button class="light-btn" value="dark"><i class="fas fa-sun"></i></button>
        </div>
    </div>
</header>