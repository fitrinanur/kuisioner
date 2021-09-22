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
        <div class="content-wrap ">
            <!-- <div class="home_title">
                <h2>{{ __(App\Settings::first() ? strip_tags(App\Settings::first()->main_title) : 'front_end.home.poster') }}
                </h2>
                <p>Halaman Poster</p>
            </div> -->
            <!-- <div class="content-icon-slide"> -->
            <div class="owl-carousel">
                <div class="item">
                    <img src="{{ asset('public-assets/images/poster/p1.jpeg') }}" alt="icon">
                </div>
                <div class="item">
                    <img src="{{ asset('public-assets/images/poster/p2.jpeg') }}" alt="icon">
                </div>
                <div class="item">
                    <img src="{{ asset('public-assets/images/poster/p3.jpeg') }}" alt="icon">
                </div>
                <div class="item">
                    <img src="{{ asset('public-assets/images/poster/p4.jpg') }}" alt="icon">
                </div>
                <div class="item">
                    <img src="{{ asset('public-assets/images/poster/p5.jpg') }}" alt="icon">
                </div>
            </div>
            @if($type == 'pre')
                <a href="{{ route('quiz', ['id' => $id , 'type' => 'post' ] ) }}" class="btn-lrg">POST QUISIONER<i
                    class="fas fa-arrow-right"></i></a>
            @endif
        </div>
    </div>
    </div>
</section>
<!-- Main Area End
        ============================================ -->
@endsection
