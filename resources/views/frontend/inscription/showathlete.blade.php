@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url('{{ asset('fronttemplate/assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">{{ __('Inscriptions') }}<span>{{ __('Athlete Information') }}</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/inscriptions') }}">{{ __('Inscriptions') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('show-inscription-class/'.$class->id) }}">{{ $class->Cname }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Registration Form') }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
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


                    @if (count($errors)>0)
                        <div class="alert alert-danger text-white" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                      <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif

                    <form action="{{ url('update-athlete-inscription/'.$atleta->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="checkout-title">{{ __('Athlete Information') }}</h2><!-- End .checkout-title -->
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>{{ __('Date of Birth') }} </label>

                                            <div class="input-group input-group-dynamic mb-4">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                @php
                                                    $fecha_nacimiento = date("d-m-Y", strtotime($atleta->birth));
                                                @endphp
                                                <input type="text" class="form-control" id="datepickerbirth" aria-label="Amount (to the nearest dollar)" name="birth" value="{{ $fecha_nacimiento }}" >
                                            </div>
                                            @if ($errors->has('birth'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('birth') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-3">
                                        <label>{{ __('Athlete CUI') }} </label>
                                        <input readonly type="text" class="form-control" name="cui_dpi" onkeypress="return validarentero(event,this.value)" value="{{ $atleta->cui_dpi }}">
                                        @if ($errors->has('cui_dpi'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('cui_dpi') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-3">
                                        <label>{{ __('Gender') }} </label>
                                        <select class="form-control" name="gender">
                                            @if( $atleta->gender != null)
                                                <option value="0">{{ $atleta->gender == '0' ? __('Male') : __('Female') }}</option>
                                            @endif
                                            <option value="0">{{ __('Male') }}</option>
                                            <option value="1">{{ __('Female') }}</option>
                                        </select>
                                    </div><!-- End .col-sm-6 -->

                                </div><!-- End .row -->

                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>{{ __('Name') }} </label>
                                        <input type="text" class="form-control" name="name" value="{{ $atleta->name }}" placeholder="José Pérez">
                                        @if ($errors->has('name'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('name') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-3">
                                        <label>{{ __('Phone') }} </label>
                                        <input type="text" class="form-control" name="phone" onkeypress="return validarentero(event,this.value)" value="{{ $atleta->phone }}" placeholder="xxxxxxxx">
                                        @if ($errors->has('phone'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('phone') }}</font>
                                                    </strong>
                                            </span>
                                        @endif


                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-3">
                                        <label>{{ __('Whatsapp') }} </label>
                                        <input type="text" class="form-control"name="whatsapp" onkeypress="return validarentero(event,this.value)" value="{{ $atleta->whatsapp }}" placeholder="xxxxxxxx">
                                        @if ($errors->has('cui_dpi'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('whatsapp') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-3">
                                        <label>Email </label>
                                        <input type="text" class="form-control" name="email" value="{{ $atleta->email }}" placeholder="joseperez@dominio.com">
                                        @if ($errors->has('email'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('email') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-3">
                                        <label>E{{ __('Ethnic Group') }}</label>
                                        <select class="form-control" name="ethnic_group">
                                            <option value="{{ $atleta->ethnic_group }}">{{ $atleta->ethnic_group }}</option>
                                            <option value="Maya">Maya</option>
                                            <option value="Garífuna">Garífuna</option>
                                            <option value="Xinca">Xinca</option>
                                            <option value="Mestizo">Mestizo</option>
                                            <option value="Ladino">Ladino</option>
                                            <option value="Otra">Otra</option>
                                        </select>
                                        @if ($errors->has('ethnic_group'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('ethnic_group') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-3">
                                        <label>E{{ __('Covid19 Doses Number') }}</label>
                                        <select class="form-control" name="doses_number">
                                            <option value="{{ $atleta->doses_number }}">{{ $atleta->doses_number }}</option>
                                            <option value="Ninguna">Ninguna</option>
                                            <option value="1ra. Dosis">1ra. Dosis</option>
                                            <option value="2da. Dosis">2da. Dosis</option>
                                            <option value="3ra. Dosis">3ra. Dosis</option>
                                            <option value="Refuerzo y más">Refuerzo y más</option>
                                        </select>
                                        @if ($errors->has('doses_number'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('doses_number') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-3">
                                        <label>{{ __('Education Obtained') }}</label>
                                        <select class="form-control" name="education_obtained">
                                            <option value="{{ $atleta->education_obtained }}">{{ $atleta->education_obtained }}</option>
                                            <option value="Ninguna">Ninguna</option>
                                            <option value="Kinder">Kinder</option>
                                            <option value="Parvulos">Parvulos</option>
                                            <option value="Primaria">Primaria</option>
                                            <option value="Basico">Basico</option>
                                            <option value="Diversificado">Diversificado</option>
                                            <option value="Tecnico">Tecnico</option>
                                            <option value="Universitario">Universitario</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                        @if ($errors->has('education_obtained'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('education_obtained') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-3">
                                        <label>E{{ __('Tshirt Size') }}</label>
                                        <select class="form-control" name="tshirt_size">
                                            <option value="{{ $atleta->tshirt_size }}">{{ $atleta->tshirt_size }}</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                        </select>
                                        @if ($errors->has('tshirt_size'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('tshirt_size') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-4">
                                        <label>{{ __('Country') }} </label>
                                        <input readonly type="text" class="form-control" name="country" value="{{ $atleta->country }}">
                                        @if ($errors->has('country'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('country') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-4">
                                        <label>{{ __('State') }}</label>
                                        <select class="form-control" name="state" id="departamentos" onchange="cargarMunicipios()">
                                            <option selected value="{{ $atleta->state }}">{{ $atleta->state }}</option>
                                            <option value="">Selecciona un departamento</option>
                                            <option value="Alta Verapaz">Alta Verapaz</option>
                                            <option value="Baja Verapaz">Baja Verapaz</option>
                                            <option value="Chimaltenango">Chimaltenango</option>
                                            <option value="Chiquimula">Chiquimula</option>
                                            <option value="El Progreso">El Progreso</option>
                                            <option value="Escuintla">Escuintla</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Huehuetenango">Huehuetenango</option>
                                            <option value="Izabal">Izabal</option>
                                            <option value="Jalapa">Jalapa</option>
                                            <option value="Jutiapa">Jutiapa</option>
                                            <option value="Petén">Petén</option>
                                            <option value="Quetzaltenango">Quetzaltenango</option>
                                            <option value="Quiché">Quiché</option>
                                            <option value="Retalhuleu">Retalhuleu</option>
                                            <option value="Sacatepéquez">Sacatepéquez</option>
                                            <option value="San Marcos">San Marcos</option>
                                            <option value="Santa Rosa">Santa Rosa</option>
                                            <option value="Sololá">Sololá</option>
                                            <option value="Suchitepéquez">Suchitepéquez</option>
                                            <option value="Totonicapán">Totonicapán</option>
                                            <option value="Zacapa">Zacapa</option>
                                        </select>
                                        @if ($errors->has('state'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('state') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-4">
                                        <label>{{ __('City') }}</label>
                                        <select name="city" type="text" class="form-control" id="municipios">
                                            <option selected value="{{ $atleta->city }}">{{ $atleta->city }}</option>
                                            <option value="">Selecciona un municipio</option>
                                        </select>
                                        @if ($errors->has('city'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('city') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->


                                </div><!-- End .row -->

                                <label>{{ __('Address') }} </label>
                                <input type="text" class="form-control" name="address" placeholder="Tu dirección completa" value="{{ $atleta->address }}">
                                @if ($errors->has('address'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('address') }}</font>
                                            </strong>
                                    </span>
                                @endif

                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="">{{ __('Athlete Image') }}</label>
                                        <input type="file" name="image" class="form-control" value="{{ $atleta->image }}" required>
                                        @if ($errors->has('image'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('image') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-4">
                                        <label for="">{{ __('Vaccination Card') }}</label>
                                        <input type="file" name="vaccination_card" class="form-control" value="{{ $atleta->vaccination_card }}" required>
                                        @if ($errors->has('vaccination_card'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('vaccination_card') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-4">
                                        <label for="">{{ __('Birth Certificate') }}</label>
                                        <input type="file" name="birth_certificate" class="form-control" value="{{ $atleta->birth_certificate }}" required>
                                        @if ($errors->has('birth_certificate'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('birth_certificate') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <hr class="mb-5">

                                <h2 class="checkout-title">{{ __('Responsible Information') }}</h2><!-- End .checkout-title -->

                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="">{{ __('Responsible Name') }}</label>
                                        <input type="text" class="form-control" name="responsible_name" value="{{ $atleta->responsible_name }}" placeholder="Rubén Pérez">
                                        @if ($errors->has('responsible_name'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('responsible_name') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-3">
                                        <label for="">{{ __('Responsible DPI') }}</label>
                                        <input type="text" class="form-control" name="responsible_dpi" value="{{ $atleta->responsible_dpi }}" onkeypress="return validarentero(event,this.value)" placeholder="xxxxxxxxxxxxx">
                                        @if ($errors->has('responsible_dpi'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('responsible_dpi') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-3">
                                        <label for="">{{ __('Responsible Phone') }}</label>
                                        <input type="text" class="form-control" name="responsible_phone" onkeypress="return validarentero(event,this.value)" value="{{ $atleta->responsible_phone }}" placeholder="xxxxxxxx">
                                        @if ($errors->has('responsible_phone'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('responsible_phone') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-3">
                                        <label for="">{{ __('Responsible Whatsapp') }}</label>
                                        <input type="text" class="form-control" name="responsible_whatsapp" onkeypress="return validarentero(event,this.value)" value="{{ $atleta->responsible_whatsapp }}" placeholder="xxxxxxxx">
                                        @if ($errors->has('responsible_whatsapp'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('responsible_whatsapp') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-3">
                                        <label for="">{{ __('Responsible Email') }}</label>
                                        <input type="text" class="form-control" name="responsible_email" value="{{ $atleta->responsible_email }}" placeholder="rubenperez@dominio.com">
                                        @if ($errors->has('responsible_email'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('responsible_email') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-9">
                                        <label for="">{{ __('Responsible Address') }}</label>
                                        <input type="text" class="form-control border px-2 " name="responsible_address" value="{{ $atleta->responsible_address }}" >
                                        @if ($errors->has('responsible_address'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('responsible_address') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>E{{ __('Kinship') }}</label>
                                        <select class="form-control" name="kinship">
                                            <option value="{{ $atleta->kinship }}">{{ $atleta->kinship }}</option>
                                            <option value="Madre">Madre</option>
                                            <option value="Padre">Padre</option>
                                            <option value="Abuelo">Abuelo</option>
                                            <option value="Abuela">Abuela</option>
                                            <option value="Encargado">Encargado</option>
                                            <option value="Hermano">Hermano</option>
                                            <option value="Hermana">Hermana</option>
                                            <option value="Primo">Primo</option>
                                            <option value="Prima">Prima</option>
                                            <option value="Tio">Tio</option>
                                            <option value="Tia">Tia</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                        @if ($errors->has('kinship'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('kinship') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>E{{ __('Responsible Covid19 Doses Number') }}</label>
                                        <select class="form-control" name="responsible_doses_number">
                                            <option value="{{ $atleta->responsible_doses_number }}">{{ $atleta->responsible_doses_number }}</option>
                                            <option value="Ninguna">Ninguna</option>
                                            <option value="1ra. Dosis">1ra. Dosis</option>
                                            <option value="2da. Dosis">2da. Dosis</option>
                                            <option value="3ra. Dosis">3ra. Dosis</option>
                                            <option value="Refuerzo y más">Refuerzo y más</option>
                                        </select>
                                        @if ($errors->has('responsible_doses_number'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('responsible_doses_number') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-12">
                                        <label for="">{{ __('Responsible DPI Image') }}</label>
                                        <input type="file" name="responsible_image" class="form-control" value="{{ $atleta->responsible_image }}" required>
                                        @if ($errors->has('responsible_image'))
                                            <span class="help-block opacity-7">
                                                    <strong>
                                                        <font color="red">{{ $errors->first('responsible_image') }}</font>
                                                    </strong>
                                            </span>
                                        @endif
                                    </div><!-- End .col-sm-6 -->

                                </div><!-- End .row -->


                            </div><!-- End .col-lg-9 -->

                        </div><!-- End .row -->

                        <div class="cta cta-display bg-image pt-4 pb-4" style="background-image: url({{ asset('fronttemplate/assets/images/page-header-bg.jpg') }});">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-10 col-lg-9 col-xl-8">
                                        <div class="row no-gutters flex-column flex-sm-row align-items-sm-center">
                                            <div class="col">
                                                {{-- <h3 class="cta-title text-white"><font color="ad060e">Inscribirse</font></h3><!-- End .cta-title --> --}}
                                                <p class="cta-desc text-white"><font color="black">{{ __('Review the data carefully, accept the contract and click on End Request') }}</font></p><!-- End .cta-desc -->
                                            </div><!-- End .col -->

                                            <div class="col-auto" align="center">
                                                <input type="hidden" name="idclass" value="{{ $class->id }}">
                                                {{-- <input type="text"  class="form-control text-center" name="cui_dpi" onkeypress="return validarentero(event,this.value)" placeholder="{{ __('Athlete CUI') }}" required> --}}
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                                    <label class="custom-control-label" for="register-policy">{{ __('I agree to the') }} <a href="{{ asset('assets/uploads/contracts/'.$class->Gcontract) }}" target="_blank">{{ __('Contract') }}</a> *</label>
                                                </div><!-- End .custom-checkbox -->
                                                <button type="submit" class="btn btn-outline-primary-2">
                                                    <span>{{ __('End request') }}</span>
                                                    <i class="icon-long-arrow-right"></i>
                                                </button>
                                            </div><!-- End .col-auto -->
                                        </div><!-- End .row no-gutters -->
                                    </div><!-- End .col-md-10 col-lg-9 -->
                                </div><!-- End .row -->
                            </div><!-- End .container -->
                        </div><!-- End .cta -->

                    </form>

                </div>
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
    {{-- <div class="cta cta-display bg-image pt-4 pb-4" style="background-image: url({{ asset('fronttemplate/assets/images/page-header-bg.jpg') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-9 col-xl-8">
                    <div class="row no-gutters flex-column flex-sm-row align-items-sm-center">
                        <div class="col">
                            <h3 class="cta-title text-white"><font color="ad060e">Inscribirse</font></h3><!-- End .cta-title -->
                            <p class="cta-desc text-white"><font color="black">Escribe tu número de CUI y presiona siguiente</font></p><!-- End .cta-desc -->
                        </div><!-- End .col -->

                        <div class="col-auto" align="center">
                            <form action="{{ url('inscription_submit') }}" method="POST">
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
    </div><!-- End .cta --> --}}

    <script>

        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

        var optSimple = {
            format: "dd-mm-yyyy",
            language: "es",
            autoclose: true,
            todayHighlight: true,
            todayBtn: "linked",
            orientation: "auto"
        };
        $( '#datepickerbirth' ).datepicker( optSimple );

    </script>

<script>
    const municipiosPorDepartamento = {
      "Alta Verapaz": ["Cobán", "Chisec", "San Cristóbal Verapaz", "Santa Cruz Verapaz", "Tactic", "Tamahú", "San Juan Chamelco", "Panzós", "Senahú", "Cahabón", "Chahal", "Fray Bartolomé de las Casas", "Santa María Cahabón", "La Tinta", "Raxruhá"],
      "Baja Verapaz": ["Salamá", "San Miguel Chicaj", "Rabinal", "Cubulco", "Granados", "San Jerónimo", "Purulhá"],
      "Chimaltenango": ["Chimaltenango", "San José Poaquil", "San Martín Jilotepeque", "Comalapa", "Santa Apolonia", "Tecpán Guatemala", "Patzún", "Pochuta", "Patzicía", "Santa Cruz Balanyá", "Acatenango", "Yepocapa", "San Andrés Itzapa", "Parramos", "Zaragoza", "El Tejar"],
      "Chiquimula": ["Chiquimula", "San José La Arada", "San Juan Ermita", "Jocotán", "Camotán", "Olopa", "Esquipulas", "Concepción Las Minas", "Quetzaltepeque"],
      "El Progreso": ["Guastatoya", "Morazán", "San Agustín Acasaguastlán", "San Antonio La Paz", "San Cristóbal Acasaguastlán", "Sanarate", "Sansare", "Santa María Ixhuatán"],
      "Escuintla": ["Escuintla", "Santa Lucía Cotzumalguapa", "La Democracia", "Siquinalá", "Masagua", "Tiquisate", "La Gomera", "Guazacapán", "San José", "Iztapa", "Palín", "San Vicente Pacaya", "Nueva Concepción"],
      "Guatemala": ["Guatemala", "Santa Catarina Pinula", "San José Pinula", "San José del Golfo", "Palencia", "Chinautla", "San Pedro Ayampuc", "Mixco", "San Pedro Sacatepéquez", "San Juan Sacatepéquez", "San Raymundo", "Chuarrancho", "Fraijanes", "Amatitlán", "Villa Nueva", "Villa Canales", "San Miguel Petapa"],
      "Huehuetenango": ["Huehuetenango", "Chiantla", "Malacatancito", "Cuilco", "Nentón", "San Pedro Necta", "Jacaltenango", "San Pedro Soloma", "San Ildelfonso Ixtahuacán", "Santa Bárbara", "La Libertad", "La Democracia", "San Miguel Acatán", "San Rafael La Independencia", "Todos Santos Cuchumatán", "San Juan Atitán", "Santa Eulalia", "San Mateo Ixtatán", "Colotenango", "San Sebastián Huehuetenango", "Tectitán", "Concepción Huista", "San Juan Ixcoy", "San Antonio Huista", "San Sebastián Coatán", "Santa Cruz Barillas", "Aguacatán", "San Rafael Petzal", "San Gaspar Ixchil", "Santiago Chimaltenango", "Santa Ana Huista"],
      "Izabal": ["Puerto Barrios", "Livingston", "El Estor", "Morales", "Los Amates"],
      "Jalapa": ["Jalapa", "San Pedro Pinula", "San Luis Jilotepeque", "San Manuel Chaparrón", "San Carlos Alzatate", "Monjas", "Mataquescuintla"],
      "Jutiapa": ["Jutiapa", "El Progreso", "Santa Catarina Mita", "Agua Blanca", "Asunción Mita", "Yupiltepeque", "Atescatempa", "Jerez", "El Adelanto", "Zapotitlán", "Comapa", "Jalpatagua", "Conguaco", "Moyuta", "Pasaco", "San José Acatempa", "Quesada"],
      "Petén": ["Flores", "San José", "San Benito", "San Andrés", "La Libertad", "San Francisco", "Santa Ana", "Dolores", "San Luis", "Sayaxché", "Melchor de Mencos", "Poptún", "Las Cruces", "La Blanca", "El Chal"],
      "Quetzaltenango": ["Quetzaltenango", "Salcajá", "Olintepeque", "San Carlos Sija", "Sibilia", "Cabricán", "Cajolá", "San Miguel Siguilá", "Ostuncalco", "San Mateo", "Concepción Chiquirichapa", "San Martín Sacatepéquez", "Almolonga", "Cantel", "Huitán", "Zunil", "Colomba", "San Francisco La Unión", "El Palmar", "Coatepeque", "Génova", "Flores Costa Cuca", "La Esperanza"],
      "Quiché": ["Santa Cruz del Quiché", "Chiché", "Chinique", "Zacualpa", "Chajul", "Chichicastenango", "Patzité", "San Antonio Ilotenango", "San Pedro Jocopilas", "Cunén", "San Juan Cotzal", "Joyabaj", "Nebaj", "San Andrés Sajcabajá", "Uspantán", "Sacapulas", "San Bartolomé Jocotenango", "Canillá"],
      "Retalhuleu": ["Retalhuleu", "San Sebastián", "Santa Cruz Mulúa", "San Martín Zapotitlán", "San Felipe", "San Andrés Villa Seca", "Champerico", "Nuevo San Carlos", "El Asintal"],
      "Sacatepéquez": ["Antigua Guatemala", "Jocotenango", "Pastores", "Sumpango", "Santo Domingo Xenacoj", "Santiago Sacatepéquez", "San Bartolomé Milpas Altas", "San Lucas Sacatepéquez", "Santa Lucía Milpas Altas", "Magdalena Milpas Altas", "Santa María de Jesús", "Ciudad Vieja", "San Miguel Dueñas", "San Juan Alotenango", "San Antonio Aguas Calientes"],
      "San Marcos": ["San Marcos", "San Pedro Sacatepéquez", "San Antonio Sacatepéquez", "Comitancillo", "San Miguel Ixtahuacán", "Concepción Tutuapa", "Tacaná", "Sibinal", "Tajumulco", "Tejutla", "San Rafael Pie de la Cuesta", "Nuevo Progreso", "El Tumbador", "San José El Rodeo", "Malacatán", "Catarina", "Ayutla", "Ocós", "San Pablo", "El Quetzal", "La Reforma", "Pajapita", "Ixchiguan", "San José Ojetenam"],
      "Santa Rosa": ["Cuilapa", "Barberena", "Santa Rosa de Lima", "Casillas", "San Rafael Las Flores", "Oratorio", "San Juan Tecuaco", "Chiquimulilla", "Taxisco", "Santa María Ixhuatán", "Guazacapán", "Santa Cruz Naranjo", "Pueblo Nuevo Viñas", "Nueva Santa Rosa"],
      "Sololá": ["Sololá", "San José Chacayá", "Santa María Visitación", "Santa Lucía Utatlán", "Nahualá", "Santa Catarina Ixtahuacán", "Santa Clara La Laguna", "Concepción", "San Andrés Semetabaj", "Panajachel", "Santa Catarina Palopó", "San Antonio Palopó", "San Lucas Tolimán", "Santa Cruz La Laguna", "San Pablo La Laguna", "San Marcos La Laguna", "San Juan La Laguna", "San Pedro La Laguna"],
      "Suchitepéquez": ["Mazatenango", "Cuyotenango", "San Francisco Zapotitlán", "San Bernardino", "San José El Idolo", "Santo Domingo Suchitepéquez", "San Lorenzo", "Samayac", "San Pablo Jocopilas", "San Antonio Suchitepéquez", "San Miguel Panán", "San Gabriel", "Chicacao", "Patulul", "Santa Bárbara", "San Juan Bautista", "Santo Tomás La Unión", "Zunilito", "Pueblo Nuevo"],
      "Totonicapán": ["Totonicapán", "San Cristóbal Totonicapán", "San Francisco El Alto", "Santa María Chiquimula", "San Bartolo", "Santa Lucía La Reforma", "San Andrés Xecul", "Momostenango"],
      "Zacapa": ["Zacapa", "Estanzuela", "Río Hondo", "Gualán", "Teculután", "Usumatlán", "Cabañas", "San Diego", "La Unión", "Huite"],
    };

    function cargarMunicipios() {
      const departamentoSelect = document.getElementById("departamentos");
      const municipioSelect = document.getElementById("municipios");
      const departamento = departamentoSelect.value;

      municipioSelect.innerHTML = "<option value=''>Selecciona un municipio</option>";

      if (departamento && municipiosPorDepartamento.hasOwnProperty(departamento)) {
        const municipios = municipiosPorDepartamento[departamento];
        municipios.forEach(function(municipio) {
          const option = document.createElement("option");
          option.value = municipio;
          option.text = municipio;
          municipioSelect.appendChild(option);
        });
      }
    }
  </script>

    @push('scripts')

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
