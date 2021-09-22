@extends('layouts.public-app')

@section('content')


<!-- Header Area
        ============================================ -->
<!-- @include('includes.top-bar') -->
<!-- End Header Area
        ============================================ -->


<!-- Main Area Start
        ============================================ -->
<section class="main-content d-flex flex-column justify-content-center">
    <div class="container-fluid">
        <div class="content-wrap content-wrap-home text-center">
            <div class="home_title">
                <h2>Terima Kasih!</h2>
                <p>Terima Kasih Sudah Bersedia Menjadi Responden Kuisioner Ini</p>

                <!-- <h2>{{ __(App\Settings::first() ? strip_tags(App\Settings::first()->main_title) : 'front_end.home.title') }}
                </h2>
                <p>{{ __(App\Settings::first() ? strip_tags(App\Settings::first()->sort_desc) : 'front_end.home.title') }}
                </p> -->
            </div>
           
        </div>
    </div>
</section>
<!-- Main Area End
        ============================================ -->


@endsection
