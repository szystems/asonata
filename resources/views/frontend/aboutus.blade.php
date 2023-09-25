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

    <div class="container">
        <div class="page-header page-header-big text-center" style="background-image: url('{{ asset('fronttemplate/assets/images/slider/slide-5.jpg') }}')">
            {{-- <h1 class="page-title text-white">About us<span class="text-white">Who we are</span></h1> --}}
        </div><!-- End .page-header -->
    </div><!-- End .container -->

    <div class="page-content pb-0">
        <div class="container">
            {{-- <div class="row">
                <div class="col-lg-6 mb-3 mb-lg-0">
                    <h2 class="title">Vision</h2><!-- End .title -->
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. </p>
                </div><!-- End .col-lg-6 -->

                <div class="col-lg-6">
                    <h2 class="title">Mision</h2><!-- End .title -->
                    <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. <br>Praesent elementum hendrerit tortor. Sed semper lorem at felis. </p>
                </div><!-- End .col-lg-6 -->
            </div><!-- End .row --> --}}

            <div class="mb-5"></div><!-- End .mb-4 -->
        </div><!-- End .container -->

        <div class="bg-light-2 pt-6 pb-5 mb-6 mb-lg-8">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mb-3 mb-lg-0">
                        <h2 class="title">¿Quiénes somos?</h2><!-- End .title -->
                        <p class="lead text-primary mb-3">Asociación Deportiva Departamental de Quetzaltenango de Natación, Clavados, Polo Acuático, Nado Sincronizado y Aguas Abiertas.</p><!-- End .lead text-primary -->
                        <p class="mb-2">Afiliada A: Federación Nacional De Natación Y Confederación Deportiva Autónoma De Guatemala</p>
                        <br>
                        <h2 class="title">COMITÉ EJECUTIVO</h2>
                        <ul>
                            <li>-<strong>Presidente:</strong>  Lic. Vinicio Méndez Barrios</li>
                            <li>-<strong>Secretario:</strong>  Sr. Geovani José Sapón Lucas</li>
                            <li>-<strong>Tesorero:</strong>  Dr. Bayron Ines de León de León</li>
                        </ul>
                        <br>
                        <h2 class="title">ÓRGANO DISCIPLINARIO</h2>
                        <ul>
                            <li>-<strong>Presidente:</strong>  Lic Felix Marcotulio Archila Salazar</li>
                            <li>-<strong>Secretaria:</strong>  Profa. Samara Jeannette Elías Ventura</li>
                            <li>-<strong>Vocal I:</strong>  Lic. Marcel Lorena Sac Morales</li>
                        </ul>
                        <br>
                        <h2 class="title">CUERPO TÉCNICO</h2>
                        <ul>
                            <li>-<strong>Coordinador General:</strong>  Msc. Carlos Eduardo Méndez Pérez</li>
                            <li>-<strong>Coordinador de enseñanza y preequipos:</strong>  PPof. Freddy David Gutiérrez Taracena</li>
                            <li>-<strong>Coordinadora de matronatación:</strong>  Profa. Cindy Yoselin Marín Velásquez</li>
                            <li>-<strong>Jefe de entrenadores:</strong>  Prof. Mauricio Colop</li>
                        </ul>
                        <br>
                        <h2 class="title">ENTRENADORES</h2>
                        <ul>
                            <li>-Carlos Méndez</li>
                            <li>-Mauricio Colop</li>
                            <li>-Selvyn Chuc</li>
                            <li>-Freddy Gutierrez</li>
                            <li>-Heidi Perez</li>
                            <li>-Jesus Perez </li>
                        </ul>
                        <br>
                        <h2 class="title">PERSONAL DE MATRONATACIÓN</h2>
                        <ul>
                            <li>-Iris de León</li>
                            <li>-Cristy Pérez</li>
                            <li>-María Joj </li>
                            <li>-Yesica Cop</li>
                            <li>-Yesica Tzum</li>
                            <li>-Galinda Chamorro </li>
                            <li>-Sucely Tzun</li>
                            <li>-Carmen Cotoc </li>
                        </ul>
                        <br>
                        <h2 class="title">ENSEÑANZA</h2>
                        <ul>
                            <li>-Sucely Tzun</li>
                            <li>-Miguel Ángel López</li>
                            <li>-Levi Salanic  </li>
                            <li>-Rebeca Gómez </li>
                            <li>-Carmen Cotoc </li>
                            <li>-Evelyn López  </li>
                            <li>-Birman Martínez</li>
                        </ul>
                        <br>
                        <h2 class="title">MASTER</h2>
                        <ul>
                            <li>-Selvyn Chuc</li>
                            <li>-Jimmy Poz  </li>
                            <li>-Andrea Álvarez Moran  </li>
                            <li>-Jhony Pérez </li>
                            <li>-Jesús Pérez  </li>
                            <li>-Heidi Pérez   </li>
                        </ul>
                        <br>
                        <h2 class="title">PREPARADORES FISICOS</h2>
                        <ul>
                            <li>-Oscar Chuc Pérez</li>
                            <li>-Selvyn Chuc   </li>
                        </ul>
                        <br>
                        <h2 class="title">EQUIPO MULTIDISCIPLINARIO</h2>
                        <ul>
                            <li>-Andrea de León</li>
                            <li>-Alicia Arroyave   </li>
                            <li>-Wendy Villagran   </li>
                            <li>-Alejandro De León  </li>
                        </ul>
                        <br>
                        <h2 class="title">PERSONAL ADMINISTRATIVO </h2>
                        <ul>
                            <li>-Keila Morales </li>
                            <li>-Glenda Tahay   </li>
                            <li>-Paola Baquiax   </li>
                            <li>-Patricia Carranza  </li>
                        </ul>
                        <br>
                        <h2 class="title">PERSONAL OPERATIVO</h2>
                        <ul>
                            <li>-Olga Alejandro Ixcot </li>
                            <li>-Estuardo Machic    </li>
                            <li>-Mario García    </li>
                        </ul>
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
