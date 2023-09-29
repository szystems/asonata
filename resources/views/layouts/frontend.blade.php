<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<!-- molla/index-2.html') }}  22 Nov 2019 09:55:32 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Asonata Xela</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Asonata">
    <meta name="author" content="Szystems">
    <!-- Favicon -->
    {{-- <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('fronttemplate/assets/images/icons/apple-touch-icon.png') }}"> --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('fronttemplate/assets/images/logos/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('fronttemplate/assets/images/logos/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('fronttemplate/assets/images/icons/site.html') }}">
    <link rel="mask-icon" href="{{ asset('fronttemplate/assets/images/icons/safari-pinned-tab.svg') }}" color="#666666">
    <link rel="shortcut icon" href="{{ asset('fronttemplate/assets/images/logos/favicon.ico') }}">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{ asset('fronttemplate/assets/images/icons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('fronttemplate/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fronttemplate/assets/css/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('fronttemplate/assets/css/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('fronttemplate/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fronttemplate/assets/css/plugins/nouislider/nouislider.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

     {{-- Datepicker --}}
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
     <script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>
     {{-- Datepicker end --}}

    <style>
        .whatsapp-chat{
            bottom: 8px;
            right: 30px;
            position: fixed;
        }
    </style>

    {{-- <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet"> --}}

</head>

<body>
    <div class="page-wrapper">
        <header class="header">


            <div class="header-middle sticky-header">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>

                        <a href="{{ url('/') }}" class="logo">
                            <img src="{{ asset('fronttemplate/assets/images/logos/logo.jpg') }}" alt="Asonata Logo" width="105" height="25">
                        </a>

                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class="">
                                    <a href="{{ url('/') }}">{{ __('Home') }}</a>
                                </li>
                                <li class="">
                                    <a href="{{ url('about-us') }}">{{ __('About') }}</a>
                                </li>
                                <li class="">
                                    <a href="{{ url('inscriptions-cycles') }}">{{ __('Inscriptions') }}</a>
                                </li>
                                <li class="">
                                    <a href="{{ url('queries') }}">{{ __('Queries') }}</a>
                                </li>
                                <li class="">
                                    <a href="{{ url('contact') }}">{{ __('Contact') }}</a>
                                </li>
                            </ul><!-- End .menu -->
                        </nav><!-- End .main-nav -->
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <div class="header-search">
                            {{-- <form action="{{ url('buscarproducto') }}" method="POST">
                                {{ csrf_field() }}
                                <a  class="search-toggle active" role="button" title="Search"><i class="icon-search"></i></a>
                                <div class="header-search-wrapper show">
                                    <label class="sr-only">Search</label>
                                    <input type="search" class="form-control" name="product_name" id="search_product" placeholder="Search Products..." required>
                                </div><!-- End .header-search-wrapper -->
                            </form> --}}

                        </div><!-- End .header-search -->


                        <div class="dropdown cart-dropdown">

                            <a href="" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                @if (Auth::guest())

                                <div class="icon">
                                    <i class="icon-user"></i>
                                </div>
                                <p><u>Entrar</u></p>
                                @else
                                    @php
                                        $usuario = Auth::user()->name; $nombre = explode(' ',trim($usuario));
                                    @endphp
                                    <div class="icon">
                                        <i class="icon-user"></i>
                                    </div>
                                    <p><u>{{ ucwords($nombre[0]) }}</u></p>
                                @endif
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                @if (Auth::guest())
                                    <div class="dropdown-cart-action">
                                        <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesion <span class="material-symbols-outlined">login</span></a>
                                        {{-- <a href="{{ route('register') }}" class="btn btn-outline-primary-2"><span>Register</span><span class="material-symbols-outlined">app_registration</span></a> --}}
                                    </div><!-- End .dropdown-cart-total -->
                                @else
                                    <div class="dropdown">
                                        <ul>
                                            <li>
                                                {{-- <a href="{{ url('show-user/'.Auth::id()) }}">
                                                    <div class="icon">
                                                        <i class="icon-user"></i>
                                                    </div>
                                                </a>
                                                <p><u>Mi Perfil</u></p> --}}
                                                <h5>
                                                    @if (Auth::user()->role_as != "3")
                                                        <a href="{{ url('show-user/'.Auth::id()) }}"><i class="icon-user"></i><font color="black"> Mi Perfil</font></a>
                                                    @endif
                                                    @if (Auth::user()->role_as == "3")
                                                        <a href="{{ url('show-instructor/'.Auth::id()) }}"><i class="icon-user"></i><font color="black"> Mi Perfil</font></a>
                                                    @endif
                                                </h5>
                                            </li>
                                            @if (Auth::user()->role_as == "1" or Auth::user()->role_as == "0" or Auth::user()->role_as == "3")
                                                <li>
                                                    <h5><a href="{{ url('dashboard') }}"><i class="icon-laptop"></i><font color="black"> Panel de Control </font></a></h5>
                                                </li>
                                            @endif

                                        </ul>
                                    </div><!-- End .dropdown-cart-total -->
                                    <div class="dropdown-cart-action">
                                        <a href="javascript:; {{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-primary">Cerrar Sesion <span class="material-symbols-outlined">logout</span></a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div><!-- End .dropdown-cart-total -->
                                @endif
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .user-dropdown -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->
        </header><!-- End .header -->

        <main class="main">
            @yield('content')
        </main><!-- End .main -->

        @include('layouts.incfront.frontfooter')

    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    @include('layouts.incfront.mobilmenu')

    @include('layouts.incfront.loginmodal')

    {{-- <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <img src="{{ asset('fronttemplate/assets/images/popup/newsletter/logo.png') }}" class="logo" alt="logo" width="60" height="15">
                            <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                            <p>Subscribe to the Molla eCommerce newsletter to receive timely updates from your favorite products.</p>
                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span></button>
                                    </div><!-- .End .input-group-append -->
                                </div><!-- .End .input-group -->
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                            </div><!-- End .custom-checkbox -->
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="{{ asset('fronttemplate/assets/images/popup/newsletter/img-1.jpg') }}" class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Plugins JS File -->
    <div class="whatsapp-chat">
        <a href="https://wa.me/50238711264" target="_blank">
            <img src="{{ asset('assets/imgs/logow.png') }}" alt="whatsapp-chat" height="100px" width="100px">
        </a>
    </div>
    <script src="{{ asset('fronttemplate/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('fronttemplate/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('fronttemplate/assets/js/jquery.hoverIntent.min.js') }}"></script>
    <script src="{{ asset('fronttemplate/assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('fronttemplate/assets/js/superfish.min.js') }}"></script>
    <script src="{{ asset('fronttemplate/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('fronttemplate/assets/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ asset('fronttemplate/assets/js/jquery.elevateZoom.min.js') }}"></script>
    <script src="{{ asset('fronttemplate/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    {{-- <script src="{{ asset('frontend/css/custom.css') }}"></script> --}}
    <script src="{{ asset('frontend/js/checkout.js') }}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('fronttemplate/assets/js/main.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!--Start of Tawk.to Script-->
    {{-- <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/63dae358474251287910fb32/1go7gg4im';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
    </script> --}}
    <!--End of Tawk.to Script-->
    {{-- <script>

        var availableTags = [];
        $.ajax({
            method: "GET",
            url: "/product-list",
            success: function (response) {
                //console.log(response);
                startAutoComplete(response);
            }
        });

        function startAutoComplete(availableTags)
        {
            $( "#search_product" ).autocomplete({
                source: availableTags
            });
        }


    </script> --}}

    @if (session('status'))
    <script>
        swal("{{ session('status') }}");
    </script>
    @endif
    @stack('scripts')
    @yield('scripts')
</body>


<!-- molla/index-2.html') }}  22 Nov 2019 09:55:42 GMT -->
</html>
