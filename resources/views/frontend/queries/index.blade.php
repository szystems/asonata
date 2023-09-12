@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url('{{ asset('fronttemplate/assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">{{ __('Queries') }}</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Queries') }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">

            <h2 class="title text-center mb-2">{{ __('Available Queries') }}</h2><!-- End .title text-center -->
            <!--Mensaje de abono correcto-->
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                    {{session()->forget('alert-' . $msg)}}
                @endforeach
            </div>
            <!-- fin .flash-message -->
            <div class="row justify-content-center">

                <div class="col-sm-6 col-md-4">
                    <article class="entry entry-grid">
                        {{-- <figure class="entry-media">
                            <a href="single.html">
                                <img src="assets/images/blog/3cols/post-1.jpg" alt="image desc">
                            </a>
                        </figure><!-- End .entry-media --> --}}

                        <div class="entry-body text-center">
                            {{-- <div class="entry-meta">
                                <a href="#">Nov 22, 2018</a>, 0 Comments
                            </div><!-- End .entry-meta --> --}}

                            <h2 class="entry-title">
                                <u>{{ __('Check inscription') }}</u>
                            </h2><!-- End .entry-title -->



                            <div class="entry-content">
                                <p>{{ __('Enter the registration number you want to consult') }}</p>
                                <form action="query-inscription">
		                    		<div class="input-group">
										<input type="text" class="form-control" placeholder="INSC-XXXXXXXXXXXX" aria-label="Email Adress" name="inscription_number" required>
										<div class="input-group-append">
											<button class="btn btn-primary btn-rounded" type="submit"><span>{{ __('Submit') }}</span><i class="icon-long-arrow-right"></i></button>
										</div><!-- .End .input-group-append -->
									</div><!-- .End .input-group -->
		                    	</form>
                            </div><!-- End .entry-content -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
                </div><!-- End .col-md-4 -->

                <div class="col-sm-6 col-md-4">
                    <article class="entry entry-grid">
                        {{-- <figure class="entry-media">
                            <a href="single.html">
                                <img src="assets/images/blog/3cols/post-1.jpg" alt="image desc">
                            </a>
                        </figure><!-- End .entry-media --> --}}

                        <div class="entry-body text-center">
                            {{-- <div class="entry-meta">
                                <a href="#">Nov 22, 2018</a>, 0 Comments
                            </div><!-- End .entry-meta --> --}}

                            <h2 class="entry-title">
                                <u>{{ __('Check Payments and assists') }}</u>
                            </h2><!-- End .entry-title -->

                            <div class="entry-content">
                                <p>{{ __('Enter the registration number you want to consult') }}</p>
                                <form action="query-payments">
		                    		<div class="input-group">
										<input type="text" class="form-control" placeholder="INSC-XXXXXXXXXXXX" aria-label="Email Adress" name="inscription_number" required>
										<div class="input-group-append">
											<button class="btn btn-primary btn-rounded" type="submit"><span>{{ __('Submit') }}</span><i class="icon-long-arrow-right"></i></button>
										</div><!-- .End .input-group-append -->
									</div><!-- .End .input-group -->
		                    	</form>
                            </div><!-- End .entry-content -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
                </div><!-- End .col-md-4 -->

                {{-- <div class="col-sm-6 col-md-4">
                    <article class="entry entry-grid">
                        <figure class="entry-media">
                            <a href="single.html">
                                <img src="assets/images/blog/3cols/post-2.jpg" alt="image desc">
                            </a>
                        </figure><!-- End .entry-media -->

                        <div class="entry-body text-center">
                            <div class="entry-meta">
                                <a href="#">Nov 22, 2018</a>, 0 Comments
                            </div><!-- End .entry-meta -->

                            <h2 class="entry-title">
                                <a href="single.html">Aliquam tincidunt mauris.</a>
                            </h2><!-- End .entry-title -->

                            <div class="entry-content">
                                <p>Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra ... </p>
                                <a href="single.html" class="read-more">Read More</a>
                            </div><!-- End .entry-content -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
                </div><!-- End .col-md-4 -->

                <div class="col-sm-6 col-md-4">
                    <article class="entry entry-grid">
                        <figure class="entry-media">
                            <a href="single.html">
                                <img src="assets/images/blog/3cols/post-3.jpg" alt="image desc">
                            </a>
                        </figure><!-- End .entry-media -->

                        <div class="entry-body text-center">
                            <div class="entry-meta">
                                <a href="#">Nov 22, 2018</a>, 0 Comments
                            </div><!-- End .entry-meta -->

                            <h2 class="entry-title">
                                <a href="single.html">Nunc dignissim risus.</a>
                            </h2><!-- End .entry-title -->

                            <div class="entry-content">
                                <p>Sed pretium, ligula sollicitudin laoreet viverra tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis ... </p>
                                <a href="single.html" class="read-more">Read More</a>
                            </div><!-- End .entry-content -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
                </div><!-- End .col-md-4 --> --}}
            </div><!-- End .row -->

        </div>
    </div>
@endsection
