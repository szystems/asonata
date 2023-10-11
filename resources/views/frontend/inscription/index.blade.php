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
                    {{-- @include('frontend.inscription.search') --}}

                    <div class="col-lg-12">
                        @php
                            $available = 0;
                        @endphp

                        @if ($classes->count() != 0)
                            <table class="table table-cart table-mobile">
                                <thead>
                                    <tr>
                                        <th>{{ __('Class') }}</th>
                                        <th>{{ __('Schedule') }}</th>
                                        <th>{{ __('Quota') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>

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
                                            <tr>
                                                <td class="product-col">
                                                    <div class="product">
                                                        <figure class="product-media">
                                                            <a href="{{ url('show-inscription-class/'.$class->id) }}">
                                                                @if ($class->Cimage)
                                                                    {{-- <img class="img-responsive text-center" src="{{ asset('assets/uploads/categories/'.$class->Cimage) }}" alt="{{ $class->Cname }}" style="min-height:270px;  width:100%;"> --}}
                                                                    <img src="{{ asset('assets/uploads/categories/'.$class->Cimage) }}" alt="Class image">
                                                                @else
                                                                    {{-- <img class="img-responsive text-center" src="{{ asset('assets/imgs/noimage.png') }}" style="min-height:270px;  width:100%;"> --}}
                                                                    <img src="{{ asset('assets/imgs/noimage.png') }}" alt="Class image">
                                                                @endif
                                                            </a>
                                                        </figure>

                                                        <h3 class="product-title">
                                                            <a href="{{ url('show-inscription-class/'.$class->id) }}"><strong><u>{{ $class->Cname }}</u></strong></a>
                                                            <br>
                                                            <small>{{ __('Age') }}:&nbsp;<b>{{ $class->age_from }} - {{ $class->age_to }} {{ __('Years') }}</b></small>
                                                            <br>
                                                            <small><font color="limegreen">{{ $start_date }}</font> - <font color="red">{{ $end_date }}</font></small>
                                                        </h3><!-- End .product-title -->
                                                    </div><!-- End .product -->
                                                </td>
                                                <td class="product-title">
                                                    <div class="entry-cats">
                                                        <font color="limegreen">{{ $start_time }}</font> - <font color="red">{{ $end_time }}</font>
                                                        <br>
                                                        {{ __('Days') }}: <b>@if($class->sunday == 1) {{ __('Sunday') }},  @endif @if($class->monday == 1) {{ __('Monday') }},  @endif @if($class->tuesday == 1) {{ __('Tuesday') }},  @endif @if($class->wednesday == 1) {{ __('Wednesday') }},  @endif @if($class->thursday == 1) {{ __('Thursday') }},  @endif @if($class->friday == 1) {{ __('Friday') }},  @endif @if($class->saturday == 1) {{ __('Saturday') }}  @endif</b>
                                                        <br>
                                                        {{ __('Facility') }}:&nbsp;<b>{{ $class->Fname }}</b>
                                                    </div><!-- End .entry-cats -->
                                                </td>
                                                <td class="product-title">
                                                    <p>{{ __('Available') }}: <b>{{ $disponibles }} {{ __('Athletes') }}</b></p>
                                                </td>
                                                <td class="product-title">
                                                    <a href="{{ url('show-inscription-class/'.$class->id) }}" class="btn btn-outline-primary btn-order btn-block">{{ __('Join') }}</a>
                                                </td>
                                            </tr>
                                        @endif


                                    @endforeach

                                </tbody>
                            </table><!-- End .table table-wishlist -->

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
                    </div><!-- End .col-lg-9 -->


                    <hr class="mb-5">
                </div>
            </div>
        </div>
    </div>
@endsection
