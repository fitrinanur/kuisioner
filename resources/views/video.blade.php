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
            <div class="video" style="margin: 30px 50px 30px 340px">
            <!-- <video controls>
              <source src="cat-herd.webm" type="video/webm"/>
              <source src="cat-herd.mp4" type="video/mp4"/>
              <track src="cat-herd-id.vtt" kind="subtitles" srclang="id" label="Indonesia"/>
            </video> -->
            <iframe width="740" height="415" src="https://www.youtube.com/embed/N7iY-jNWeFc"></iframe>
            </div>
            @if($type == 'pre')
            <div class="button" style="text-align:center; margin-bottom: 10px;">
              <p>Jika Kamu Sudah Memahami Edukasi Diatas Silahkan Mengisi Kuisioner Dibawah Ini.</p>
           
                <a href="{{ route('quiz', ['id' => $id , 'type' => 'post' ] ) }}" class="btn-lrg">POST QUISIONER<i
                    class="fas fa-arrow-right"></i></a>
            </div>
            @endif
        </div>
    </div>
    </div>
</section>
<!-- Main Area End
        ============================================ -->
@endsection
