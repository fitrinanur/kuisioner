@extends('layouts.public-app') 
@section('styles')
    <!-- slick.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public-assets/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public-assets/css/slick-theme.css') }}">
@endsection 



@section('content')

    <!-- Header Area
            ============================================ -->
    @include('includes.top-bar')
    <!-- End Header Area
            ============================================ -->

    <!-- Main Area Start
            ============================================ -->
    @if($result)
        <section class="main-content d-flex flex-column justify-content-center">
            <div class="container-fluid">
                <div class="content-wrap result-area text-center">

                    <div class="content-wrap-top">
                        <div class="content-wrap-top-img">
                            <img src="{{ url('public-assets/images/icon/'.$result->icon->photo) }}" alt="image" />
                        </div>
                        <h2>{{ __('front_end.result.title1') }} <br>{{ __('front_end.result.title2') }}</h2>
                        <h1>{{ $result->icon->title }}</h1>
                    </div>
                    <!-- content-wrap-top end -->

                    <div class="content-suggestion-box">
                        @php $i=0; @endphp @foreach($result->icon->suggestion as $suggestion) @php $i++; @endphp
                        <div class="single-suggestion-box rectangle">
                            <div class="single-suggestion-content text-left">
                                <h2>{{ $suggestion->title }}</h2>
                                <p>{{ $suggestion->sug_desc }}</p>
                            </div>
                            <a href="{{ $suggestion->external_url }}" target="__blank">{{ __('front_end.result.details_btn') }}</a>
                        </div>
                        @endforeach
                    </div>
                    <!-- content-suggestion end -->

                    <div class="suggestion-link pb-2">
                        <h2>{{ __('front_end.result.share_title') }}</h2>

                        <input type="hidden" value="{{route('suggestion', $result->icon->slug)}}" name="input" id="myInput">
                        <button type="button" class="btn btn-default btn-copy js-tooltip js-copy" data-toggle="tooltip" data-placement="bottom" data-copy="{{ route('suggestion', $result->icon->slug) }}" title="{{ __('front_end.result.cpy_link_title') }}">
                            {{ __('front_end.result.cpy_link') }}</button>
                    </div>
                    <!-- suggestion-link end -->

                    <div class="suggestion-slide">
                        <h2>{{ __('front_end.result.more_suggestion.get') }} {{ count($allIcon) }} {{ __('front_end.result.more_suggestion.other_sugg') }}:</h2>
                        <div class="slide-wrap">
                            <section class="slider">
                                @foreach($allIcon as $icon)
                                <div data-title="{{ $icon->title }}" data-number="{{ $icon->id }}" class="data-single">
                                    <img src="{{ url('public-assets/images/icon/'.$icon->photo) }}" alt="icon">
                                </div>
                                @endforeach
                            </section>
                        </div>
                        <a class="mt-3" href="{{ route('get-result') }}" onclick="event.preventDefault(); document.getElementById('viewmessage').submit();">
                            <span>{{ __('front_end.result.more_suggestion.show') }}</span>
                        </a>
                        <form id="viewmessage" action="{{ route('get-result') }}" method="POST">
                            @csrf
                            <input type="hidden" id="data-number" name="icon_id" value="{{ $result['id'] }}">
                        </form>
                    </div>
                    <!-- suggestion-slide end -->

                </div>
            </div>
        </section>
    @else
        <div class="main-content-error">
            <div class="error">
                <h2>{{ __('front_end.result.no_result.empty') }}</h2>
                <a href="{{ url('/') }}" class="btn-lrg">{{ __('front_end.result.no_result.try_again') }} <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    @endif
    <!-- Main Area End
            ============================================ -->

    <!-- Feature Start
            ============================================ -->
    <section class="feature-area">
        <div class="container-fluid">
            <div class="feature-post text-center">
                @if($post)
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->description }}</p>
                    <a href="{{ $post->link }}" target="__blank">{{ __('front_end.result.event_btn') }} <i class="fas fa-eye"></i></a> 
                @endif
            </div>
        </div>
    </section>
    <!-- Feature End
            ============================================ -->

    <!-- footer Start
            ============================================ -->
    <footer class="footer text-center">
        <p>{{ App\Settings::first() ? App\Settings::first()->footer_text : 'Codeshaper' }} <span></span></p>
    </footer>
    <!-- footer end
            ============================================ -->

@endsection 