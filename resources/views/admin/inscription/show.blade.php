@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-warning shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">inventory</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">{{ __('Inscriptions') }}</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <h4><u>{{ __('Show') }} {{ __('Inscription') }}</u></h4>
                    <div>
                        <form action="{{ url('pdf-inscription') }}" method="GET" target="_blank">
                            <input type="hidden" name="ratleta" value="{{ $atleta->id }}">
                            <input type="hidden" name="ridclass" value="{{ $class->id }}">
                            <input type="hidden" name="ridinscription" value="{{ $inscription->id }}">
                            <button type="submit" class="btn btn-danger float-end">
                                <i class="material-icons opacity-10">picture_as_pdf</i> PDF
                            </button>
                        </form>
                        <a href="{{ url('edit-inscription/'.$inscription->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                        @if ($inscription->principal == "1")
                            <button disabled type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $inscription->id }}">
                                <i class="material-icons">delete</i>
                            </button>
                        @else
                            <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $inscription->id }}">
                                <i class="material-icons">delete</i>
                            </button>
                        @endif
                        @include('admin.inscription.deletemodal')

                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h4>{{ __('Inscription Information') }}</h4>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>{{ __('Inscription Date') }} </label>
                            @php
                                $fecha_inscripcion = date("d-m-Y", strtotime($inscription->created_at));
                            @endphp
                            <p>{{ $fecha_inscripcion }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>{{ __('Last Update') }} </label>
                            @php
                                $fecha_act = date("d-m-Y", strtotime($inscription->updated_at));
                            @endphp
                            <p>{{ $fecha_act }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>{{ __('Inscription Number') }} </label>
                            <p>{{ $inscription->inscription_number }}</p>
                        </div>
                        @php
                            $asistenciasReales = \App\Models\Assist::where('class_id',$inscription->class_id)->get();
                            //contamos el total de asistencias encontradas que nos da el numero maximo de asistencias
                            $totalAsistencias = $asistenciasReales->count();

                            //recorremos las asistencias reales para obtener el numero de asistencias del Atleta
                            $asistencias = 0;
                            foreach ($asistenciasReales as $asistencia) {
                                $attendances = \App\Models\Attendance::where('assist_id',$asistencia->id)->where('atleta_id',$inscription->atleta_id)->where('status',1)->get();
                                $asistencias = $asistencias + $attendances->count();
                            }
                        @endphp
                        <div class="col-md-3 mb-3">
                            <label>{{ __('Assists') }} </label>
                            <p>{{ $asistencias }} / {{ $totalAsistencias }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>{{ __('Status') }} </label>
                            <p>
                                @if($inscription->inscription_status == 0)<span class="badge bg-warning text-dark">{{ $inscription->inscription_status == 0 ? __('Pending') : '' }}</span>@endif
                                @if($inscription->inscription_status == 1)<span class="badge bg-success text-dark">{{ $inscription->inscription_status == 1 ? __('Confirmed') : '' }}</span>@endif
                                @if($inscription->inscription_status == 2)<span class="badge bg-danger text-dark">{{ $inscription->inscription_status == 2 ? __('Rejected') : '' }}</span>@endif
                                @if($inscription->inscription_status == 3)<span class="badge bg-dark text-white">{{ $inscription->inscription_status == 3 ? __('Expelled') : '' }}</span>@endif
                                @if($inscription->inscription_status == 4)<span class="badge bg-secondary text-white">{{ $inscription->inscription_status == 4 ? __('Retired') : '' }}</span>@endif
                                @if($inscription->inscription_status == 5)<span class="badge bg-info text-white">{{ $inscription->inscription_status == 5 ? __('Promoted') : '' }}</span>@endif
                            </p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>{{ __('Inscription Payment') }} </label>
                            <p>@if($inscription->inscription_payment == 0)<span class="badge bg-warning text-dark">{{ $inscription->inscription_payment == 0 ? __('Pending') : '' }}</span>@endif @if($inscription->inscription_payment == 1)<span class="badge bg-success text-dark">{{ $inscription->inscription_payment == 1 ? __('Paid') : '' }}</span>@endif </p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>{{ __('Badge Payment') }} </label>
                            <p>@if($inscription->badge_payment == 0)<span class="badge bg-warning text-dark">{{ $inscription->badge_payment == 0 ? __('Pending') : '' }}</span>@endif @if($inscription->badge_payment == 1)<span class="badge bg-success text-dark">{{ $inscription->badge_payment == 1 ? __('Paid') : '' }}</span>@endif </p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>{{ __('Monthly Payment') }} @if ($inscription->payments != null)/ {{ __('Payments') }}@endif</label>
                            @php
                                $inscriptionPayments=DB::table('payments')
                                ->where('inscription_id',$inscription->id)
                                ->where('type','>=',2)
                                ->get();
                            @endphp
                            <p>{{ $config->currency_simbol }}{{ number_format($class->CLmonthly_payment,2, '.', ',') }} @if ($inscription->payments != null) <b>({{ $inscriptionPayments->count() }}/{{ $inscription->payments }})</b>@endif</p>
                            @if ($inscription->payments != null)
                                @if (($inscriptionPayments->count() < $inscription->payments))
                                    <button type="button" class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#paymentModal-{{ $inscription->id }}">
                                        <i class="material-icons">payments</i> {{ __('Make Payment') }}
                                    </button>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>{{ __('Notes') }} </label>
                            <textarea readonly type="text" class="form-control border px-2 " rows="5" name="payments_description">{{  $inscription->notes  }}</textarea>
                        </div>

                    </div>
                    {{-- <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p>
                    </div> --}}
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
                            <h6 class="text-white text-capitalize ps-3">{{ __('Class') }}</h6>
                        </div>
                    </div>
                    <div class="card-body p-4 pt-5">
                            <div class="col-md-12 mb-3">
                                <a href="{{ url('show-class/'.$class->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                                <a href="{{ url('edit-class/' . $class->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                {{-- <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteClassModal-{{ $class->id }}">
                                    <i class="material-icons">delete</i>
                                </button> --}}
                        </div>
                        @if (count($errors)>0)
                            <div class="alert alert-danger text-white" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                          <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>

                        @endif
                        <div class="row">

                            <div class="col-md-3 mb-3">
                                @php
                                    $categoryClass = \App\Models\Category::find($class->CLcategory_id);
                                @endphp
                                <label for="">{{ __('Category') }}</label>
                                <p>{{ $categoryClass->name }} ({{ $categoryClass->age_from }}-{{ $categoryClass->age_to }} {{ __('Years') }} / {{ $class->CYid }})</p>
                            </div>

                            <div class="col-md-5 mb-3">
                                @php
                                    $scheduleClass = \App\Models\Schedule::find($class->CLschedule_id);

                                    $facilityName = \App\Models\Facility::find($scheduleClass->facility_id);

                                    $start_timeClass = date('H:i A', strtotime($scheduleClass->start_time));
                                    $end_timeClass = date('H:i A', strtotime($scheduleClass->end_time));
                                @endphp
                                <label for="">{{ __('Schedule') }}</label>
                                <p><i class="far fa-clock"></i> {{ $facilityName->name }} / {{ $start_timeClass }} - {{ $end_timeClass }} / {{ $scheduleClass->sunday == 1 ? __('Sunday').',' : '' }} {{ $scheduleClass->monday == 1 ? __('Monday').',' : '' }} {{ $scheduleClass->tuesday == 1 ? __('Tuesday').',' : '' }} {{ $scheduleClass->wednesday == 1 ? __('Wednesday').',' : '' }} {{ $scheduleClass->thursday == 1 ? __('Thursday').',' : '' }} {{ $scheduleClass->friday == 1 ? __('Friday').',' : '' }} {{ $scheduleClass->saturday == 1 ? __('Saturday').',' : '' }}</p>
                            </div>

                            <div class="col-md-2 mb-3">
                                @php
                                    $instructorClass = \App\Models\User::find($class->CLinstructor_id);
                                @endphp
                                <label for="">{{ __('Instructor') }}</label>
                                <p>{{ $instructorClass->name }}</p>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="">{{ __('Quota') }}</label>
                                @php
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
                                @endphp
                                <p>{{ $disponibles }}</p>
                            </div>

                            <div class="col-md-3 mb-3">
                                @php
                                    $start_dateClass = date("d-m-Y", strtotime($class->CLstart_date));
                                @endphp
                                <label for="">{{ __('Start Date') }} </label>
                                <p><i class="fa fa-calendar"></i><font color="limegreen"> {{ $start_dateClass }}</font></p>
                            </div>

                            <div class="col-md-3 mb-3">
                                @php
                                    $end_dateClass = date("d-m-Y", strtotime($class->CLend_date));
                                @endphp
                                <label for="">{{ __('End Date') }} </label>
                                <p><i class="fa fa-calendar"></i><font color="red"> {{ $end_dateClass }}</font></p>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="">{{ __('Inscription') }} </label>
                                <p>{{ $config->currency_simbol }}{{ number_format($class->CLinscription_payment,2, '.', ',') }}</p>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="">{{ __('Badge') }} </label>
                                <p>{{ $config->currency_simbol }}{{ number_format($class->CLbadge,2, '.', ',') }}</p>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="">{{ __('Monthly Payment') }} </label>
                                <p>{{ $config->currency_simbol }}{{ number_format($class->CLmonthly_payment,2, '.', ',') }}</p>
                            </div>

                            @if ($class->CLnotes)
                            <div class="col-md-12 mb-3">
                                <label for="">{{ __('Notes') }} </label>
                                <textarea readonly class="form-control border px-2" rows="5">{{ $class->CLnotes }}</textarea>
                            </div>
                            @endif

                        </div>
                    </div>
                    {{-- <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p>
                    </div> --}}
                </div>
            </div>
        </div>

        @include('admin.class.deletemodalclass')
    </div>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-warning shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">{{ __('Assists') }}</h6>
                        </div>
                    </div>
                    <div class="card-body p-4 pt-5">

                        <div class="table-responsive">
                            <table class="table table-sm align-products-center mb-0 table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Date') }}</th>
                                        <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Athlete') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Class') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-15 ps-2">{{__('Assist')}}</th>
                                        <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><i class="material-icons">format_list_bulleted</i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assists as $assist)
                                    @php
                                        $attendances = \App\Models\Attendance::where('assist_id',$assist->id)->where('atleta_id',$atleta->id)->get();
                                    @endphp
                                        @foreach ($attendances as $attendance)
                                            @php
                                                $assistinfo = \App\Models\Assist::find($attendance->assist_id);
                                                $atletainfo = \App\Models\Atleta::find($attendance->atleta_id);
                                                $classinfo = \App\Models\Classs::find($assistinfo->class_id);
                                                $categoryinfo = \App\Models\Category::find($classinfo->category_id);
                                                $cycleinfo = \App\Models\Cycle::find($classinfo->cycle_id);
                                            @endphp


                                            <tr>
                                                <td class="align-middle text-center text-sm"><strong>{{ $attendance->created_at->format('d-m-Y') }}</strong></td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        @if ($attendance->atleta->image)
                                                        <div>
                                                            <img src="{{ asset('assets/uploads/athletes/'.$attendance->atleta->image) }}" class="avatar avatar-sm me-3">
                                                        </div>
                                                    @endif
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-xs"><a href="{{ url('show-athlete/'.$attendance->atleta_id) }}">{{ $attendance->atleta->name }} </a></h6>
                                                        <p class="text-xs text-secondary mb-0">CUI: {{ $attendance->atleta->cui_dpi }}</p>
                                                        <p class="text-xs text-secondary mb-0">{{ $attendance->atleta->email }}</p>
                                                        <p class="text-xs text-secondary mb-0">{{ $attendance->atleta->phone }} / {{ $attendance->atleta->whatsapp }}</p>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                            <h6 class="mb-0 text-xs"><a href="{{ url('show-class/'.$attendance->assist->class_id) }}">{{ $categoryinfo->name }} ({{ $categoryinfo->group->name }})</a></h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $cycleinfo->name }}</p>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="badge badge-sm bg-gradient-{{ $attendance->status == 0 ? 'danger':'success' }}">
                                                        @if ($attendance->status == 0)
                                                            <i class="fas fa-ban text-white" aria-hidden="true"></i>
                                                        @else
                                                        <i class="	far fa-check-square text-white" aria-hidden="true"></i>
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="align-middle  text-sm">
                                                    <a href="{{ url('show-assist/'.$attendance->assist_id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>

                                                </td>
                                            </tr>
                                        @endforeach
                                        {{-- @include('admin.atleta.deletemodal') --}}
                                    @endforeach
                                </tbody>
                                {{-- <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="align-middle text-rigth text-sm"><h4><b>Total:</b></h4></td>
                                        <td class="align-middle text-center text-sm"><h4><b><font color="limegreen">{{ $config->currency_simbol }}{{ number_format($total,2, '.', ',') }}</font></b></h4></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot> --}}
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @include('admin.class.deletemodalclass')
    </div>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-warning shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">{{ __('Payments') }}</h6>
                        </div>
                    </div>
                    <div class="card-body p-4 pt-5">

                        <div class="table-responsive">
                            <table class="table table-sm align-products-center mb-0 table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Payment') }} #</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Date') }}</th>
                                        <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Athlete') }}</th>
                                        {{-- <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Inscription Number') }}</th> --}}
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Payment Type') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Paid') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('User') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Date') }}</th>
                                        {{-- <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><i class="material-icons">format_list_bulleted</i></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                    <tr>
                                        <td class="align-middle text-center text-sm"><strong>{{ $payment->id }}</strong></td>
                                        <td class="align-middle text-center text-sm"><strong>{{ $payment->created_at->format('d-m-Y') }}</strong></td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                @if ($payment->inscription->atleta->image)
                                                <div>
                                                    <img src="{{ asset('assets/uploads/athletes/'.$payment->inscription->atleta->image) }}" class="avatar avatar-sm me-3">
                                                </div>
                                            @endif
                                              <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs"><a href="{{ url('show-athlete/'.$payment->inscription->atleta->id) }}">{{ $payment->inscription->atleta->name }} </a></h6>
                                                <p class="text-xs text-secondary mb-0">CUI: {{ $payment->inscription->atleta->cui_dpi }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $payment->inscription->atleta->email }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $payment->inscription->atleta->phone }} / {{ $payment->inscription->atleta->whatsapp }}</p>
                                              </div>
                                            </div>
                                        </td>
                                        @php
                                            $classinfo = \App\Models\Classs::find($payment->inscription->class_id);
                                            $categoryinfo = \App\Models\Category::find($classinfo->category_id);
                                            $userinfo = \App\Models\User::find($payment->user_id);
                                        @endphp
                                        {{-- <td class="align-middle text-center text-sm">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-xs"><a href="{{ url('show-inscription/'.$payment->inscription_id) }}">{{ $payment->inscription->inscription_number }} </a></h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $payment->inscription->cycle->name }}</p>

                                                    <p class="text-xs text-secondary mb-0">{{ $categoryinfo->name }} ({{ $categoryinfo->group->name }})</p>
                                                </div>
                                            </div>
                                        </td> --}}
                                        <td class="align-middle text-center text-sm">
                                            <strong>
                                            {{ $payment->type == '0' ? __('Inscription')
                                                : ($payment->type == '1' ? __('Badge')
                                                : ($payment->type == '2' ? __('Monthly')
                                                : ($payment->type == '3' ? __('Exoneration')
                                                : "")))
                                            }}

                                            </strong>
                                            @if ($payment->note != null)
                                                <br>
                                                ({{ $payment->note }})
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm"><strong>{{ $config->currency_simbol }}{{ number_format($payment->paid,2, '.', ',') }}</strong></td>
                                        <td class="align-middle text-center text-sm"><strong>{{ $userinfo->name }}</strong><br>
                                            ({{ $userinfo->role_as == '1' ? __('Admin')
                                            : ($userinfo->role_as == '0' ? __('User')
                                            : ($userinfo->role_as == '3' ? __('Instructor')
                                            : "")) }})
                                        </td>

                                        <td class="align-middle  text-sm">
                                            <a href="{{ url('show-payment/'.$payment->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                                            {{-- <a href="{{ url('edit-athlete/'.$payment->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                            <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $payment->id }}">
                                                <i class="material-icons">delete</i>
                                            </button> --}}

                                        </td>
                                    </tr>
                                    {{-- @include('admin.atleta.deletemodal') --}}
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="align-middle text-rigth text-sm"><h6><b>{{ __('Payments') }}:</b></h6></td>
                                        <td class="align-middle text-center text-sm"><h6><b><font color="limegreen">{{ $config->currency_simbol }}{{ number_format($subtotal,2, '.', ',') }}</font></b></h6></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="align-middle text-rigth text-sm"><h6><b>{{ __('Exonerations') }}:</b></h6></td>
                                        <td class="align-middle text-center text-sm"><h6><b><font color="orange">{{ $config->currency_simbol }}{{ number_format($exonerations,2, '.', ',') }}</font></b></h6></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="align-middle text-rigth text-sm"><h4><b>{{ __('Total') }}:</b></h4></td>
                                        <td class="align-middle text-center text-sm"><h4><b><font color="blue">{{ $config->currency_simbol }}{{ number_format($total,2, '.', ',') }}</font></b></h4></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @include('admin.class.deletemodalclass')
    </div>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-warning shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">{{ __('Athlete Information') }}</h6>
                        </div>
                    </div>
                    <div class="card-body p-4 pt-5">
                        <div>
                            {{-- <form action="{{ url('pdf-athlete') }}" method="GET" target="_blank">
                                <input type="hidden" name="ratleta" value="{{ $atleta->id }}">
                                <button type="submit" class="btn btn-danger float-end">
                                    <i class="material-icons opacity-10">picture_as_pdf</i> PDF
                                </button>
                            </form> --}}
                            <a href="{{ url('show-athlete/'.$atleta->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                            <a href="{{ url('edit-athlete/'.$atleta->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                            {{-- <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $atleta->id }}">
                                <i class="material-icons">delete</i>
                            </button> --}}
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
                                    <label for=""><strong>{{ __('Vaccination Card') }}, {{ __('DPI') }} </strong></label><br>
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
                                <h4><u>{{ __('Responsible Information') }}</u></h4>
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
                        {{-- <hr class="dark horizontal my-0"> --}}
                    </div>
                    {{-- <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p>
                    </div> --}}
                </div>
            </div>
        </div>

        @include('admin.class.deletemodalclass')
        @include('admin.payment.paymentmodal')
    </div>
    @endsection
