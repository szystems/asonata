@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-warning shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">pool</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">{{ __('Athletes') }}</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <h4><u>{{ __('Athlete Information') }}</u></h4>
                    <div>
                        {{-- <form action="{{ url('pdf-athlete') }}" method="GET" target="_blank">
                            <input type="hidden" name="ratleta" value="{{ $atleta->id }}">
                            <button type="submit" class="btn btn-danger float-end">
                                <i class="material-icons opacity-10">picture_as_pdf</i> PDF
                            </button>
                        </form> --}}
                        <a href="{{ url('edit-athlete/'.$atleta->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                        <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $atleta->id }}">
                            <i class="material-icons">delete</i>
                        </button>
                        @include('admin.atleta.deletemodal')

                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Date of Birth') }}</strong></label>
                            @php
                                $fecha_nacimiento = date("d-m-Y", strtotime($atleta->birth));
                                $cumpleanos = new DateTime($atleta->birth);
                                $hoy = new DateTime();
                                $annos = $hoy->diff($cumpleanos);
                                $edad = $annos->y;
                            @endphp
                            <p>{{$fecha_nacimiento}} ({{ __('Age') }}: {{$edad }} {{ __('Years') }})</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Gender') }}</strong></label>
                            <p>{{ $atleta->gender == 0 ? __('Male') : __('Female') }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Name') }}</strong></label>
                            <p>{{ $atleta->name }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Athlete CUI') }}</strong></label>
                            <p>{{ $atleta->cui_dpi }}</p>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Covid19 Doses Number') }}</strong></label>
                            <p>{{ $atleta->doses_number }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Ethnic Group') }}</strong></label>
                            <p>{{ $atleta->ethnic_group }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Education Obtained') }}</strong></label>
                            <p>{{ $atleta->education_obtained }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Tshirt Size') }}</strong></label>
                            <p>{{ $atleta->tshirt_size }}</p>
                        </div>


                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Phone') }}</strong></label>
                            <p>{{ $atleta->phone }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Whatsapp') }}</strong></label>
                            <p>{{ $atleta->whatsapp }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>Email</strong></label>
                            <p>{{ $atleta->email }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('City') }}</strong></label>
                            <p>{{ $atleta->city }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('State') }}</strong></label>
                            <p>{{ $atleta->state }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Country') }}</strong></label>
                            <p>{{ $atleta->country }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for=""><strong>{{ __('Address') }} </strong></label>
                            <p>{{ $atleta->address }}</p>
                        </div>
                        @if ($atleta->image)
                            <div class="col-md-4 mb-3">
                                <label for=""><strong>{{ __('Image') }} </strong></label><br>
                                <img class="border-radius-md w-50 img-fluid" src="{{ asset('assets/uploads/athletes/' . $atleta->image) }}" alt="user Image">
                            </div>
                        @endif
                        @if ($atleta->vaccination_card)
                            <div class="col-md-4 mb-3">
                                <label for=""><strong>{{ __('Vaccination Card') }} </strong></label><br>
                                <a class="btn btn-danger" href="{{ asset('assets/uploads/vaccination/'.$atleta->vaccination_card) }}" target="blank"><i class="material-icons opacity-10">picture_as_pdf</i> {{ __('Download') }}</a>
                            </div>
                        @endif
                        @if ($atleta->birth_certificate)
                            <div class="col-md-4 mb-3">
                                <label for=""><strong>{{ __('Birth Certificate') }} </strong></label><br>
                                <a class="btn btn-danger" href="{{ asset('assets/uploads/certificate/'.$atleta->birth_certificate) }}" target="blank"><i class="material-icons opacity-10">picture_as_pdf</i> {{ __('Download') }}</a>
                            </div>
                        @endif
                        <div class="col-md-12 mb-3">
                            <h4><u>{{ __('Responsible Information') }}:</u></h4>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Responsible Name') }} </strong></label>
                            <p>{{ $atleta->responsible_name }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Responsible DPI') }} </strong></label>
                            <p>{{ $atleta->responsible_dpi }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Responsible Phone') }} </strong></label>
                            <p>{{ $atleta->responsible_phone }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Responsible Whatsapp') }} </strong></label>
                            <p>{{ $atleta->responsible_whatsapp }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Responsible Email') }} </strong></label>
                            <p>{{ $atleta->responsible_email }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Responsible Address') }} </strong></label>
                            <p>{{ $atleta->responsible_address }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Kinship') }} </strong></label>
                            <p>{{ $atleta->kinship }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Responsible Covid19 Doses Number') }} </strong></label>
                            <p>{{ $atleta->responsible_doses_number }}</p>
                        </div>
                        @if ($atleta->responsible_image)
                            <div class="col-md-4 mb-3">
                                <label for=""><strong>{{ __('Responsible DPI') }} </strong></label><br>
                                <a class="btn btn-danger" href="{{ asset('assets/uploads/responsible/'.$atleta->responsible_image) }}" target="blank"><i class="material-icons opacity-10">picture_as_pdf</i> {{ __('Download') }}</a>
                            </div>
                        @endif
                        @if ($atleta->signed_contract)
                            <div class="col-md-4 mb-3">
                                <label for=""><strong>{{ __('Signed Contract') }} </strong></label><br>
                                    <a class="btn btn-danger" href="{{ asset('assets/uploads/signedcontracts/'.$atleta->signed_contract) }}" target="blank"><i class="material-icons opacity-10">picture_as_pdf</i> {{ __('Download') }}</a>
                            </div>
                        @endif

                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> --}}
                    </div>
                </div>
            </div>

        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-warning shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">{{ __('Inscriptions') }}</h6>
                            </div>
                        </div>
                        <div class="card-body p-4 pt-5">

                            <div class="table-responsive">
                                <table class="table table-sm align-products-center mb-0 table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Date') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Inscription Number') }}</th>
                                            {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Athlete') }}</th> --}}
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Class') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Cycle') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Inscription Payment') }} / {{ __('Badge Payment') }} / {{ __('Monthly') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Assists') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Status') }}</th>
                                            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><i class="material-icons">format_list_bulleted</i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inscriptions as $inscription)
                                        <tr>
                                            @php
                                                $created_at = date("d-m-Y", strtotime($inscription->created_at));
                                                $atleta = \App\Models\Atleta::find($inscription->atleta_id);
                                                $class = \App\Models\Classs::find($inscription->class_id);
                                                $cycle = \App\Models\Cycle::find($inscription->cycle_id);
                                                $category = \App\Models\Category::find($class->category_id);

                                                //obtenemos las cabeceras de asistencias
                                                $asistenciasReales = \App\Models\Assist::where('class_id',$inscription->class_id)->get();
                                                //contamos el total de asistencias encontradas que nos da el numero maximo de asistencias
                                                $totalAsistencias = $asistenciasReales->count();

                                                //recorremos las asistencias reales para obtener el numero de asistencias del Atleta
                                                $asistencias = 0;
                                                foreach ($asistenciasReales as $asistencia) {
                                                    $attendances = \App\Models\Attendance::where('assist_id',$asistencia->id)->where('atleta_id',$inscription->atleta_id)->where('status',1)->get();
                                                    $asistencias = $asistencias + $attendances->count();
                                                }
                                                $ausencias = $totalAsistencias - $asistencias;
                                            @endphp
                                            <td class="align-middle text-center text-sm"><strong>{{ $created_at }}</strong></td>
                                            <td class="align-middle text-center text-sm"><strong><a href="{{ url('show-inscription/'.$inscription->id) }}">{{ $inscription->inscription_number }}</a></strong></td>
                                            {{-- <td>
                                                <div class="d-flex px-2 py-1">
                                                    @if ($atleta->image)
                                                        <div>
                                                            <img src="{{ asset('assets/uploads/athletes/'.$atleta->image) }}" class="avatar avatar-sm me-3">
                                                        </div>
                                                    @endif
                                                  <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-xs"><a href="{{ url('show-athlete/'.$atleta->id) }}">{{ $atleta->name }}</a></h6>
                                                    <p class="text-xs text-secondary mb-0">CUI:{{ $atleta->cui_dpi }} - {{ __('Phone') }}/Whatsapp:{{ $atleta->phone }}/{{ $atleta->whatsapp }} - Email:{{ $atleta->email }}</p>
                                                  </div>
                                                </div>
                                            </td> --}}
                                            <td class="align-middle text-center text-sm"><strong>{{ $category->name }}</strong></td>
                                            <td class="align-middle text-center text-sm"><strong>{{ $cycle->name }}</strong></td>
                                            <td class="align-middle text-center text-sm">
                                                @php
                                                    $inscriptionPayments=DB::table('payments')
                                                    ->where('inscription_id',$inscription->id)
                                                    ->where('type','>=',2)
                                                    ->get();
                                                @endphp
                                                @if($inscription->inscription_payment == 0)<span class="badge bg-warning text-dark">{{ $inscription->inscription_payment == 0 ? __('Pending') : '' }}</span>@endif @if($inscription->inscription_payment == 1)<span class="badge bg-success text-dark">{{ $inscription->inscription_payment == 1 ? __('Paid') : '' }}</span>@endif /
                                                @if($inscription->badge_payment == 0)<span class="badge bg-warning text-dark">{{ $inscription->badge_payment == 0 ? __('Pending') : '' }}</span>@endif @if($inscription->badge_payment == 1)<span class="badge bg-success text-dark">{{ $inscription->badge_payment == 1 ? __('Paid') : '' }}</span>@endif /
                                                {{ $config->currency_simbol }}{{ number_format($class->monthly_payment,2, '.', ',') }} @if ($inscription->payments != null) <b>({{ $inscriptionPayments->count() }}/{{ $inscription->payments }})</b>@endif
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $asistencias }} / {{ $totalAsistencias }}
                                            </td>
                                            <td class="align-middle text-center text-sm"><strong>
                                                <span class="badge badge-sm bg-gradient-{{
                                                $inscription->inscription_status == '0' ? 'warning'
                                                : ($inscription->inscription_status == '1' ? 'success'
                                                : ($inscription->inscription_status == '2' ? 'danger'
                                                : ($inscription->inscription_status == '3' ? 'dark'
                                                : ($inscription->inscription_status == '4' ? 'secondary'
                                                : ($inscription->inscription_status == '5' ? 'info' : ""
                                                ))))) }}">
                                                    {{ $inscription->inscription_status == '0' ? __('Pending')
                                                    : ($inscription->inscription_status == '1' ? __('Confirmed')
                                                    : ($inscription->inscription_status == '2' ? __('Rejected')
                                                    : ($inscription->inscription_status == '3' ? __('Expelled')
                                                    : ($inscription->inscription_status == '4' ? __('Retired')
                                                    : ($inscription->inscription_status == '5' ? __('Promoted') : ""
                                                    ))))) }}
                                                </span>
                                            </strong></td>
                                            <td class="align-middle  text-sm">
                                                <a href="{{ url('show-inscription/'.$inscription->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                                                {{-- <a href="{{ url('edit-inscription/'.$inscription->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $inscription->id }}">
                                                    <i class="material-icons">delete</i>
                                                </button> --}}

                                            </td>
                                        </tr>
                                        @include('admin.inscription.deletemodal')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if ($inscriptions->count() == 0)
                                <div class="card-header p-4 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="alert alert-primary text-white" role="alert">
                                        <strong>{{ __('No Classes added or found!') }}</strong> <a href="{{ url('add-class') }}"> {{ __('Add Class') }}</a>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
