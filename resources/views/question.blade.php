@extends('layouts.public-app')

@section('content')

    <!-- Header Area
        ============================================ -->
    @include('includes.top-bar')
    <!-- End Header Area
        ============================================ -->



    <!-- Main Area Start
        ============================================ -->
    <section class="main-content d-flex flex-column justify-content-center">
        <div class="container-fluid text-center">

            <form method="POST" action="{{ route('get-result') }}">
            @csrf
                <div class="content-wrap text-center d-flex align-items-center justify-content-center">

                @php $i = 0; @endphp
                    @foreach($questions as $question)
                        @php $i++; @endphp
                        <div class="content-wrap-single @if($i != 1) hideMe @endif">
                            <div class="questions-wrap">
                                <div class="searh-icon">
                                    @if($question->photo)
                                        <img src="public-assets/images/question/{{ $question->photo }}">
                                    @endif
                                </div><!-- search-icon start -->
                                <div class="qustion-single">
                                    <h4>Pertanyaan {{ $i }} dari {{ count($questions) }}</h4>
                                    <p style="color: #3A3D47;"> Indikator :<i> {{$question->questionIndicator->indicator}} </i></p>
                                    <h2>{{ $question->question }}</h2>
                                </div>
                            </div><!-- question wrap end-->


                            <ul class="que-ans ans-text">
                                @foreach($question->option as $option)

                                    <li id="ck-button" class="@if($option->isRadius) isRadius @elseif($option->isCircle) isCircle @endif" >
                                        <label>
                                            <input type="checkbox" name="allOption[]" value='{{ $option->id }}'>
                                            
                                            @if($option->optionImg)
                                                <img src="public-assets/images/option/{{ $option->optionImg }}" alt="{{ __('front_end.question.search') }}">
                                            @else 
                                                <span> {{ $option->optionName }}</span>
                                            @endif
                                            
                                        </label>
                                    </li>

                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                    <div class="content-wrap-single user-data hideMe ">
                        <div class="segment">
                            <h2>Apakah anda yakin menyimpan jawaban?</h2>
                        </div>
                        <input type="hidden" name="id" value="{{$id}}" />
                        <input type="hidden" name="type" value="{{$type}}" />
                        <button class="red" type="submit"><i class="icon ion-md-lock"></i> Kirim</button>
                    </div>
            </form>
        </div>
    </section>
    <!-- Main Area End
        ============================================ -->


@endsection
