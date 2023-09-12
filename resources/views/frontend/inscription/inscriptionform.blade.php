@extends('layouts.frontend')
{{-- Trending products --}}
@section('content')
    <div class="page-header text-center" style="background-image: url('{{ asset('fronttemplate/assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">{{ __('Inscriptions') }}<span>{{ __('Registration Form') }}</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/inscriptions') }}">{{ __('Inscriptions') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('show-inscription-class/'.$class->id) }}">{{ $class->Cname }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Inscription Information') }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <!--Mensaje -->
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))

                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                        {{session()->forget('alert-' . $msg)}}
                    @endforeach
                </div>
                <!-- fin .flash-message -->
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
                    <br>

                    <form action="{{ url('pdf-inscription') }}" method="GET" target="_blank">
                        <input type="hidden" name="ratleta" value="{{ $atleta->id }}">
                        <input type="hidden" name="ridclass" value="{{ $class->id }}">
                        <input type="hidden" name="ridinscription" value="{{ $inscription->id }}">
                        <button type="submit" class="btn btn-outline-primary-2">
                            <span>{{ __('Download Inscription') }}</span>
                            <i class="	fa fa-download"></i>
                        </button>
                    </form>

                    <br>

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

                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="checkout-title">{{ __('Inscription Information') }}</h2><!-- End .checkout-title -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>{{ __('Inscription Date') }} </label>
                                    @php
                                        $fecha_inscripcion = date("d-m-Y", strtotime($inscription->created_at));
                                    @endphp
                                    <p>{{ $fecha_inscripcion }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-3">
                                    <label>{{ __('Last Update') }} </label>
                                    @php
                                        $fecha_act = date("d-m-Y", strtotime($inscription->updated_at));
                                    @endphp
                                    <p>{{ $fecha_act }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-3">
                                    <label>{{ __('Inscription Number') }} </label>
                                    <p>{{ $inscription->inscription_number }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-3">
                                    <label>{{ __('Status') }} </label>
                                    <p>
                                        @if($inscription->inscription_status == 0)<span class="badge bg-warning text-dark">{{ $inscription->inscription_status == 0 ? __('Pending') : '' }}</span>@endif
                                        @if($inscription->inscription_status == 1)<span class="badge bg-success text-dark">{{ $inscription->inscription_status == 1 ? __('Confirmed') : '' }}</span>@endif
                                        @if($inscription->inscription_status == 2)<span class="badge bg-danger text-dark">{{ $inscription->inscription_status == 2 ? __('Rejected') : '' }}</span>@endif
                                        @if($inscription->inscription_status == 3)<span class="badge bg-dark text-white">{{ $inscription->inscription_status == 3 ? __('Expelled') : '' }}</span>@endif
                                        @if($inscription->inscription_status == 4)<span class="badge bg-secondary text-white">{{ $inscription->inscription_status == 4 ? __('Retired') : '' }}</span>@endif
                                        @if($inscription->inscription_status == 5)<span class="badge bg-info text-white">{{ $inscription->inscription_status == 5 ? __('Promoted') : '' }}</span>@endif
                                    </p>
                                </div><!-- End .col-sm-6 -->
                                <div class="col-sm-3">
                                    <label>{{ __('Inscription Payment') }} </label>
                                    <p>
                                        @if($inscription->inscription_payment == 0)<span class="badge bg-warning text-dark">{{ $inscription->inscription_payment == 0 ? __('Pending') : '' }}</span>@endif
                                        @if($inscription->inscription_payment == 1)<span class="badge bg-success text-dark">{{ $inscription->inscription_payment == 1 ? __('Paid') : '' }}</span>@endif
                                    </p>
                                </div><!-- End .col-sm-6 -->
                                <div class="col-sm-3">
                                    <label>{{ __('Badge Payment') }} </label>
                                    <p>
                                        @if($inscription->badge_payment == 0)<span class="badge bg-warning text-dark">{{ $inscription->badge_payment == 0 ? __('Pending') : '' }}</span>@endif
                                        @if($inscription->badge_payment == 1)<span class="badge bg-success text-dark">{{ $inscription->badge_payment == 1 ? __('Paid') : '' }}</span>@endif
                                    </p>
                                </div><!-- End .col-sm-6 -->
                                @if ($inscription->notes != null)
                                    <div class="col-sm-3">
                                        <label>{{ __('Notes') }} </label>
                                        <textarea readonly type="text" class="form-control border px-2 " rows="10">{{  $inscription->notes  }}</textarea>
                                    </div><!-- End .col-sm-6 -->
                                @endif

                                @if ($inscription->payments != null)
                                    <div class="col-sm-3">
                                        <label>{{ __('Payments') }} </label>
                                        @php
                                            $inscriptionPayments=DB::table('payments')
                                            ->where('inscription_id',$inscription->id)
                                            ->where('type',2)
                                            ->get();
                                        @endphp
                                        <p>{{ $config->currency_simbol }}{{ number_format($class->CLmonthly_payment,2, '.', ',') }} <b>({{ $inscriptionPayments->count() }}/{{ $inscription->payments }})</b></p>
                                    </div><!-- End .col-sm-6 -->
                                @endif


                            </div><!-- End .row -->
                            <h2 class="checkout-title">{{ __('Athlete Information') }}</h2><!-- End .checkout-title -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>{{ __('Date of Birth') }} </label>
                                    @php
                                        $fecha_nacimiento = date("d-m-Y", strtotime($atleta->birth));
                                        $cumpleanos = new DateTime($atleta->birth);
                                        $hoy = new DateTime();
                                        $annos = $hoy->diff($cumpleanos);
                                        $edad = $annos->y;
                                    @endphp
                                    <p>{{ $fecha_nacimiento }} ({{ __('Age') }}: {{$edad }} {{ __('Years') }})</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-3">
                                    <label>{{ __('Athlete CUI') }} </label>
                                    <p>{{ $atleta->cui_dpi }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-3">
                                    <label>{{ __('Gender') }} </label>
                                    <p>{{ $atleta->gender == '0' ? __('Male') : __('Female') }}</p>
                                </div><!-- End .col-sm-6 -->

                            </div><!-- End .row -->

                            <div class="row">
                                <div class="col-sm-3">
                                    <label>{{ __('Name') }} </label>
                                    <p>{{ $atleta->name }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-3">
                                    <label>{{ __('Phone') }} </label>
                                    <p>{{ $atleta->phone }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-3">
                                    <label>{{ __('Whatsapp') }} </label>
                                    <p>{{ $atleta->whatsapp }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-3">
                                    <label>Email </label>
                                    <p>{{ $atleta->email }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-3">
                                    <label>E{{ __('Ethnic Group') }}</label>
                                    <p>{{ $atleta->ethnic_group }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-3">
                                    <label>E{{ __('Covid19 Doses Number') }}</label>
                                    <p>{{ $atleta->doses_number }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-3">
                                    <label>{{ __('Education Obtained') }}</label>
                                    <p>{{ $atleta->education_obtained }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-3">
                                    <label>{{ __('Tshirt Size') }}</label>
                                    <p>{{ $atleta->tshirt_size }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-4">
                                    <label>{{ __('Country') }} </label>
                                    <p>{{ $atleta->country }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-4">
                                    <label>{{ __('State') }}</label>
                                    <p>{{ $atleta->state }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-4">
                                    <label>{{ __('City') }}</label>
                                    <p>{{ $atleta->city }}</p>
                                </div><!-- End .col-sm-6 -->


                            </div><!-- End .row -->

                            <label>{{ __('Address') }} </label>
                            <p>{{ $atleta->address }}</p>

                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="">{{ __('Athlete Image') }}</label>
                                    <p>{{ $atleta->image }}</p>
                                    <img src="{{ asset('assets/uploads/athletes/'.$atleta->image) }}" alt="">
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-4">
                                    <label for="">{{ __('Vaccination Card') }}</label>
                                    <p>{{ $atleta->vaccination_card }}</p>
                                    <img src="{{ asset('assets/uploads/vaccination/'.$atleta->vaccination_card) }}" alt="">
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-4">
                                    <label for="">{{ __('Birth Certificate') }}</label>
                                    <p>{{ $atleta->birth_certificate }}</p>
                                    <img src="{{ asset('assets/uploads/certificate/'.$atleta->birth_certificate) }}" alt="">
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->

                            <hr class="mb-5">

                            <h2 class="checkout-title">{{ __('Responsible Information') }}</h2><!-- End .checkout-title -->

                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="">{{ __('Responsible Name') }}</label>
                                    <p>{{ $atleta->responsible_name }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-3">
                                    <label for="">{{ __('Responsible DPI') }}</label>
                                    <p>{{ $atleta->responsible_dpi }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-3">
                                    <label for="">{{ __('Responsible Phone') }}</label>
                                    <p>{{ $atleta->responsible_phone }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-3">
                                    <label for="">{{ __('Responsible Whatsapp') }}</label>
                                    <p>{{ $atleta->responsible_whatsapp }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-3">
                                    <label for="">{{ __('Responsible Email') }}</label>
                                    <p>{{ $atleta->responsible_email }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-9">
                                    <label for="">{{ __('Responsible Address') }}</label>
                                    <p>{{ $atleta->responsible_address }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label>E{{ __('Kinship') }}</label>
                                    <p>{{ $atleta->kinship }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label>{{ __('Responsible Covid19 Doses Number') }}</label>
                                    <p>{{ $atleta->responsible_doses_number }}</p>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-12">
                                    <label for="">{{ __('Responsible DPI Image') }}</label>
                                    <p>{{ $atleta->responsible_image }}</p>
                                    <img src="{{ asset('assets/uploads/responsible/'.$atleta->responsible_image) }}" alt="">
                                </div><!-- End .col-sm-6 -->

                            </div><!-- End .row -->


                        </div><!-- End .col-lg-9 -->

                    </div><!-- End .row -->



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
