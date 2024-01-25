@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url('{{ asset('fronttemplate/assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">{{ __('Ultimas Noticias') }}</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Noticias') }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->


    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @foreach ($noticias as $noticia)
                        <article class="entry entry-list">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <figure class="entry-media">
                                        <a href="{{ url('noticias/' . $noticia->id) }}">
                                            <img src="{{ asset('assets/uploads/noticias/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }}">
                                        </a>
                                    </figure><!-- End .entry-media -->
                                </div><!-- End .col-md-5 -->

                                <div class="col-md-7">
                                    <div class="entry-body">
                                        <div class="entry-meta">
                                            {{-- <span class="entry-author">
                                                by <a href="#">John Doe</a>
                                            </span> --}}
                                            {{-- <span class="meta-separator">|</span> --}}
                                            <a href="{{ url('noticias/' . $noticia->id) }}">{{ \Carbon\Carbon::parse($noticia->updated_at)->format('d-m-Y') }}</a>
                                            {{-- <span class="meta-separator">|</span> --}}
                                            {{-- <a href="#">2 Comments</a> --}}
                                        </div><!-- End .entry-meta -->

                                        <h2 class="entry-title">
                                            <a href="{{ url('noticias/' . $noticia->id) }}">{{ $noticia->titulo }}</a>
                                        </h2><!-- End .entry-title -->

                                        {{-- <div class="entry-cats">
                                            in <a href="#">Lifestyle</a>,
                                            <a href="#">Shopping</a>
                                        </div><!-- End .entry-cats --> --}}

                                        <div class="entry-content">
                                            @php
                                                $contenido = strip_tags($noticia->contenido);
                                                $contenido_corto = substr($contenido, 0, 200);
                                            @endphp
                                            <p>{{ strip_tags($contenido_corto) }}...</p>
                                            <a href="{{ url('noticias/' . $noticia->id) }}" class="read-more">Continuar leyendo</a>
                                        </div><!-- End .entry-content -->
                                    </div><!-- End .entry-body -->
                                </div><!-- End .col-md-7 -->
                            </div><!-- End .row -->
                        </article><!-- End .entry -->
                    @endforeach

                    {{ $noticias->links() }}
                </div><!-- End .col-lg-9 -->

            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
@endsection
