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
                    <h4><u>{{ __('Edit') }} {{ __('Inscription') }}</u></h4>
                    @if (count($errors)>0)
                        <div class="alert alert-danger text-white" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                      <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif
                    <form action="{{ url('update-inscription/'.$inscription->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">{{ __('Athlete') }}</label>
                                @php
                                    $fecha_nacimiento = date("d-m-Y", strtotime($atleta->birth));
                                    $cumpleanos = new DateTime($atleta->birth);
                                    $hoy = new DateTime();
                                    $annos = $hoy->diff($cumpleanos);
                                    $edad = $annos->y;
                                @endphp
                                <p><b>{{ $atleta->name }}, Edad: {{ $edad }}, CUI/DPI: {{ $atleta->cui_dpi }}</b></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">{{ __('Class') }}</label>
                                @php
                                    $scheduleClass = \App\Models\Schedule::find($class->CLschedule_id);

                                    $facilityName = \App\Models\Facility::find($scheduleClass->facility_id);

                                    $start_timeClass = date('h:i A', strtotime($scheduleClass->start_time));
                                    $end_timeClass = date('h:i A', strtotime($scheduleClass->end_time));
                                @endphp
                                <p><b>{{ $class->Cname }} ({{ $class->age_from }}-{{ $class->age_to }} {{ __('Years') }}), {{ __('Cycle') }}: {{ $class->CYid }}, {{ $facilityName->name }} / {{ $start_timeClass }} - {{ $end_timeClass }} / {{ $scheduleClass->sunday == 1 ? __('Sunday').',' : '' }} {{ $scheduleClass->monday == 1 ? __('Monday').',' : '' }} {{ $scheduleClass->tuesday == 1 ? __('Tuesday').',' : '' }} {{ $scheduleClass->wednesday == 1 ? __('Wednesday').',' : '' }} {{ $scheduleClass->thursday == 1 ? __('Thursday').',' : '' }} {{ $scheduleClass->friday == 1 ? __('Friday').',' : '' }} {{ $scheduleClass->saturday == 1 ? __('Saturday').',' : '' }} , Edad: {{ $edad }}, CUI/DPI: {{ $atleta->cui_dpi }}</b></p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">{{ __('Status') }}</label>
                                <select class="form-select px-2" aria-label="Default select example" name="inscription_status">
                                    <option selected value="{{ $inscription->inscription_status }}">
                                        {{ $inscription->inscription_status == '0' ? __('Pending')
                                            : ($inscription->inscription_status == '1' ? __('Confirmed')
                                            : ($inscription->inscription_status == '2' ? __('Rejected')
                                            : ($inscription->inscription_status == '3' ? __('Expelled')
                                            : ($inscription->inscription_status == '4' ? __('Retired')
                                            : ($inscription->inscription_status == '5' ? __('Promoted')
                                            : "")))))
                                        }}</option>
                                    @if ($inscription->inscription_status == 0)
                                        <option value="1">{{ __('Confirmed') }}</option>
                                        <option value="2">{{ __('Rejected') }}</option>
                                    @elseif ($inscription->inscription_status == 1)
                                        <option value="3">{{ __('Expelled') }}</option>
                                        <option value="4">{{ __('Retired') }}</option>
                                        <option value="5">{{ __('Promoted') }}</option>
                                    @elseif ($inscription->inscription_status == 2)
                                        <option value="1">{{ __('Confirmed') }}</option>
                                    @elseif ($inscription->inscription_status == 3 or $inscription->inscription_status == 4 or $inscription->inscription_status == 5)
                                        <option value="3">{{ __('Expelled') }}</option>
                                        <option value="4">{{ __('Retired') }}</option>
                                        <option value="5">{{ __('Promoted') }}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">{{ __('Inscription Payment') }}</label>
                                <select @if ($inscription->inscription_status != 1) disabled @endif class="form-select px-2" aria-label="Default select example" name="inscription_payment">
                                    <option selected value="{{ $inscription->inscription_payment }}">{{ $inscription->inscription_payment == '0' ? __('Pending') : __('Paid') }}</option>
                                    @if ($inscription->inscription_payment != 1)
                                        <option value="0">{{ __('Pending') }}</option>
                                        <option value="1">{{ __('Paid') }}</option>
                                    @endif
                                </select>
                                <input type="hidden" value="{{ $class->id }}">
                                <input type="hidden" value="{{ $class->CLinscription_payment }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">{{ __('Badge Payment') }}</label>
                                <select @if ($inscription->inscription_status != 1) disabled @endif class="form-select px-2" aria-label="Default select example" name="badge_payment">
                                    <option selected value="{{ $inscription->badge_payment }}">{{ $inscription->badge_payment == '0' ? __('Pending') : __('Paid') }}</option>
                                    @if ($inscription->badge_payment != 1)
                                        <option value="0">{{ __('Pending') }}</option>
                                        <option value="1">{{ __('Paid') }}</option>
                                    @endif
                                </select>
                                <input type="hidden" value="{{ $class->CLbadge }}">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="">{{ __('Notes') }}</label>
                                <textarea class="form-control border px-2 " name="notes" cols="30" rows="3">{{ $inscription->notes }}</textarea>
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
