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
                        <h4 class="mb-0">{{ __('My Classes') }}</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body px-0 pb-3 pt-5">
                    <div class="table-responsive p-4">
                        <table class="table align-items-center mb-0">
                            <thead>

                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Cycle') }}</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Class') }}</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Facility') }}</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Schedule') }}</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Status') }}</th>
                                    <th class="text-secondary opacity-7"><i class="material-icons">format_list_bulleted</i></th>
                                </tr>

                            </thead>

                            @foreach ($myClasses as $class)
                                <tbody>
                                    <tr>
                                        @php
                                            $cycle = \App\Models\Cycle::find($class->cycle_id);
                                            $category = \App\Models\Category::find($class->category_id);
                                            $group = \App\Models\Group::find($category->group_id);
                                            $schedule = \App\Models\Schedule::find($class->schedule_id);
                                            $facility = \App\Models\Facility::find($schedule->facility_id);
                                            $instructor = \App\Models\User::find($class->instructor_id);

                                            $start_time = date('h:i A', strtotime($schedule->start_time));
                                            $end_time = date('h:i A', strtotime($schedule->end_time));

                                            $start_date = date('d-m-Y', strtotime($class->start_date));
                                            $end_date = date('d-m-Y', strtotime($class->end_date));

                                            $hoy = date("Y-m-d");
                                            $start_date_status = date("Y-m-d", strtotime($class->start_date));
                                            $end_date_status = date("Y-m-d", strtotime($class->end_date));

                                            $atletas = DB::table('inscriptions')
                                            ->where('class_id',$class->id)
                                            ->where('status',1)
                                            ->where('inscription_status',1)
                                            ->count();

                                            $start_timeClass = date('h:i A', strtotime($schedule->start_time));
                                            $end_timeClass = date('h:i A', strtotime($schedule->end_time));

                                            //obtener cupos ocupados
                                            $cuposOcupados=DB::table('inscriptions as i')
                                            ->join('class as c','i.class_id','=','c.id')
                                            ->where('c.schedule_id',$class->schedule_id)
                                            ->where('i.inscription_status','=',1)
                                            ->where('i.status','=',1)
                                            ->get();

                                            //obtenemos cupo total y cupo ocupado
                                            $disponibilidad = $schedule->quota;
                                            $ocupados = $cuposOcupados->count();
                                            //restamos los cupos ocupados a la disponibilidad
                                            $disponibles = $disponibilidad - $ocupados;

                                        @endphp

                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $cycle->name }}</p>
                                            {{-- <p class="text-xs text-secondary mb-0">@if ($class->phone != null) </strong><br><i class="fas fa-phone me-1" aria-hidden="true"></i>{{ $class->phone }} @endif @if ($class->whatsapp != null) </strong> <i class="fab fa-whatsapp me-1" aria-hidden="true"></i>{{ $class->whatsapp }} @endif<br>@if ($class->email != null) </strong> <i class="far fa-envelope-open me-1" aria-hidden="true"></i>{{ $class->email }} @endif</p> --}}
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                @if ($category->image)
                                                    <div>
                                                        <img src="{{ asset('assets/uploads/categories/'.$category->image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="{{ $category->name }}">
                                                    </div>
                                                @endif
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $category->name }} </h6>
                                                    <p class="text-xs text-secondary mb-0">{{ __('Period') }}: <font color="limegreen">{{ $start_date }}</font> - <font color="red">{{ $end_date }}</font></p>
                                                    <p class="text-xs text-secondary mb-0">({{ $atletas }} Atletas)</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $facility->name }}</p>
                                            {{-- <p class="text-xs text-secondary mb-0">@if ($class->phone != null) </strong><br><i class="fas fa-phone me-1" aria-hidden="true"></i>{{ $class->phone }} @endif @if ($class->whatsapp != null) </strong> <i class="fab fa-whatsapp me-1" aria-hidden="true"></i>{{ $class->whatsapp }} @endif<br>@if ($class->email != null) </strong> <i class="far fa-envelope-open me-1" aria-hidden="true"></i>{{ $class->email }} @endif</p> --}}
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <font color="limegreen">{{ $start_time }}</font> - <font color="red">{{ $end_time }}</font>
                                                <br>
                                                {{ $schedule->sunday == 1 ? __('Sunday').',' : '' }} {{ $schedule->monday == 1 ? __('Monday').',' : '' }} {{ $schedule->tuesday == 1 ? __('Tuesday').',' : '' }} {{ $schedule->wednesday == 1 ? __('Wednesday').',' : '' }} {{ $schedule->thursday == 1 ? __('Thursday').',' : '' }} {{ $schedule->friday == 1 ? __('Friday').',' : '' }} {{ $schedule->saturday == 1 ? __('Saturday').',' : '' }}
                                                <br>
                                                {{ __('Available Quota') }}: {{ $disponibles }}
                                            </span>
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
                                            <a href="{{ url('my-classes/'.$class->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach

                        </table>
                    </div>
                    @if ($myClasses->count() == 0)
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
@endsection
