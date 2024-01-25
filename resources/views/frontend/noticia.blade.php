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
                <li class="breadcrumb-item"><a href="{{ url('/noticias') }}">{{ __('Noticias') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $noticia->titulo }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <article class="entry single-entry">
                        <figure class="entry-media">
                            <img src="{{ asset('assets/uploads/noticias/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }}">
                        </figure><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-meta">
                                {{-- <span class="entry-author">
                                    by <a href="#">John Doe</a>
                                </span>
                                <span class="meta-separator">|</span> --}}
                                <a href="#">{{ \Carbon\Carbon::parse($noticia->updated_at)->format('d-m-Y') }}</a>
                                {{-- <span class="meta-separator">|</span>
                                <a href="#">2 Comments</a> --}}
                            </div><!-- End .entry-meta -->

                            <h2 class="entry-title">
                                {{ $noticia->titulo }}
                            </h2><!-- End .entry-title -->


                            <div class="entry-content editor-content">
                                <p>{!! html_entity_decode($noticia->contenido) !!}</p>
                            </div><!-- End .entry-content -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
                </div><!-- End .col-lg-9 -->

                <aside class="col-lg-3">
                    <div class="sidebar">

                        <div class="widget">
                            <h3 class="widget-title">Ultimas Noticias</h3><!-- End .widget-title -->

                            <ul class="posts-list">
                                @foreach ($noticias as $noticia)
                                    <li>
                                        <figure>
                                            <a href="{{ url('noticias/' . $noticia->id) }}">
                                                <img src="{{ asset('assets/uploads/noticias/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }}">
                                            </a>
                                        </figure>

                                        <div>
                                            <span>{{ \Carbon\Carbon::parse($noticia->updated_at)->format('d-m-Y') }}</span>
                                            <h4><a href="{{ url('noticias/' . $noticia->id) }}">{{ $noticia->titulo }}</a></h4>
                                        </div>
                                    </li>
                                @endforeach


                            </ul><!-- End .posts-list -->
                            {{ $noticias->links() }}
                        </div><!-- End .widget -->


                    </div><!-- End .sidebar sidebar-shop -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->

@endsection
