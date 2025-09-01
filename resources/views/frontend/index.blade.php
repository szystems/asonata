@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="intro-section bg-lighter pt-5 pb-6">
        <div class="container">
            <div class="row">
                <div class="container">
            		@if (optional($sections)->inicio_titulo) <h2 class="title mb-3 text-center text-danger">{{ optional($sections)->inicio_titulo }}</h2> @endif
                    @if (optional($sections)->inicio_descripcion) <p class="title mb-3 text-center">{{ optional($sections)->inicio_descripcion }}</p> @endif
                    @if (optional($sections)->inicio_descripcion_2) <p class="text-center"><b>{{ optional($sections)->inicio_descripcion_2 }}</b></p> @endif
            	</div><!-- End .container -->
                <div class="col-lg-8">
                    <div class="intro-slider-container slider-container-ratio slider-container-1 mb-2 mb-lg-0">
                        <div class="intro-slider intro-slider-1 owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl" data-owl-options='{
                                "nav": false,
                                "responsive": {
                                    "768": {
                                        "nav": true,
                                        "autoplay": true,
                                        "loop": true,
                                        "autoplay": true,
                                        "autoplayTimeout": 4000
                                    }
                                }
                            }'>


                            @foreach ($slides as $slide)
                                <div class="intro-slide">
                                    <figure class="slide-image">
                                        <picture>
                                            <source media="(max-width: 480px)" srcset="{{ asset('assets/uploads/slides/' . $slide->imagen) }}">
                                            <img src="{{ asset('assets/uploads/slides/' . $slide->imagen) }}" alt="Image Desc">
                                        </picture>
                                    </figure><!-- End .slide-image -->

                                    <div class="intro-content">
                                        @if ($slide->titulo != null) <h3 class="intro-subtitle">{{ $slide->titulo }}</h3>< @endif
                                        @if ($slide->descripcion != null) <h1 class="intro-title">{{ $slide->descripcion }}</h1> @endif
                                        @if ($slide->boton_link != null)
                                            <a href="{{ $slide->boton_link }}" class="btn btn-outline-white">
                                                <span>{{ $slide->boton_texto }}</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </a>
                                        @endif

                                    </div><!-- End .intro-content -->
                                </div><!-- End .intro-slide -->
                            @endforeach


                        </div><!-- End .intro-slider owl-carousel owl-simple -->

                        <span class="slider-loader"></span><!-- End .slider-loader -->
                    </div><!-- End .intro-slider-container -->
                </div><!-- End .col-lg-8 -->
                <div class="col-lg-4">
                    <div class="intro-banners">
                        <div class="row row-sm">
                            <div class="col-md-6 col-lg-12">
                                <div class="banner banner-display">
                                    <a href="#">
                                        <img src="{{ asset('fronttemplate/assets/images/banners/home/intro/banner-1.jpg') }}" alt="Banner">
                                    </a>

                                    <div class="banner-content">
                                        <h4 class="banner-subtitle text-danger "><a href="{{ url('inscriptions-cycles') }}"><b>Inscripciones</b></a></h4><!-- End .banner-subtitle -->
                                        <h3 class="banner-title text-white"><a href="{{ url('inscriptions-cycles') }}">Inscríbete ahora mismo</a></h3><!-- End .banner-title -->
                                        <a href="{{ url('inscriptions-cycles') }}" class="btn btn-outline-white banner-link">Clases Disponibles<i class="icon-long-arrow-right"></i></a>
                                    </div><!-- End .banner-content -->
                                </div><!-- End .banner -->
                            </div><!-- End .col-md-6 col-lg-12 -->

                            <div class="col-md-6 col-lg-12">
                                <div class="banner banner-display mb-0">
                                    <a href="#">
                                        <img src="{{ asset('fronttemplate/assets/images/banners/home/intro/banner-1.jpg') }}" alt="Banner">
                                    </a>

                                    <div class="banner-content">
                                        <h4 class="banner-subtitle text-danger"><a href="{{ url('queries') }}"><b>Consultas</b></a></h4><!-- End .banner-subtitle -->
                                        <h3 class="banner-title text-white"><a href="{{ url('queries') }}">Consulta el estado de tu inscripción, pagos y asistencias</a></h3><!-- End .banner-title -->
                                        <a href="{{ url('queries') }}" class="btn btn-outline-white banner-link">Consultar<i class="icon-long-arrow-right"></i></a>
                                    </div><!-- End .banner-content -->
                                </div><!-- End .banner -->
                            </div><!-- End .col-md-6 col-lg-12 -->
                        </div><!-- End .row row-sm -->
                    </div><!-- End .intro-banners -->
                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->

            @if (optional($sections)->video_link != null)
                <div class="mb-6"></div><!-- End .mb-6 -->
                <div class="page-content">
                    <div class="video-banner video-banner-bg bg-image text-center" style="background-image: url({{ asset('assets/uploads/video/'.$sections->video_fondo) }})">
                        <div class="container">
                            <h3 class="video-banner-title h1 text-white"><span>{{ $sections->video_titulo }}</span><strong>{{ $sections->video_descripcion }}</strong></h3><!-- End .video-banner-title -->
                            <a href="{{ $sections->video_link }}" class="btn-video btn-iframe"><i class="icon-play"></i></a>
                        </div><!-- End .container -->
                    </div><!-- End .video-banner bg-image -->
                </div><!-- End .page-content -->
            @endif

        </div><!-- End .container -->
    </div><!-- End .bg-lighter -->
    <div class="mb-6"></div><!-- End .mb-6 -->

@endsection
