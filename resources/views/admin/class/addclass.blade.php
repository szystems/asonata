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
                            <h6 class="text-white text-capitalize ps-3">{{ __('Add Class') }}</h6>
                        </div>
                    </div>
                    <div class="card-body p-3 pt-6">

                        @if (count($errors)>0)
                            <div class="alert alert-danger text-white" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                          <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>

                        @endif
                        <form action="{{ url('insert-class') }}" method="POST">
                            @csrf
                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label for="">{{ __('Category') }}</label>
                                    <select class="form-select px-2" aria-label="Default select example" name="category_id">
                                        <option value="">{{ __('Select a category') }}...</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="">{{ __('Schedule') }}</label>
                                    <select class="form-select px-2" aria-label="Default select example" name="schedule_id">
                                        <option value="">{{ __('Select a schedule') }}...</option>
                                        @foreach($schedules as $schedule)
                                            @php
                                                $facilitySchedule = \App\Models\Facility::find($schedule->facility_id);
                                                $start_time = date('H:i A', strtotime($schedule->start_time));
                                                $end_time = date('H:i A', strtotime($schedule->end_time));
                                            @endphp
                                            <option value="{{ $schedule->id }}">{{ $facilitySchedule->name }} / {{ $start_time }} - {{ $end_time }} / {{ $schedule->sunday == 1 ? __('Sunday').',' : '' }} {{ $schedule->monday == 1 ? __('Monday').',' : '' }} {{ $schedule->tuesday == 1 ? __('Tuesday').',' : '' }} {{ $schedule->wednesday == 1 ? __('Wednesday').',' : '' }} {{ $schedule->thursday == 1 ? __('Thursday').',' : '' }} {{ $schedule->friday == 1 ? __('Friday').',' : '' }} {{ $schedule->saturday == 1 ? __('Saturday').',' : '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="">{{ __('Instructor') }}</label>
                                    <select class="form-select px-2" aria-label="Default select example" name="instructor_id">
                                        <option value="">{{ __('Select a instructor') }}...</option>
                                        @foreach($instructors as $instructor)
                                            <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="">{{ __('Start Date') }} </label>
                                        <div class="input-daterange input-group" >
                                            <div class="input-group input-group-dynamic mb-4">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control" id="startdate" aria-label="Amount (to the nearest dollar)" name="start_date" value="{{ old('start_date') }}" >
                                            </div>
                                        </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="">{{ __('End Date') }} </label>
                                        <div class="input-daterange input-group" >
                                            <div class="input-group input-group-dynamic mb-4">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control" id="enddate" aria-label="Amount (to the nearest dollar)" name="end_date" value="{{ old('end_date') }}" >
                                            </div>
                                        </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="">{{ __('Inscription') }} </label>
                                        <div class="input-daterange input-group" >
                                            <div class="input-group input-group-dynamic mb-4">
                                                {{ $config->currency_simbol }}
                                                <input type="number" class="form-control" id="inscription_payment" aria-label="Amount (to the nearest dollar)" name="inscription_payment" value="{{ old('inscription_payment') }}" >
                                            </div>
                                        </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="">{{ __('Badge') }} </label>
                                        <div class="input-daterange input-group" >
                                            <div class="input-group input-group-dynamic mb-4">
                                                {{ $config->currency_simbol }}
                                                <input type="number" class="form-control" id="badge" aria-label="Amount (to the nearest dollar)" name="badge" value="{{ old('badge') }}" >
                                            </div>
                                        </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="">{{ __('Monthly Payment') }} </label>
                                        <div class="input-daterange input-group" >
                                            <div class="input-group input-group-dynamic mb-4">
                                                {{ $config->currency_simbol }}
                                                <input type="number" class="form-control" id="monthly_payment" aria-label="Amount (to the nearest dollar)" name="monthly_payment" value="{{ old('monthly_payment') }}" >
                                            </div>
                                        </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="">{{ __('Costs') }}</label><br>
                                    <textarea class="form-control border px-2" name="notes" rows="5">{{ old('notes') }}</textarea>
                                    @if ($errors->has('notes'))
                                        <span class="help-block opacity-7">
                                                <strong>
                                                    <font color="red">{{ $errors->first('notes') }}</font>
                                                </strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="mostrar" {{ old('mostrar') == 1 ? 'checked':'' }}>
                                            <label class="form-check-label" for="flexSwitchCheckDefault">{{ __('Mostrar') }}</label>
                                        </div>
                                    </label>
                                </div>

                                <div class="col-md-12 mb-3" >
                                    <input type="hidden" name="cycle_id" value="{{ $cycle->id }}">
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


    </div>

    <script>
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

        var optSimple = {
            format: "dd-mm-yyyy",
            language: "es",
            autoclose: true,
            todayHighlight: true,
            todayBtn: "linked",
            orientation: "bottom auto",
            startDate: "{{ $start_date }}",
            endDate: "{{ $end_date }}"
        };
        $( '#startdate' ).datepicker( optSimple );
        $( '#enddate' ).datepicker( optSimple );
    </script>
@endsection
