@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-warning shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">groups</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">{{ __('Classes') }}</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <h4><u>{{ __('Cycle') }}:</u> {{ $cycle->name }}</h4>
                    <div>
                        <a href="{{ url('edit-cycle/' . $cycle->id) }}" type="button" class="btn btn-warning"><i
                                class="material-icons">edit</i></a>
                        <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal-{{ $cycle->id }}">
                            <i class="material-icons">delete</i>
                        </button>
                        @include('admin.cycle.deletemodal')

                    </div>
                    <div class="row">
                        {{-- <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Name') }}</strong></label>
                            <p>{{ $cycle->name }}</p>
                        </div> --}}
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Start Date') }}</strong></label>
                            @php
                                $start_date = date('d-m-Y', strtotime($cycle->start_date));
                            @endphp
                            <p>
                                <font color="limegreen">{{ $start_date }}</font>
                            </p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('End Date') }}</strong></label>
                            @php
                                $end_date = date('d-m-Y', strtotime($cycle->end_date));
                            @endphp
                            <p>
                                <font color="red">{{ $end_date }}</font>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for=""><strong>{{ __('Description') }}</strong></label>
                            <p>{{ $cycle->description }}</p>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> --}}
                    </div>
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
                        <div class="card-header p-4 position-relative mt-n4 mx-3 z-index-2">
                            <div class="col-md-12 mb-3">
                                <a href="{{ url('edit-class/' . $class->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteClassModal-{{ $class->id }}">
                                    <i class="material-icons">delete</i>
                                </button>


                            </div>
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
                                    $categoryClass = \App\Models\Category::find($class->category_id);
                                @endphp
                                <label for="">{{ __('Category') }}</label>
                                <p>{{ $categoryClass->name }}</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                @php
                                    $scheduleClass = \App\Models\Schedule::find($class->schedule_id);

                                    $facilityName = \App\Models\Facility::find($scheduleClass->facility_id);

                                    $start_timeClass = date('h:i A', strtotime($scheduleClass->start_time));
                                    $end_timeClass = date('h:i A', strtotime($scheduleClass->end_time));
                                @endphp
                                <label for="">{{ __('Schedule') }}</label>
                                <p><i class="far fa-clock"></i> {{ $facilityName->name }} / {{ $start_timeClass }} - {{ $end_timeClass }} / {{ $scheduleClass->sunday == 1 ? __('Sunday').',' : '' }} {{ $scheduleClass->monday == 1 ? __('Monday').',' : '' }} {{ $scheduleClass->tuesday == 1 ? __('Tuesday').',' : '' }} {{ $scheduleClass->wednesday == 1 ? __('Wednesday').',' : '' }} {{ $scheduleClass->thursday == 1 ? __('Thursday').',' : '' }} {{ $scheduleClass->friday == 1 ? __('Friday').',' : '' }} {{ $scheduleClass->saturday == 1 ? __('Saturday').',' : '' }}</p>
                            </div>

                            <div class="col-md-3 mb-3">
                                @php
                                    $instructorClass = \App\Models\User::find($class->instructor_id);
                                @endphp
                                <label for="">{{ __('Instructor') }}</label>
                                <p>{{ $instructorClass->name }}</p>
                            </div>

                            <div class="col-md-3 mb-3">
                                @php
                                    $start_dateClass = date("d-m-Y", strtotime($class->start_date));
                                @endphp
                                <label for="">{{ __('Start Date') }} </label>
                                <p><i class="fa fa-calendar"></i><font color="limegreen"> {{ $start_dateClass }}</font></p>
                            </div>

                            <div class="col-md-3 mb-3">
                                @php
                                    $end_dateClass = date("d-m-Y", strtotime($class->end_date));
                                @endphp
                                <label for="">{{ __('End Date') }} </label>
                                <p><i class="fa fa-calendar"></i><font color="red"> {{ $end_dateClass }}</font></p>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="">{{ __('Inscription') }} </label>
                                <p>{{ $config->currency_simbol }}{{ number_format($class->inscription_payment,2, '.', ',') }}</p>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="">{{ __('Badge') }} </label>
                                <p>{{ $config->currency_simbol }}{{ number_format($class->badge,2, '.', ',') }}</p>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="">{{ __('Monthly Payment') }} </label>
                                <p>{{ $config->currency_simbol }}{{ number_format($class->monthly_payment,2, '.', ',') }}</p>
                            </div>

                            @if ($class->notes)
                            <div class="col-md-12 mb-3">
                                <label for="">{{ __('Costs') }} </label>
                                <textarea readonly class="form-control border px-2" rows="5">{{ $class->notes }}</textarea>
                            </div>
                            @endif

                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> --}}
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
                            <h6 class="text-white text-capitalize ps-3">{{ __('Athletes') }} ({{ $inscritos->count() }})</h6>
                        </div>
                    </div>
                    <div class="card-body p-4 pt-5">

                        <div class="table-responsive p-4">
                            <table class="table table-sm align-products-center mb-0 table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Athlete') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Responsible') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Inscription Status') }}</th>
                                        <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><i class="material-icons">format_list_bulleted</i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $talla = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
                                        //21 = XL
                                        //20 = L
                                        //19 = M
                                        //18 = S
                                    @endphp
                                    @foreach ($inscritos as $inscrito)
                                    @php
                                        $atleta = \App\Models\Atleta::find($inscrito->atleta_id);

                                        for ($i=0; $i <= 16 ; $i++) {
                                            if($atleta->tshirt_size == $i)
                                            {
                                                $talla[$i]++;
                                            }

                                        }
                                        if ($atleta->tshirt_size == "XL") {
                                                $talla[20]++;
                                        }
                                        if ($atleta->tshirt_size == "L") {
                                            $talla[19]++;
                                        }

                                        if ($atleta->tshirt_size == "M") {
                                            $talla[18]++;
                                        }
                                        if ($atleta->tshirt_size == "S") {
                                            $talla[17]++;
                                        }
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                @if ($atleta->image)
                                                <div>
                                                    <img src="{{ asset('assets/uploads/athletes/'.$atleta->image) }}" class="avatar avatar-sm me-3">
                                                </div>
                                            @endif
                                              <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs"><a href="{{ url('show-athlete/'.$atleta->id) }}">{{ $atleta->name }} </a> </h6>
                                                <p class="text-xs text-secondary mb-0">CUI: {{ $atleta->cui_dpi }}</p>
                                                <p class="text-xs text-secondary mb-0"><i class="fa fa-envelope-o me-1" aria-hidden="true"></i>{{ $atleta->email }}</p>
                                                <p class="text-xs text-secondary mb-0"><i class="fa fa-phone me-1" aria-hidden="true"></i>{{ $atleta->phone }} @if ($atleta->whatsapp != null) / <i class="fab fa-whatsapp me-1" aria-hidden="true"></i> {{ $atleta->whatsapp }} @endif</p>
                                                <p class="text-xs text-secondary mb-0"><i class="fas fa-tshirt me-1" aria-hidden="true"></i>{{ $atleta->tshirt_size }}</p>
                                              </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                              <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs">{{ $atleta->responsible_name }}</h6>
                                                <p class="text-xs text-secondary mb-0">CUI: {{ $atleta->responsible_dpi }}</p>
                                                <p class="text-xs text-secondary mb-0"><i class="fa fa-envelope-o me-1" aria-hidden="true"></i>{{ $atleta->responsible_email }}</p>
                                                <p class="text-xs text-secondary mb-0"><i class="fa fa-phone me-1" aria-hidden="true"></i>{{ $atleta->responsible_phone }} @if ($atleta->responsible_whatsapp != null) / <i class="fab fa-whatsapp me-1" aria-hidden="true"></i> {{ $atleta->whatsapp }} @endif</p>
                                              </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <a href="{{ url('show-inscription/'.$inscrito->id) }}">
                                                <span class="badge badge-sm bg-gradient-{{
                                                    $inscrito->inscription_status == '0' ? 'warning'
                                                    : ($inscrito->inscription_status == '1' ? 'success'
                                                    : ($inscrito->inscription_status == '2' ? 'danger'
                                                    : ($inscrito->inscription_status == '3' ? 'dark'
                                                    : ($inscrito->inscription_status == '4' ? 'secondary'
                                                    : ($inscrito->inscription_status == '5' ? 'info' : ""
                                                    ))))) }}">
                                                    {{ $inscrito->inscription_status == '0' ? __('Pending')
                                                    : ($inscrito->inscription_status == '1' ? __('Confirmed')
                                                    : ($inscrito->inscription_status == '2' ? __('Rejected')
                                                    : ($inscrito->inscription_status == '3' ? __('Expelled')
                                                    : ($inscrito->inscription_status == '4' ? __('Retired')
                                                    : ($inscrito->inscription_status == '5' ? __('Promoted') : ""
                                                    ))))) }}
                                                </span>
                                                <p class="text-xs text-secondary mb-0">{{ $inscrito->inscription_number }}</p>
                                            </a>
                                        </td>
                                        <td class="align-middle  text-sm">
                                            <a href="{{ url('show-athlete/'.$atleta->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                                            {{-- <a href="{{ url('edit-athlete/'.$atleta->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a> --}}
                                            {{-- <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $atleta->id }}">
                                                <i class="material-icons">delete</i>
                                            </button> --}}

                                        </td>
                                    </tr>
                                    @include('admin.atleta.deletemodal')
                                    @endforeach
                                </tbody>
                            </table>


                            <div class="card-body p-4 pt-5">
                                <h6 class=" text-capitalize">Total de Tallas:</h6>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        @if ($talla[17] != 0)
                                            <p class="text-xs text-secondary mb-0"><b>Talla S:</b>&nbsp;&nbsp;{{$talla[17]}}</p>
                                        @endif
                                        @if ($talla[18] != 0)
                                            <p class="text-xs text-secondary mb-0"><b>Talla M:</b>&nbsp;&nbsp;{{$talla[18]}}</p>
                                        @endif
                                        @if ($talla[19] != 0)
                                            <p class="text-xs text-secondary mb-0"><b>Talla L:</b>&nbsp;&nbsp;{{$talla[19]}}</p>
                                        @endif
                                        @if ($talla[20] != 0)
                                            <p class="text-xs text-secondary mb-0"><b>Talla XL:</b>&nbsp;&nbsp;{{$talla[20]}}</p>
                                        @endif
                                        @for ($i = 1; $i <= 16; $i++)
                                            @if ($talla[$i] != 0)
                                                <p class="text-xs text-secondary mb-0"><b>Talla {{$i}}:</b>&nbsp;&nbsp;{{$talla[$i]}}</p>
                                            @endif
                                        @endfor


                                    </div>
                                </div>

                            </div>


                        </div>
                        @if ($inscritos->count() == 0)
                            <div class="card-header p-4 position-relative mt-n4 mx-3 z-index-2">
                                <div class="alert alert-primary text-white" role="alert">
                                    <strong>{{ __('No athletes added or found!') }}</strong>
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
                        @php
                            $hoy = date('m-d-Y');
                        @endphp

                            @php
                                use Carbon\Carbon;
                                $fechaRepetida = \App\Models\Assist::where('class_id',$class->id)->whereDate('created_at', Carbon::today())->count();
                                $entreFechas = \App\Models\Classs::where('id', $class->id)
                                ->whereDate('start_date', '<=', date("Y-m-d"))
                                ->whereDate('end_date', '>=', date("Y-m-d"))
                                ->count();
                            @endphp
                            @if ($inscritos->count() > 0)
                                @if ($fechaRepetida != 1)
                                    @if ($entreFechas == 1)
                                        <div class="card-header p-4 position-relative mt-n4 mx-3 z-index-2">
                                            <div class="col-md-12 mb-3">
                                                <a href="{{ url('add-assist/'.$class->id) }}" class="btn btn-success">
                                                    <i class="material-icons opacity-10">add</i> {{ __('Pass Assistance') }}
                                                </a>

                                            </div>
                                        </div>
                                    @elseif($entreFechas == 0)
                                        <div class="card-header p-4 position-relative mt-n4 mx-3 z-index-2">
                                            <div class="col-md-12 mb-3">
                                                <div class="alert alert-primary text-white" role="alert">
                                                    <strong>{{ __('The current date is not contained in the Start and End date range of the class so attendance cannot be passed') }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @elseif($fechaRepetida == 1)
                                    <div class="card-header p-4 position-relative mt-n4 mx-3 z-index-2">
                                        <div class="col-md-12 mb-3">
                                            <div class="alert alert-primary text-white" role="alert">
                                                <strong>{{ __('There is already an attendance record for today so you can not pass attendance, if you want you can edit the record') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="card-header p-4 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="col-md-12 mb-3">
                                        <div class="alert alert-primary text-white" role="alert">
                                            <strong>{{ __('There are no students enrolled in this class so you can not pass attendance') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        {{-- Repetido: {{ $fechaRepetida }}, esta entre fechas: {{ $entreFechas }} --}}
                        <div class="table-responsive p-4">
                            <table class="table table-sm align-products-center mb-0 table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Date') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Notes') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Presents') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Not Presents') }}</th>
                                        <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><i class="material-icons">format_list_bulleted</i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assists as $assist)
                                        @php
                                            $fechaAsistencia = date("d-m-Y", strtotime($assist->created_at));
                                            $presentes = DB::table('attendances')
                                            ->where('assist_id',$assist->id)
                                            ->where('status',1)
                                            ->count();

                                            $noPresentes = DB::table('attendances')
                                            ->where('assist_id',$assist->id)
                                            ->where('status',0)
                                            ->count();

                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="align-middle text-center text-sm">
                                                    <br>
                                                    {{ $fechaAsistencia }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="align-middle text-center text-sm">
                                                    @if ($assist->notes != null)
                                                    <textarea class="form-control border px-2" name="notes" rows="2">{{ $assist->notes }}</textarea>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-success">
                                                    {{  $presentes }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-danger">
                                                    {{  $noPresentes }}
                                                </span>
                                            </td>
                                            <td class="align-middle  text-sm">
                                                <a href="{{ url('show-assist/'.$assist->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                                                <a href="{{ url('edit-assist/'.$assist->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteAssistModal-{{ $assist->id }}">
                                                    <i class="material-icons">delete</i>
                                                </button>

                                            </td>
                                        </tr>
                                        @include('admin.class.deleteassistmodal')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($assists->count() == 0)
                            <div class="card-header p-4 position-relative mt-n4 mx-3 z-index-2">
                                <div class="alert alert-primary text-white" role="alert">
                                    <strong>{{ __('No Assists added or found!') }}</strong>
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
