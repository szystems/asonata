<footer class="footer footer-dark">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="widget widget-about">
                        <img src="{{ asset('fronttemplate/assets/images/logos/logo.jpg') }}" class="footer-logo" alt="Footer Logo" width="105" height="25">
                        <p>Asociación Deportiva Departamental de Quetzaltenango de Natación, Clavados, Polo Acuático, Nado Sincronizado y Aguas Abiertas. </p>

                        <div class="social-icons">
                            <a href="https://www.facebook.com/AsonataXela" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                            {{-- <a href="" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a> --}}
                            <a href="https://www.instagram.com/asonatacionxela/" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                            <a href="https://www.youtube.com/@AsonataXela1950" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                            {{-- <a href="" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a> --}}
                        </div><!-- End .soial-icons -->
                    </div><!-- End .widget about-widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">Enlaces</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <li><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li><a href="{{ url('about-us') }}">{{ __('About') }}</a></li>
                            <li><a href="{{ url('inscriptions-cycles') }}">{{ __('Inscriptions') }}</a></li>
                            <li><a href="{{ url('queries') }}">{{ __('Queries') }}</a></li>
                            @if (Auth::guest())
                            <li><a href="{{ url('login') }}">{{ __('Login') }}</a></li>
                            <li><a href="{{ url('password/reset') }}">{{ __('Forgot Your Password?') }}</a></li>
                            @else
                            <li><a href="{{ url('show-user/'.Auth::id()) }}">{{ __('My Profile') }}</a></li>
                            <li><a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a></li>
                            @endif
                            <li><a href="{{ url('contact') }}">{{ __('Contact') }}</a></li>

                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        {{-- <h4 class="widget-title">Customer Service</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <li><a href="">Payment Methods</a></li>
                            <li><a href="">Money-back guarantee!</a></li>
                            <li><a href="">Returns</a></li>
                            <li><a href="">Shipping</a></li>
                            <li><a href="">Terms and conditions</a></li>
                            <li><a href="">Privacy Policy</a></li>
                        </ul><!-- End .widget-list --> --}}
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        {{-- <h4 class="widget-title">My Account</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <li><a href="">Sign In</a></li>
                            <li><a href="cart.html') }}">View Cart</a></li>
                            <li><a href="">My Wishlist</a></li>
                            <li><a href="">Track My Order</a></li>
                            <li><a href="">Help</a></li> --}}
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .footer-middle -->

    <div class="footer-bottom">
        <div class="container">
            <p class="footer-copyright">
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script>,
                {{ __('Designed by') }}
                <a href="https://www.szystems.com" class="font-weight-bold" target="_blank">Szystems</a>
                {{ __('Computer solutions for everyone') }}</p><!-- End .footer-copyright -->
            {{-- <figure class="footer-payments">
                <img src="{{ asset('fronttemplate/assets/images/payments.png') }}" alt="Payment methods" width="272" height="20">
            </figure><!-- End .footer-payments --> --}}
        </div><!-- End .container -->
    </div><!-- End .footer-bottom -->
</footer><!-- End .footer -->
