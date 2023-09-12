@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url('{{ asset('fronttemplate/assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">{{ __('Inscriptions') }}<span>{{ __('Cycles') }}</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('inscriptions-cycles') }}">{{ __('Inscriptions') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Cycles') }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">

            <h2 class="title text-center mb-3">{{ __('Available Cycles') }}</h2><!-- End .title mb-2 -->

            <div class="text-center">
                <p>{{ __('Select a cycle to view available classes') }}</p><!-- End .title -->
            </div><!-- End .text-center -->

            <h3></h3>

                	<div class="row justify-content-center">

                        @if ($cycles->count() != 0)
                            @foreach ($cycles as $cycle)
                                <div class="col-md-6 col-lg-4">
                                    @php
                                        $start_date = date("d-m-Y", strtotime($cycle->start_date));
                                        $end_date = date("d-m-Y", strtotime($cycle->end_date));
                                        $classes=DB::table('class')
                                        ->where('status',1)
                                        ->where('cycle_id',$cycle->id)
                                        ->get();
                                    @endphp
                                    <div class="banner banner-cat">
                                        <a href="{{ url('inscriptions-classes/'.$cycle->id) }}">
                                            <img src="{{ asset('fronttemplate/assets/images/category/3cols/banner-4.jpg') }}" alt="Banner">
                                        </a>

                                        <div class="banner-content banner-content-overlay text-center">
                                            <a href="{{ url('inscriptions-classes/'.$cycle->id) }}">
                                                <h3 class="banner-title">{{ $cycle->name }}</h3><!-- End .banner-title -->
                                            </a>
                                            <h4 class="banner-subtitle">{{ __('Classes') }}: {{ $classes->count() }}</h4><!-- End .banner-subtitle -->
                                            <h4 class="banner-subtitle"><font color="limegreen">{{ $start_date }}</font> / <font color="red">{{ $end_date }}</font></h4><!-- End .banner-subtitle -->

                                            <a href="{{ url('inscriptions-classes/'.$cycle->id) }}" class="banner-link">{{ __('Show available classes') }}</a>
                                        </div><!-- End .banner-content -->
                                    </div><!-- End .banner -->
                                </div><!-- End .col-md-6 -->
                            @endforeach
                        @else
                            <div class="alert alert-primary text-white" role="alert">
                                <strong>{{ __('No cycles added or found!') }}</strong> <a href="{{ url('add-cycle') }}"> {{ __('Add Cycle') }}</a>
                            </div>
                        @endif



                	</div><!-- End .row -->

                	<hr class="mb-4">
        </div><!-- End .container -->

    </div><!-- End .page-content -->
@endsection
