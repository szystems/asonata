@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
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
                    <h4><u>{{ __('Edit') }} {{ __('Schedule') }}</u></h4>
                    @if (count($errors)>0)
                        <div class="alert alert-danger text-white" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                      <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif
                    <form action="{{ url('update-schedule/'.$schedule->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                @php
                                    $facility = \App\Models\Facility::find($schedule->facility_id);
                                    $start_time = date('h:i', strtotime($schedule->start_time));
                                    $end_time = date('h:i', strtotime($schedule->end_time));
                                @endphp
                                <label for="">{{ __('Facility') }}</label>
                                <select class="form-select px-2" aria-label="Default select example" name="facility_id">
                                    <option selected value="{{ $facility->id }}">{{ $facility->name }}</option>
                                    @foreach ($facilities as $facility)
                                        <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('facility_id'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('facility_id') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="">{{ __('Start Time') }}</label><br>
                                <input type="time" class="form-control border px-2 " name="start_time" value="{{ $start_time }}" >
                                @if ($errors->has('start_time'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('start_time') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="">{{ __('End Time') }}</label><br>
                                <input type="time" class="form-control border px-2 " name="end_time" value="{{ $end_time }}" >
                                @if ($errors->has('end_time'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('end_time') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="">{{ __('Quota') }}</label><br>
                                <input type="number" class="form-control border px-2 " name="quota" value="{{ $schedule->quota }}" >
                                @if ($errors->has('quota'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('quota') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-12 mb-3">
                                <h4><u>{{ __('Days') }}</u></h4>
                                <label><font color="orange">{{ __('Enable/Disable days for the corresponding schedule') }}</font></label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="sunday" {{ $schedule->sunday == 1 ? 'checked':'' }}>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">{{ __('Sunday') }}</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="monday" {{ $schedule->monday == 1 ? 'checked':'' }}>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">{{ __('Monday') }}</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="tuesday" {{ $schedule->tuesday == 1 ? 'checked':'' }}>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">{{ __('Tuesday') }}</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="wednesday" {{ $schedule->wednesday == 1 ? 'checked':'' }}>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">{{ __('Wednesday') }}</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="thursday" {{ $schedule->thursday == 1 ? 'checked':'' }}>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">{{ __('Thursday') }}</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="friday" {{ $schedule->friday == 1 ? 'checked':'' }}>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">{{ __('Friday') }}</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="saturday" {{ $schedule->saturday == 1 ? 'checked':'' }}>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">{{ __('Saturday') }}</label>
                                </div>


                            </div>



                            <div class="col-md-12 mb-3" >
                                <button type="submit" class="btn btn-success"><i class="material-icons">save</i> {{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> --}}
                </div>
            </div>
        </div>

    </div>

@endsection
