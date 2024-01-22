@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url('{{ asset('fronttemplate/assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">{{ __('Contact') }}<span>¿Tienes dudas o preguntas?</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Contact') }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-2 mb-lg-0">
                    @if ($sections->contacto_titulo != null) <h2 class="title mb-1">{{ $sections->contacto_titulo }}</h2> @endif
                    @if ($sections->contacto_descricion != null) <p class="mb-3">{{ $sections->contacto_descricion }}</p> @endif
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="contact-info">
                                <h3>Contácto</h3>

                                <ul class="contact-list">
                                    @if ($sections->contacto_direccion != null)
                                        <li>
                                            <i class="icon-map-marker"></i>
                                            {{ $sections->contacto_direccion }}
                                        </li>
                                    @endif
                                    @if ($sections->contacto_telefono != null)
                                        <li>
                                            <i class="icon-phone"></i>
                                            <a href="{{ $sections->contacto_telefono }}">{{ $sections->contacto_telefono }}</a>
                                        </li>
                                    @endif
                                    @if ($sections->contacto_telefono2 != null)
                                        <li>
                                            <i class="icon-phone"></i>
                                            <a href="{{ $sections->contacto_telefono2 }}">{{ $sections->contacto_telefono2 }}</a>
                                        </li>
                                    @endif
                                    @if ($sections->contacto_email != null)
                                        <li>
                                            <i class="icon-envelope"></i>
                                            <a href="{{ $sections->contacto_email }}">{{ $sections->contacto_email }}</a>
                                        </li>
                                    @endif
                                </ul><!-- End .contact-list -->
                            </div><!-- End .contact-info -->
                        </div><!-- End .col-sm-7 -->

                        <div class="col-sm-5">
                            <div class="contact-info">
                                <h3>Oficínas</h3>

                                <ul class="contact-list">
                                    @if ($sections->contacto_lunes_viernes != null or $sections->contacto_lunes_viernes2 != null)
                                    <li>
                                        <i class="icon-clock-o"></i>
                                        <span class="text-dark">Lunes - Viernes</span> <br>{{ $sections->contacto_lunes_viernes }}<br>{{ $sections->contacto_lunes_viernes2}}
                                    </li>
                                    @endif
                                    @if ($sections->contacto_domingo != null)
                                    <li>
                                        <i class="icon-calendar"></i>
                                        <span class="text-dark">Sabado</span> <br>{{  $sections->contacto_domingo }}
                                    </li>
                                    @endif
                                </ul><!-- End .contact-list -->
                            </div><!-- End .contact-info -->
                        </div><!-- End .col-sm-5 -->
                    </div><!-- End .row -->
                </div><!-- End .col-lg-6 -->
                <div class="col-lg-6">
                    @if ($sections->contacto_titulo2 != null) <h2 class="title mb-1">{{ $sections->contacto_titulo2 }}</h2> @endif<!-- End .title mb-2 -->
                    @if ($sections->contacto_descripcion2 != null) <p class="mb-2">{{ $sections->contacto_descripcion2 }}</p> @endif

                    <!--Mensaje flash-->
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))

                            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                            {{session()->forget('alert-' . $msg)}}
                        @endforeach
                    </div>
                    <!-- fin .flash-message -->

                    <form action="{{ url('send-contact-email') }}" method="GET" class="contact-form mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="name" class="sr-only">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Tu Nombre" required>
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Tu Email" required>
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="phone" class="sr-only">Teléfono</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Tu Teléfono" required>
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label for="subject" class="sr-only">Asunto</label>
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Asunto del mensaje" required>
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <label for="mensaje" class="sr-only">Mensaje</label>
                        <textarea class="form-control" cols="30" rows="4" id="mensaje" name="mensaje" required placeholder="Escribe aqui tu mensaje" required></textarea>

                        <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                            <span>Enviar</span>
                            <i class="icon-long-arrow-right"></i>
                        </button>
                    </form><!-- End .contact-form -->
                </div><!-- End .col-lg-6 -->
            </div><!-- End .row -->

            <hr class="mt-4 mb-5">
        </div><!-- End .container -->
        <div id="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3856.6207439197983!2d-91.53340792365343!3d14.84652848566952!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x858e994722384e65%3A0xf5faa8221a1f6b1!2sAsonata-Xela!5e0!3m2!1ses-419!2sgt!4v1694471032879!5m2!1ses-419!2sgt" width="100%" height="100%" style="border:0;" allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div><!-- End #map -->
    </div><!-- End .page-content -->


@endsection
