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
                    <h4><u>{{ __('show') }} {{ __('Assist') }}</u></h4>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Class') }}</strong></label>
                            <p>{{ $category->name }} ({{ $cycle->name }})</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Instructor') }}</strong></label>
                            <p>{{ $instructor->name }}</p>
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
                        <div class="col-md-12 mb-3">
                            @php
                                $facilityName = \App\Models\Facility::find($schedule->facility_id);
                                $start_timeClass = date('h:i A', strtotime($schedule->start_time));
                                $end_timeClass = date('h:i A', strtotime($schedule->end_time));
                            @endphp
                            <label for="">{{ __('Schedule') }}</label>
                            <p><i class="far fa-clock"></i> {{ $facilityName->name }} / {{ $start_timeClass }} - {{ $end_timeClass }} / {{ $schedule->sunday == 1 ? __('Sunday').',' : '' }} {{ $schedule->monday == 1 ? __('Monday').',' : '' }} {{ $schedule->tuesday == 1 ? __('Tuesday').',' : '' }} {{ $schedule->wednesday == 1 ? __('Wednesday').',' : '' }} {{ $schedule->thursday == 1 ? __('Thursday').',' : '' }} {{ $schedule->friday == 1 ? __('Friday').',' : '' }} {{ $schedule->saturday == 1 ? __('Saturday').',' : '' }}</p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">{{ __('Attendance notes') }}</label>
                            <textarea readonly class="form-control border px-2" name="notes" rows="3">{{ $assist->notes }}</textarea>
                            <input type="hidden" name="class_id" value="{{ $class->id }}">
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
                            <h6 class="text-white text-capitalize ps-3">{{ __('Athletes') }} ({{ $attendances->count() }})</h6>
                        </div>
                    </div>
                    <div class="card-body p-4 pt-5">
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
                        <div class="p-0 position-relative mt-n4 mx-3 z-index-2">
                            @if(Auth::user()->role_as != 3)<a href="{{ url('edit-assist/'.$assist->id) }}" type="button" class="btn btn-warning float-lg-end"><i class="material-icons">edit</i></a>@endif
                            {{-- <button type="button" class="btn bg-gradient-danger float-lg-end" data-bs-toggle="modal" data-bs-target="#deleteAssistModal-{{ $assist->id }}">
                                <i class="material-icons">delete</i>
                            </button>
                            @include('admin.class.deleteassistmodal') --}}
                            <h4>{{ $fechaAsistencia }}</h4>
                            <span class="badge badge-sm bg-gradient-success">
                                <i class="	far fa-check-square text-white" aria-hidden="true"></i> = {{ $presentes }}
                            </span>
                            <span class="badge badge-sm bg-gradient-danger">
                                <i class="fas fa-ban text-white" aria-hidden="true"></i> = {{ $noPresentes }}
                            </span>

                        </div>

                        <div class="table-responsive p-4">
                            <table class="table table-sm align-products-center mb-0 table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Athlete') }}</th>
                                        <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Not Present') }} / {{ __('Present') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances as $attendance)
                                    @php
                                        $atleta = \App\Models\Atleta::find($attendance->atleta_id);
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
                                                <h6 class="mb-0 text-xs">@if(Auth::user()->role_as != 3)<a href="{{ url('show-athlete/'.$atleta->id) }}">@endif{{ $atleta->name }} @if(Auth::user()->role_as != 3)</a>@endif</h6>
                                                <p class="text-xs text-secondary mb-0">CUI: {{ $atleta->cui_dpi }}</p>
                                                <p class="text-xs text-secondary mb-0"><i class="fa fa-envelope-o me-1" aria-hidden="true"></i>{{ $atleta->email }}</p>
                                                <p class="text-xs text-secondary mb-0"><i class="fa fa-phone me-1" aria-hidden="true"></i>{{ $atleta->phone }} @if ($atleta->whatsapp != null) / <i class="fab fa-whatsapp me-1" aria-hidden="true"></i> {{ $atleta->whatsapp }} @endif</p>
                                              </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                              <div class="d-flex flex-column justify-content-center">
                                                <span class="badge badge-sm bg-gradient-{{ $attendance->status == 0 ? 'danger':'success' }}">
                                                    @if ($attendance->status == 0)
                                                        <i class="fas fa-ban text-white" aria-hidden="true"></i>
                                                    @else
                                                    <i class="	far fa-check-square text-white" aria-hidden="true"></i>
                                                    @endif
                                                </span>
                                              </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('admin.atleta.deletemodal')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($attendances->count() == 0)
                            <div class="card-header p-4 position-relative mt-n4 mx-3 z-index-2">
                                <div class="alert alert-primary text-white" role="alert">
                                    <strong>{{ __('No athletes added or found!') }}</strong>
                                </div>
                            </div>
                        @else
                        @endif

                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
