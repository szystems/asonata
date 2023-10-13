@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url('{{ asset('fronttemplate/assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">{{ __('Inscriptions') }}<span>{{ __('Available Class') }}</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/inscriptions') }}">{{ __('Inscriptions') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Class') }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <!--Mensaje de abono correcto-->
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))

                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                        {{session()->forget('alert-' . $msg)}}
                    @endforeach
                </div> <!-- fin .flash-message -->
                <!-- Card Header -->
                <div class="col-lg-12">





                    @php
                        $start_time = date('h:i A', strtotime($class->Sstart_time));
                        $end_time = date('h:i A', strtotime($class->Send_time));

                        $start_date = date('d-m-Y', strtotime($class->CLstart_date));
                        $end_date = date('d-m-Y', strtotime($class->CLend_date));

                        $hoy = date("Y-m-d");
                        $start_date_status = date("Y-m-d", strtotime($class->CLstart_date));
                        $end_date_status = date("Y-m-d", strtotime($class->CLend_date));
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
                                        <a href="{{ url('show-inscription-class/'.$class->id) }}">{{ $class->Cname }}</a>
                                    </h2><!-- End .entry-title -->

                                    <div class="entry-cats">
                                        {{ __('Days') }}: <b>@if($class->sunday == 1) {{ __('Sunday') }},  @endif @if($class->monday == 1) {{ __('Monday') }},  @endif @if($class->tuesday == 1) {{ __('Tuesday') }},  @endif @if($class->wednesday == 1) {{ __('Wednesday') }},  @endif @if($class->thursday == 1) {{ __('Thursday') }},  @endif @if($class->friday == 1) {{ __('Friday') }},  @endif @if($class->saturday == 1) {{ __('Saturday') }}  @endif</b>
                                        <font color="limegreen">{{ $start_time }}</font> - <font color="red">{{ $end_time }}</font>
                                    </div><!-- End .entry-cats -->

                                    <div class="entry-cats">
                                        {{ __('Inscription') }}: <font color="black"><b>{{ $config->currency_simbol }}{{ number_format($class->CLinscription_payment,2, '.', ',') }}</b></font><br>
                                        {{ __('Badge') }}: <font color="black"><b>{{ $config->currency_simbol }}{{ number_format($class->CLbadge,2, '.', ',') }}</b></font><br>
                                        {{ __('Monthly Payment') }}: <font color="black"><b>{{ $config->currency_simbol }}{{ number_format($class->CLmonthly_payment,2, '.', ',') }}</b></font>
                                    </div><!-- End .entry-cats -->
                                </div><!-- End .entry-body -->
                            </div><!-- End .col-md-7 -->
                        </div><!-- End .row -->
                    </article><!-- End .entry -->



                    <p>- Lea detenidamente los siguientes apartados antes de realizar el formulario de inscripción</p>
                    @if($class->Cdescription != null)
                        <div class="pb-1 clearfix"></div><!-- End .clearfix -->
                        <div class="col-md-12 mb-3">
                            <label for="">{{ __('Course duration') }}</label>
                            <textarea readonly type="text" class="form-control border px-2 " rows="10">{{  $class->Cdescription  }}</textarea>
                        </div>
                    @endif
                    @if($class->CLnotes != null)
                        <div class="pb-1 clearfix"></div><!-- End .clearfix -->
                        <div class="col-md-12 mb-3">
                            <label for="">{{ __('Costs') }}</label>
                            <textarea readonly type="text" class="form-control border px-2 " rows="10">{{  $class->CLnotes  }}</textarea>
                        </div>
                    @endif

                    @if($class->Cimplements != null)
                        <div class="pb-1 clearfix"></div><!-- End .clearfix -->
                        <div class="col-md-12 mb-3">
                            <label for="">{{ __('Implements') }}</label>
                            <textarea readonly type="text" class="form-control border px-2 " rows="10">{{  $class->Cimplements  }}</textarea>
                        </div>
                    @endif

                    @if($class->Crequirements != null)
                        <div class="pb-1 clearfix"></div><!-- End .clearfix -->
                        <div class="col-md-12 mb-3">
                            <label for="">{{ __('Registration documents') }}</label>
                            <textarea readonly type="text" class="form-control border px-2 " rows="10">{{  $class->Crequirements  }}</textarea>
                        </div>
                    @endif

                    @if($config->registration_process != null)
                    <div class="pb-1 clearfix"></div><!-- End .clearfix -->
                    <div class="col-md-12 mb-3">
                        <label for="">{{ __('Registration Process') }}</label>
                        <textarea readonly type="text" class="form-control border px-2 " rows="10">{{  $config->registration_process  }}</textarea>
                    </div>
                    @endif

                    @if($config->payments_description != null)
                    <div class="pb-1 clearfix"></div><!-- End .clearfix -->
                    <div class="col-md-12 mb-3">
                        <label for="">{{ __('Recommendations and rules in the use of facilities') }}</label>
                        <textarea readonly type="text" class="form-control border px-2 " rows="10">{{  $config->payments_description  }}</textarea>
                    </div>
                    @endif

                    {{-- @if ($class->Gcontract != null)
                        <h2><font color="red"><i class="icon-arrow-down"></i></font><font color="blue"><a class="border-radius-md w-25" href="{{ asset('assets/uploads/contracts/'.$class->Gcontract) }}" target="_blank">{{ __('Download Contract') }}</a></font></h2>
                    @endif --}}
                    @if ($class->Ccontract != null)
                        <h2><font color="red"><i class="icon-arrow-down"></i></font><font color="blue"><a class="border-radius-md w-25" href="{{ asset('assets/uploads/contracts/categories'.$class->Ccontract) }}" target="_blank">{{ __('Download Contract') }}</a></font></h2>
                    @endif




                </div>


            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
    <div class="cta cta-display bg-image pt-4 pb-4" style="background-image: url({{ asset('fronttemplate/assets/images/page-header-bg.jpg') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-9 col-xl-8">
                    <div class="row no-gutters flex-column flex-sm-row align-items-sm-center">
                        <div class="col">
                            <h3 class="cta-title text-white"><font color="ad060e">{{ __('Join') }}</font></h3><!-- End .cta-title -->
                            <p class="cta-desc text-white"><font color="black">{{ __('Enter your CUI number and press next') }}</font></p><!-- End .cta-desc -->
                        </div><!-- End .col -->

                        <div class="col-auto" align="center">
                            <form action="{{ url('inscription-submit') }}" method="GET">
                                <input type="hidden" name="idclass" value="{{ $class->id }}">
                                <input type="text"  class="form-control text-center" name="cui_dpi" onkeypress="return validarentero(event,this.value)" placeholder="{{ __('Athlete CUI') }}" required>
                                <button type="submit" class="btn btn-outline-primary-2">
                                    <span>{{ __('Next') }}</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>
                            </form>
                        </div><!-- End .col-auto -->
                    </div><!-- End .row no-gutters -->
                </div><!-- End .col-md-10 col-lg-9 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cta -->

    @push ('scripts')
        <script>

            function validardecimal(e,txt)
            {
                tecla = (document.all) ? e.keyCode : e.which;
                if (tecla==8) return true;
                if (tecla==46 && txt.indexOf('.') != -1) return false;
                patron = /[\d\.]/;
                te = String.fromCharCode(tecla);
                return patron.test(te);
            }

            function validarentero(e,txt)
            {
                tecla = (document.all) ? e.keyCode : e.which;

                //Tecla de retroceso para borrar, siempre la permite
                if (tecla==8)
                {
                return true;
                }

                // Patron de entrada, en este caso solo acepta numeros
                patron =/[0-9]/;
                tecla_final = String.fromCharCode(tecla);
                return patron.test(tecla_final);
            }

        </script>

    @endpush
@endsection
