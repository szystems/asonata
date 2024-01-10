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
                            <h6 class="text-white text-capitalize ps-3">{{ __('Classes List') }}</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-3 pt-5">
                        <div class="card-header p-4 position-relative mt-n4 mx-3 z-index-2">
                            <div class="col-md-12 mb-3">
                                <a href="{{ url('add-class/'.$cycle->id) }}" class="btn btn-success">
                                    <i class="material-icons opacity-10">add</i> {{ __('Add Class') }}
                                </a>

                            </div>
                        </div>

                        <div class="table-responsive p-4">
                            @include('admin.class.searchclass')
                            <table class="table align-items-center mb-0">
                                <thead>

                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Class') }}</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Facility') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Schedule') }}</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Instructor') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Status') }}</th>
                                        <th class="text-secondary opacity-7"><i class="material-icons">format_list_bulleted</i></th>
                                    </tr>

                                </thead>

                                @foreach ($classes as $class)
                                    <tbody>
                                        <tr>
                                            @php
                                                $start_time = date('H:i A', strtotime($class->Sstart_time));
                                                $end_time = date('H:i A', strtotime($class->Send_time));

                                                $start_date = date('d-m-Y', strtotime($class->CLstart_date));
                                                $end_date = date('d-m-Y', strtotime($class->CLend_date));

                                                $hoy = date("Y-m-d");
                                                $start_date_status = date("Y-m-d", strtotime($class->CLstart_date));
                                                $end_date_status = date("Y-m-d", strtotime($class->CLend_date));

                                                $atletas = DB::table('inscriptions')
                                                ->where('class_id',$class->id)
                                                ->where('status','1')
                                                ->where('inscription_status','1')
                                                ->count();

                                            @endphp
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    @if ($class->Cimage)
                                                        <div>
                                                            <img src="{{ asset('assets/uploads/categories/'.$class->Cimage) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="{{ $class->Cname }}">
                                                        </div>
                                                    @endif
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $class->Cname }} </h6>
                                                        <p class="text-xs text-secondary mb-0">{{ __('Period') }}: <font color="limegreen">{{ $start_date }}</font> - <font color="red">{{ $end_date }}</font></p>
                                                        <p class="text-xs text-secondary mb-0">({{ $atletas }} Atletas)</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0"><a href="{{ url('show-facility/'.$class->facility_id) }}">{{ $class->Fname }}</a></p>
                                                {{-- <p class="text-xs text-secondary mb-0">@if ($class->phone != null) </strong><br><i class="fas fa-phone me-1" aria-hidden="true"></i>{{ $class->phone }} @endif @if ($class->whatsapp != null) </strong> <i class="fab fa-whatsapp me-1" aria-hidden="true"></i>{{ $class->whatsapp }} @endif<br>@if ($class->email != null) </strong> <i class="far fa-envelope-open me-1" aria-hidden="true"></i>{{ $class->email }} @endif</p> --}}
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <font color="limegreen">{{ $start_time }}</font> - <font color="red">{{ $end_time }}</font>
                                                    <br>
                                                    {{ $class->sunday == 1 ? __('Sunday').',' : '' }} {{ $class->monday == 1 ? __('Monday').',' : '' }} {{ $class->tuesday == 1 ? __('Tuesday').',' : '' }} {{ $class->wednesday == 1 ? __('Wednesday').',' : '' }} {{ $class->thursday == 1 ? __('Thursday').',' : '' }} {{ $class->friday == 1 ? __('Friday').',' : '' }} {{ $class->saturday == 1 ? __('Saturday').',' : '' }}
                                                    <br>
                                                    @php
                                                        $scheduleClass = \App\Models\Schedule::find($class->CLschedule_id);

                                                        $facilityName = \App\Models\Facility::find($scheduleClass->facility_id);

                                                        $start_timeClass = date('H:i A', strtotime($scheduleClass->start_time));
                                                        $end_timeClass = date('H:i A', strtotime($scheduleClass->end_time));

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

                                                    @endphp
                                                    {{ __('Available Quota') }}: {{ $disponibles }}
                                                </span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $class->Iname }}</p>
                                                <p class="text-xs text-secondary mb-0">@if ($class->phone != null) </strong><br><i class="fas fa-phone me-1" aria-hidden="true"></i>{{ $class->phone }} @endif @if ($class->whatsapp != null) </strong> <i class="fab fa-whatsapp me-1" aria-hidden="true"></i>{{ $class->whatsapp }} @endif<br>@if ($class->email != null) </strong> <i class="far fa-envelope-open me-1" aria-hidden="true"></i>{{ $class->email }} @endif</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if (($start_date_status <= $hoy) and ($end_date_status >= $hoy))
                                                    <span class="badge badge-sm bg-gradient-success">{{ __('Current') }}</span>
                                                @elseif ($start_date_status > $hoy)
                                                    <span class="badge badge-sm bg-gradient-warning">{{ __('Foward') }}</span>
                                                @elseif ($end_date_status < $hoy)
                                                    <span class="badge badge-sm bg-gradient-danger">{{ __('Finalized') }}</span>
                                                @endif
                                            </td>

                                            <td class="align-middle">
                                                <a href="{{ url('show-class/'.$class->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                                                <a href="{{ url('edit-class/'.$class->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteClassModal-{{ $class->id }}">
                                                    <i class="material-icons">delete</i>
                                                </button>

                                            </td>
                                        </tr>
                                    </tbody>
                                    @include('admin.class.deletemodalclass')
                                @endforeach

                            </table>
                        </div>
                        @if ($classes->count() == 0)
                            <div class="card-header p-4 position-relative mt-n4 mx-3 z-index-2">
                                <div class="alert alert-primary text-white" role="alert">
                                    <strong>{{ __('No Classes added or found!') }}</strong> <a href="{{ url('add-class') }}"> {{ __('Add Class') }}</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
