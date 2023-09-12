@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-info shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">rotate_left</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">{{ __('Cycles') }}</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <h4><u>{{ __('Show') }} {{ __('Cycle') }}</u></h4>
                    <div>
                        <a href="{{ url('edit-cycle/'.$cycle->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                        <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $cycle->id }}">
                            <i class="material-icons">delete</i>
                        </button>
                        @include('admin.cycle.deletemodal')

                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Name') }}</strong></label>
                            <p>{{ $cycle->name }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('Start Date') }}</strong></label>
                            @php
                                $start_date = date("d-m-Y", strtotime($cycle->start_date));
                            @endphp
                            <p><font color="limegreen">{{$start_date}}</font></p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""><strong>{{ __('End Date') }}</strong></label>
                            @php
                                $end_date = date("d-m-Y", strtotime($cycle->end_date));
                            @endphp
                            <p><font color="red">{{$end_date}}</font></p>
                        </div>
                        <div class="col-md-3 mb-3">
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

            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-info shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">history_toggle_off</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">{{ __('Schedules & Quota') }}</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="{{ url('add-schedule/'.$cycle->id) }}" class="btn btn-success">
                                <i class="material-icons opacity-10">add</i> {{ __('Add Schedule') }}
                            </a>

                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-sm align-products-center mb-0 table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Facility') }}</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Schedule') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Days') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Quota') }}</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><i class="material-icons">format_list_bulleted</i></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedules as $schedule)
                                        <tr>
                                            @php
                                                $facility = \App\Models\Facility::find($schedule->facility_id);
                                                $start_time = date('h:i A', strtotime($schedule->start_time));
                                                $end_time = date('h:i A', strtotime($schedule->end_time));
                                            @endphp
                                            <td class="align-middle text-left text-sm">
                                                <a href="{{ url('show-facility/'.$schedule->facility_id) }}">{{ $facility->name }} </a>
                                            </td>
                                            <td class="align-middle text-left text-sm"><h6 class="mb-0 text-xs">{{ __('From') }}: <font color="limegreen">{{ $start_time }}</font> {{ __('To') }}: <font color="red">{{ $end_time }}</font></h6></td>
                                            <td class="align-middle text-center text-sm">{{ $schedule->sunday == 1 ? __('Sunday').',' : '' }} {{ $schedule->monday == 1 ? __('Monday').',' : '' }} {{ $schedule->tuesday == 1 ? __('Tuesday').',' : '' }} {{ $schedule->wednesday == 1 ? __('Wednesday').',' : '' }} {{ $schedule->thursday == 1 ? __('Thursday').',' : '' }} {{ $schedule->friday == 1 ? __('Friday').',' : '' }} {{ $schedule->saturday == 1 ? __('Saturday').',' : '' }}</td>
                                            <td class="align-middle text-center text-sm">{{ $schedule->quota }}</td>
                                            <td class="align-middle  text-sm">
                                                {{-- <a href="{{ url('show-schedule/'.$schedule->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a> --}}
                                                <a href="{{ url('edit-schedule/'.$schedule->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModalSchedule-{{ $schedule->id }}">
                                                    <i class="material-icons">delete</i>
                                                </button>

                                            </td>
                                        </tr>
                                        @include('admin.cycle.deleteschedulemodal')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> --}}
                </div>
            </div>

        </div>
    @endsection
