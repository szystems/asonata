@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url('{{ asset('fronttemplate/assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">{{ __('Inscriptions') }}<span>{{ __('Available Classes') }}</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('inscriptions-cycles') }}">{{ __('Inscriptions') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Classes') }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <h2 class="title text-center mb-2">{{ __('Classes List') }}</h2><!-- End .title text-center -->

                    <div class="text-center">
                        <p>{{ __('Select the class you want to enroll in') }}</p><!-- End .title -->
                        <hr class="mb-5">
                    </div><!-- End .text-center -->
                    @php
                        $available = 0;
                    @endphp

                    @if ($classes->count() != 0)
                        @foreach ($classes as $class)
                            @php
                                $start_time = date('h:i A', strtotime($class->Sstart_time));
                                $end_time = date('h:i A', strtotime($class->Send_time));

                                $start_date = date('d-m-Y', strtotime($class->CLstart_date));
                                $end_date = date('d-m-Y', strtotime($class->CLend_date));

                                $hoy = date("Y-m-d");
                                $start_date_status = date("Y-m-d", strtotime($class->CLstart_date));
                                $end_date_status = date("Y-m-d", strtotime($class->CLend_date));

                                $start_time = date('h:i A', strtotime($class->Sstart_time));
                                $end_time = date('h:i A', strtotime($class->Send_time));

                                //obtener cupos ocupados
                                $cuposOcupados=DB::table('inscriptions as i')
                                ->join('class as c','i.class_id','=','c.id')
                                ->where('c.schedule_id',$class->CLschedule_id)
                                ->where('i.inscription_status','=',1)
                                ->where('i.status','=',1)
                                ->get();

                                //obtenemos cupo total y cupo ocupado
                                $disponibilidad = $class->quota;
                                $ocupados = $cuposOcupados->count();
                                //restamos los cupos ocupados a la disponibilidad
                                $disponibles = $disponibilidad - $ocupados;
                                // si hay 1 o mas cupos disponibles se realiza la confirmacion
                            @endphp


                            @if ($disponibles >= 1)
                                @php
                                    $available = $available + 1;
                                @endphp
                                <article class="entry entry-list">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <figure class="entry-media">
                                                {{-- <a href="single.html">
                                                    <img src="{{ asset('fronttemplate/assets/images/blog/listing/post-1.jpg') }}" alt="image desc">
                                                </a> --}}
                                                <a href="{{ url('show-inscription-class/'.$class->id) }}">
                                                    @if ($class->Cimage)
                                                        {{-- <img class="img-responsive text-center" src="{{ asset('assets/uploads/categories/'.$class->Cimage) }}" alt="{{ $class->Cname }}" style="min-height:270px;  width:100%;"> --}}
                                                        <img src="{{ asset('assets/uploads/categories/'.$class->Cimage) }}" alt="image desc">
                                                    @else
                                                        {{-- <img class="img-responsive text-center" src="{{ asset('assets/imgs/noimage.png') }}" style="min-height:270px;  width:100%;"> --}}
                                                        <img src="{{ asset('assets/imgs/noimage.png') }}" alt="image desc">
                                                    @endif
                                                </a>
                                            </figure><!-- End .entry-media -->
                                        </div><!-- End .col-md-5 -->

                                        <div class="col-md-9">
                                            <div class="entry-body">
                                                <div class="entry-meta">
                                                    <span class="entry-author">
                                                        <font color="limegreen">{{ $start_date }}</font> - <font color="red">{{ $end_date }}</font>
                                                    </span>
                                                    <span class="meta-separator">|</span>
                                                        {{ __('Age') }}:&nbsp;<b>{{ $class->age_from }} - {{ $class->age_to }} {{ __('Years') }}</b>
                                                    <span class="meta-separator">|</span>
                                                        {{ __('Facility') }}:&nbsp;<b>{{ $class->Fname }}</b>
                                                </div><!-- End .entry-meta -->

                                                <h2 class="entry-title">
                                                    <u><a href="{{ url('show-inscription-class/'.$class->id) }}">{{ $class->Cname }}</a></u>
                                                </h2><!-- End .entry-title -->

                                                <div class="entry-cats">
                                                    {{ __('Days') }}: <b>@if($class->sunday == 1) {{ __('Sunday') }},  @endif @if($class->monday == 1) {{ __('Monday') }},  @endif @if($class->tuesday == 1) {{ __('Tuesday') }},  @endif @if($class->wednesday == 1) {{ __('Wednesday') }},  @endif @if($class->thursday == 1) {{ __('Thursday') }},  @endif @if($class->friday == 1) {{ __('Friday') }},  @endif @if($class->saturday == 1) {{ __('Saturday') }}  @endif</b>
                                                    <font color="limegreen">{{ $start_time }}</font> - <font color="red">{{ $end_time }}</font>
                                                </div><!-- End .entry-cats -->

                                                <div class="entry-content">
                                                    <p>{{ $class->Cdescription }}</p>
                                                    <p>{{ __('Available Quota') }}: <b>{{ $disponibles }} {{ __('Athletes') }}</b></p>
                                                    <a href="{{ url('show-inscription-class/'.$class->id) }}" class="read-more">{{ __('Join') }}</a>
                                                </div><!-- End .entry-content -->
                                            </div><!-- End .entry-body -->
                                        </div><!-- End .col-md-7 -->
                                    </div><!-- End .row -->
                                </article><!-- End .entry -->
                            @endif


                        @endforeach
                        @if ($available == 0)
                            <div class="alert alert-primary text-white" role="alert">
                                <strong>{{ __('There is no available quota at the moment') }}</strong> <a href="{{ url('inscriptions-cycles') }}"> {{ __('Cycles') }}</a>
                            </div>
                        @endif
                    @elseif ($classes->count() == null )
                        <div class="alert alert-primary text-white" role="alert">
                            <strong>{{ __('No Classes added or found!') }}</strong> <a href="{{ url('inscriptions-cycles') }}"> {{ __('Cycles') }}</a>
                        </div>
                    @endif
                    <hr class="mb-5">
                </div>
            </div>
        </div>
    </div>
@endsection
