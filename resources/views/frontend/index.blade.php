@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="intro-section bg-lighter pt-5 pb-6">
        <div class="container">
            <div class="row">
                <div class="container">
            		<h2 class="title mb-3 text-center text-danger">Asonata Xela</h2><!-- End .text-center -->
                    <p class="title mb-3 text-center">Asociación Deportiva Departamental de Quetzaltenango de Natación, Clavados, Polo Acuático, Nado Sincronizado y Aguas Abiertas.</p>
                    <p class="text-center"><b>Afiliada A: Federación Nacional De Natación Y Confederación Deportiva Autónoma De Guatemala  </b></p>
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


                            <div class="intro-slide">
                                <figure class="slide-image">
                                    <picture>
                                        <source media="(max-width: 480px)" srcset="{{ asset('fronttemplate/assets/images/slider/slide-5.jpg') }}">
                                        <img src="{{ asset('fronttemplate/assets/images/slider/slide-5.jpg') }}" alt="Image Desc">
                                    </picture>
                                </figure><!-- End .slide-image -->

                                {{-- <div class="intro-content">
                                    <h3 class="intro-subtitle">News and Inspiration</h3><!-- End .h3 intro-subtitle -->
                                    <h1 class="intro-title">New Arrivals</h1><!-- End .intro-title -->

                                    <a href="category.html" class="btn btn-outline-white">
                                        <span>SHOP NOW</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div><!-- End .intro-content --> --}}
                            </div><!-- End .intro-slide -->

                            <div class="intro-slide">
                                <figure class="slide-image">
                                    <picture>
                                        <source media="(max-width: 480px)" srcset="{{ asset('fronttemplate/assets/images/slider/slide-3.jpg') }}">
                                        <img src="{{ asset('fronttemplate/assets/images/slider/slide-3.jpg') }}" alt="Image Desc">
                                    </picture>
                                </figure><!-- End .slide-image -->

                                {{-- <div class="intro-content">
                                    <h3 class="intro-subtitle">Outdoor Furniture</h3><!-- End .h3 intro-subtitle -->
                                    <h1 class="intro-title">Outdoor Dining <br>Furniture</h1><!-- End .intro-title -->

                                    <a href="category.html" class="btn btn-outline-white">
                                        <span>SHOP NOW</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div><!-- End .intro-content --> --}}
                            </div><!-- End .intro-slide -->

                            <div class="intro-slide">
                                <figure class="slide-image">
                                    <picture>
                                        <source media="(max-width: 480px)" srcset="{{ asset('fronttemplate/assets/images/slider/slide-2.jpg') }}">
                                        <img src="{{ asset('fronttemplate/assets/images/slider/slide-2.jpg') }}" alt="Image Desc">
                                    </picture>
                                </figure><!-- End .slide-image -->

                                {{-- <div class="intro-content">
                                    <h3 class="intro-subtitle">Outdoor Furniture</h3><!-- End .h3 intro-subtitle -->
                                    <h1 class="intro-title">Outdoor Dining <br>Furniture</h1><!-- End .intro-title -->

                                    <a href="category.html" class="btn btn-outline-white">
                                        <span>SHOP NOW</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div><!-- End .intro-content --> --}}
                            </div><!-- End .intro-slide -->

                            <div class="intro-slide">
                                <figure class="slide-image">
                                    <picture>
                                        <source media="(max-width: 480px)" srcset="{{ asset('fronttemplate/assets/images/slider/slide-1.jpg') }}">
                                        <img src="{{ asset('fronttemplate/assets/images/slider/slide-1.jpg') }}" alt="Image Desc">
                                    </picture>
                                </figure><!-- End .slide-image -->

                                {{-- <div class="intro-content">
                                    <h3 class="intro-subtitle">Outdoor Furniture</h3><!-- End .h3 intro-subtitle -->
                                    <h1 class="intro-title">Outdoor Dining <br>Furniture</h1><!-- End .intro-title -->

                                    <a href="category.html" class="btn btn-outline-white">
                                        <span>SHOP NOW</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div><!-- End .intro-content --> --}}
                            </div><!-- End .intro-slide -->
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
                                        <h4 class="banner-subtitle text-darkwhite"><a href="{{ url('inscriptions-cycles') }}">Inscripciones</a></h4><!-- End .banner-subtitle -->
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
                                        <h4 class="banner-subtitle text-darkwhite"><a href="#">Consultas</a></h4><!-- End .banner-subtitle -->
                                        <h3 class="banner-title text-white"><a href="#">Consulta el estado de tu inscripción, pagos y asistencias</a></h3><!-- End .banner-title -->
                                        <a href="#" class="btn btn-outline-white banner-link">Consultar<i class="icon-long-arrow-right"></i></a>
                                    </div><!-- End .banner-content -->
                                </div><!-- End .banner -->
                            </div><!-- End .col-md-6 col-lg-12 -->
                        </div><!-- End .row row-sm -->
                    </div><!-- End .intro-banners -->
                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->

            <div class="mb-6"></div><!-- End .mb-6 -->

            <div class="page-content">
            	{{-- <div class="container">
            		<h2 class="title mb-3 text-center">Fullwidth Banner</h2><!-- End .text-center -->
            	</div><!-- End .container --> --}}
            	<div class="video-banner video-banner-bg bg-image text-center" style="background-image: url({{ asset('fronttemplate/assets/images/video/bg-4.jpg') }})">
	                <div class="container">
	                	<h3 class="video-banner-title h1 text-white"><span>Asonata Xela</span><strong>Curso de Matronatación</strong></h3><!-- End .video-banner-title -->
	                	<a href="https://www.facebook.com/plugins/video.php?height=316&href=https%3A%2F%2Fwww.facebook.com%2FAsonataXela%2Fvideos%2F1469882233865107%2F&show_text=false&width=560&t=0" class="btn-video btn-iframe"><i class="icon-play"></i></a>
	                </div><!-- End .container -->
            	</div><!-- End .video-banner bg-image -->

            	{{-- <div class="container">
            		<hr class="mt-5 mb-4">
            		<h2 class="title mb-3 text-center">Video Banner with Description</h2><!-- End .text-center -->
            	</div><!-- End .container -->

            	<div class="video-banner video-banner-poster text-center">
	                <div class="container">
	                	<div class="row align-items-center">
	                		<div class="col-md-6 mb-3 mb-md-0">
	                			<h3 class="video-banner-title h3"><span class="text-primary">New Video</span>Womens New Arrivals</h3><!-- End .video-banner-title -->
	                			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper ...</p>
	                		</div><!-- End .col-md-6 -->

	                		<div class="col-md-6">
	                			<div class="video-poster">
	                				<img src="{{ asset('fronttemplate/assets/images/video/poster-1.jpg') }}" alt="poster">

	                				<div class="video-poster-content">
	                					<a href="https://www.youtube.com/watch?v=vBPgmASQ1A0" class="btn-video btn-iframe"><i class="icon-play"></i></a>
	                				</div><!-- End .video-poster-content -->
	                			</div><!-- End .video-poster -->
	                		</div><!-- End .col-md-6 -->
	                	</div><!-- End .row -->
	                </div><!-- End .container -->
            	</div><!-- End .video-banner -->

            	<div class="container">
            		<hr class="mt-5 mb-4">
            		<h2 class="title mb-3 text-center">Video Banner with Background</h2><!-- End .text-center -->
            	</div><!-- End .container -->

            	<div class="video-banner bg-image text-center pt-8 pb-8" style="background-image: url(assets/images/video/bg-2.jpg)">
	                <div class="container">
	                	<div class="row">
	                		<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2">
	                			<div class="video-poster">
	                				<img src="assets/images/video/poster-2.jpg" alt="poster">

	                				<div class="video-poster-content">
	                					<h3 class="h4 video-poster-title text-white">Womens New Arrivals</h3><!-- End .video-poster-title -->
	                					<a href="https://www.facebook.com/plugins/video.php?height=316&href=https%3A%2F%2Fwww.facebook.com%2FAsonataXela%2Fvideos%2F1469882233865107%2F&show_text=false&width=560&t=0" class="btn-video btn-iframe"><i class="icon-play"></i></a>
	                				</div><!-- End .video-poster-content -->
	                			</div><!-- End .video-poster -->
	                		</div><!-- End .col-sm-10 offset-sm-1 col-md-10 offset-md-2 -->
	                	</div><!-- End .row -->
	                </div><!-- End .container -->
            	</div><!-- End .video-banner bg-image -->

            	<div class="container">
            		<hr class="mt-5 mb-4">
            		<h2 class="title mb-3 text-center">Deal Video Banner</h2><!-- End .text-center -->
            	</div><!-- End .container -->

            	<div class="video-banner bg-light pt-5 pb-5">
	                <div class="container align-items-center">
	                	<div class="video-banner-box bg-white">
		                	<div class="row align-items-center">
		                		<div class="col-md-6 mb-3 mb-md-0">
		                			<div class="video-box-content">
		                				<h3 class="video-banner-title h1"><span class="text-primary">New Video</span><strong>Deal Banner</strong></h3><!-- End .video-banner-title -->
	                					<p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.</p>
	                					<a href="#" class="btn btn-outline-primary"><span>Click Here</span><i class="icon-long-arrow-right"></i></a>
		                			</div><!-- End .video-box-content -->
		                		</div><!-- End .col-md-6 -->
		                		<div class="col-md-6">
		                			<div class="video-poster">
		                				<img src="assets/images/video/poster-3.jpg" alt="poster">

		                				<div class="video-poster-content">
		                					<a href="https://www.facebook.com/plugins/video.php?height=316&href=https%3A%2F%2Fwww.facebook.com%2FAsonataXela%2Fvideos%2F1469882233865107%2F&show_text=false&width=560&t=0" class="btn-video btn-iframe"><i class="icon-play"></i></a>
		                				</div><!-- End .video-poster-content -->
		                			</div><!-- End .video-poster -->
		                		</div><!-- End .col-md-6 -->
		                	</div><!-- End .row -->
	                	</div><!-- End .video-banner-box -->
	                </div><!-- End .container -->
            	</div><!-- End .video-banner bg-image --> --}}
            </div><!-- End .page-content -->


        </div><!-- End .container -->
    </div><!-- End .bg-lighter -->

    <div class="mb-6"></div><!-- End .mb-6 -->
    {{-- <iframe src="https://www.facebook.com/plugins/video.php?height=316&href=https%3A%2F%2Fwww.facebook.com%2FAsonataXela%2Fvideos%2F1469882233865107%2F&show_text=false&width=560&t=0" width="560" height="316" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe> --}}

@endsection
