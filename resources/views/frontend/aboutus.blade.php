@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url('{{ asset('fronttemplate/assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">{{ __('About') }}<span>¿Quiénes somos?</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('About') }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    @if (optional($sections)->nosotros_imagen != null)
        <div class="container">
            <div class="page-header page-header-big text-center" style="background-image: url('{{ asset('assets/uploads/nosotros/'.$sections->nosotros_imagen) }}')">
            </div><!-- End .page-header -->
        </div><!-- End .container -->
    @endif


    <div class="page-content pb-0">
        <div class="container">
            <div class="mb-5"></div><!-- End .mb-4 -->
        </div><!-- End .container -->

        <div class="bg-light-2 pt-6 pb-5 mb-6 mb-lg-8">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mb-3 mb-lg-0">
                        @if (optional($sections)->nosotros_titulo != null) <h2 class="title">{{ $sections->nosotros_titulo }}</h2> @endif
                        @if (optional($sections)->nosotros_descripcion != null)  <p class="lead text-primary mb-3">{{ $sections->nosotros_descripcion }}</p> @endif
                        @if (optional($sections)->nosotros_descripcion2 != null)  <p class="mb-2">{{ $sections->nosotros_descripcion2 }}</p> @endif
                        <br>
                        @foreach ($teams as $team)
                            <h2 class="title">{{ $team->nombre }}</h2>
                            <p>{{ $team->descripcion }}</p>
                            @php
                                $members = \App\Models\TeamMember::where('team_id',$team->id)->get();
                            @endphp
                            @if ($members->count() > 0)
                                <ul>
                                    @foreach ($members as $member)
                                        <li>-@if($member->cargo != null)<strong>{{ $member->cargo }}:</strong>@endif  {{ $member->nombre }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <br>
                        @endforeach


                        {{-- <a href="blog.html" class="btn btn-sm btn-minwidth btn-outline-primary-2">
                            <span>VIEW OUR NEWS</span>
                            <i class="icon-long-arrow-right"></i>
                        </a> --}}
                    </div><!-- End .col-lg-5 -->

                    {{-- <div class="col-lg-6 offset-lg-1">
                        <div class="about-images">
                            <img src="{{ asset('fronttemplate/assets/images/backgrounds/login-bg.jpg') }}" alt="" class="about-img-front">
                            <img src="{{ asset('fronttemplate/assets/images/backgrounds/cta/bg-8.jpg') }}" alt="" class="about-img-back">
                        </div><!-- End .about-images -->
                    </div><!-- End .col-lg-6 --> --}}
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .bg-light-2 pt-6 pb-6 -->

        {{-- <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="brands-text">
                        <h2 class="title">The world's premium design brands in one destination.</h2><!-- End .title -->
                        <p>Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nis</p>
                    </div><!-- End .brands-text -->
                </div><!-- End .col-lg-5 -->
                <div class="col-lg-7">
                    <div class="brands-display">
                        <div class="row justify-content-center">
                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="assets/images/brands/1.png" alt="Brand Name">
                                </a>
                            </div><!-- End .col-sm-4 -->

                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="assets/images/brands/2.png" alt="Brand Name">
                                </a>
                            </div><!-- End .col-sm-4 -->

                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="assets/images/brands/3.png" alt="Brand Name">
                                </a>
                            </div><!-- End .col-sm-4 -->

                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="assets/images/brands/4.png" alt="Brand Name">
                                </a>
                            </div><!-- End .col-sm-4 -->

                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="assets/images/brands/5.png" alt="Brand Name">
                                </a>
                            </div><!-- End .col-sm-4 -->

                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="assets/images/brands/6.png" alt="Brand Name">
                                </a>
                            </div><!-- End .col-sm-4 -->

                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="assets/images/brands/7.png" alt="Brand Name">
                                </a>
                            </div><!-- End .col-sm-4 -->

                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="assets/images/brands/8.png" alt="Brand Name">
                                </a>
                            </div><!-- End .col-sm-4 -->

                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="assets/images/brands/9.png" alt="Brand Name">
                                </a>
                            </div><!-- End .col-sm-4 -->
                        </div><!-- End .row -->
                    </div><!-- End .brands-display -->
                </div><!-- End .col-lg-7 -->
            </div><!-- End .row -->

            <hr class="mt-4 mb-6">

            <h2 class="title text-center mb-4">Meet Our Team</h2><!-- End .title text-center mb-2 -->

            <div class="row">
                <div class="col-md-4">
                    <div class="member member-anim text-center">
                        <figure class="member-media">
                            <img src="assets/images/team/member-1.jpg" alt="member photo">

                            <figcaption class="member-overlay">
                                <div class="member-overlay-content">
                                    <h3 class="member-title">Samanta Grey<span>Founder & CEO</span></h3><!-- End .member-title -->
                                    <p>Sed pretium, ligula sollicitudin viverra, tortor libero sodales leo, eget blandit nunc.</p>
                                    <div class="social-icons social-icons-simple">
                                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                    </div><!-- End .soial-icons -->
                                </div><!-- End .member-overlay-content -->
                            </figcaption><!-- End .member-overlay -->
                        </figure><!-- End .member-media -->
                        <div class="member-content">
                            <h3 class="member-title">Samanta Grey<span>Founder & CEO</span></h3><!-- End .member-title -->
                        </div><!-- End .member-content -->
                    </div><!-- End .member -->
                </div><!-- End .col-md-4 -->

                <div class="col-md-4">
                    <div class="member member-anim text-center">
                        <figure class="member-media">
                            <img src="assets/images/team/member-2.jpg" alt="member photo">

                            <figcaption class="member-overlay">
                                <div class="member-overlay-content">
                                    <h3 class="member-title">Bruce Sutton<span>Sales & Marketing Manager</span></h3><!-- End .member-title -->
                                    <p>Sed pretium, ligula sollicitudin viverra, tortor libero sodales leo, eget blandit nunc.</p>
                                    <div class="social-icons social-icons-simple">
                                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                    </div><!-- End .soial-icons -->
                                </div><!-- End .member-overlay-content -->
                            </figcaption><!-- End .member-overlay -->
                        </figure><!-- End .member-media -->
                        <div class="member-content">
                            <h3 class="member-title">Bruce Sutton<span>Sales & Marketing Manager</span></h3><!-- End .member-title -->
                        </div><!-- End .member-content -->
                    </div><!-- End .member -->
                </div><!-- End .col-md-4 -->

                <div class="col-md-4">
                    <div class="member member-anim text-center">
                        <figure class="member-media">
                            <img src="assets/images/team/member-3.jpg" alt="member photo">

                            <figcaption class="member-overlay">
                                <div class="member-overlay-content">
                                    <h3 class="member-title">Janet Joy<span>Product Manager</span></h3><!-- End .member-title -->
                                    <p>Sed pretium, ligula sollicitudin viverra, tortor libero sodales leo, eget blandit nunc.</p>
                                    <div class="social-icons social-icons-simple">
                                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                    </div><!-- End .soial-icons -->
                                </div><!-- End .member-overlay-content -->
                            </figcaption><!-- End .member-overlay -->
                        </figure><!-- End .member-media -->
                        <div class="member-content">
                            <h3 class="member-title">Janet Joy<span>Product Manager</span></h3><!-- End .member-title -->
                        </div><!-- End .member-content -->
                    </div><!-- End .member -->
                </div><!-- End .col-md-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-2"></div><!-- End .mb-2 -->

        <div class="about-testimonials bg-light-2 pt-6 pb-6">
            <div class="container">
                <h2 class="title text-center mb-3">What Customer Say About Us</h2><!-- End .title text-center -->

                <div class="owl-carousel owl-simple owl-testimonials-photo" data-toggle="owl"
                    data-owl-options='{
                        "nav": false,
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "1200": {
                                "nav": true
                            }
                        }
                    }'>
                    <blockquote class="testimonial text-center">
                        <img src="assets/images/testimonials/user-1.jpg" alt="user">
                        <p>“ Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque aliquet nibh nec urna. <br>In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti. ”</p>
                        <cite>
                            Jenson Gregory
                            <span>Customer</span>
                        </cite>
                    </blockquote><!-- End .testimonial -->

                    <blockquote class="testimonial text-center">
                        <img src="assets/images/testimonials/user-2.jpg" alt="user">
                        <p>“ Impedit, ratione sequi, sunt incidunt magnam et. Delectus obcaecati optio eius error libero perferendis nesciunt atque dolores magni recusandae! Doloremque quidem error eum quis similique doloribus natus qui ut ipsum.Velit quos ipsa exercitationem, vel unde obcaecati impedit eveniet non. ”</p>

                        <cite>
                            Victoria Ventura
                            <span>Customer</span>
                        </cite>
                    </blockquote><!-- End .testimonial -->
                </div><!-- End .testimonials-slider owl-carousel -->
            </div><!-- End .container -->
        </div><!-- End .bg-light-2 pt-5 pb-6 --> --}}
    </div><!-- End .page-content -->
@endsection
