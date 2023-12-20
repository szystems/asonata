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
                    <h4><u>{{ __('Add Inscription') }}</u></h4>
                    @if (count($errors)>0)
                        <div class="alert alert-danger text-white" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                      <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif
                    <form action="{{ url('insert-inscription') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">{{ __('Athlete') }}</label>
                                {{-- <select class="form-select px-2" aria-label="Default select example" name="atleta_id" required>
                                    <option selected value="">{{ __('Select an athlete') }}</option>
                                    @foreach ($atletas as $atleta)
                                        @php
                                            $fecha_nacimiento = date("d-m-Y", strtotime($atleta->birth));
                                            $cumpleanos = new DateTime($atleta->birth);
                                            $hoy = new DateTime();
                                            $annos = $hoy->diff($cumpleanos);
                                            $edad = $annos->y;
                                        @endphp
                                        <option value="{{ $atleta->id }}">{{ $atleta->name }}, Edad: {{ $edad }}, CUI/DPI: {{ $atleta->cui_dpi }}</option>
                                    @endforeach
                                </select> --}}

                                <input class="form-select px-2" list="atletaslist" id="atletas" placeholder="{{ __('Search and select an athlete') }}..." required>
                                <datalist id="atletaslist">
                                    @foreach($atletas as $atleta)
                                        @php
                                            $fecha_nacimiento = date("d-m-Y", strtotime($atleta->birth));
                                            $cumpleanos = new DateTime($atleta->birth);
                                            $hoy = new DateTime();
                                            $annos = $hoy->diff($cumpleanos);
                                            $edad = $annos->y;
                                        @endphp
                                        <option value="{{ $atleta->name }}, Edad: {{ $edad }}, CUI/DPI: {{ $atleta->cui_dpi }}">{{ $atleta->id }}</option>
                                    @endforeach
                                </datalist>
                                <input type="hidden" name="atleta_id" id="atleta_id">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">{{ __('Available Classes') }}</label>
                                <select class="form-select px-2" aria-label="Default select example" name="class_id">
                                    <option selected value="">{{ __('Select a class') }}</option>
                                    @foreach ($classes as $class)
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
                                        // si hay 1 o mas cupos disponibles se realiza la confirmacion
                                        @if ($disponibles >= 1)
                                        <option value="{{ $class->id }}">{{ $class->Cname }} ({{ $class->age_from }}-{{ $class->age_to }} {{ __('Years') }}), {{ __('Cycle') }}: {{ $class->CYid }}, {{ $facilityName->name }} / {{ $start_timeClass }} - {{ $end_timeClass }} / {{ $scheduleClass->sunday == 1 ? __('Sunday').',' : '' }} {{ $scheduleClass->monday == 1 ? __('Monday').',' : '' }} {{ $scheduleClass->tuesday == 1 ? __('Tuesday').',' : '' }} {{ $scheduleClass->wednesday == 1 ? __('Wednesday').',' : '' }} {{ $scheduleClass->thursday == 1 ? __('Thursday').',' : '' }} {{ $scheduleClass->friday == 1 ? __('Friday').',' : '' }} {{ $scheduleClass->saturday == 1 ? __('Saturday').',' : '' }} </option>
                                        @endif

                                    @endforeach
                                </select>

                                {{-- <input class="form-select px-2" list="datalist1" id="inputDatalist1" placeholder="{{ __('Search and select an athlete') }}..." name="atleta_id" required>
                                <datalist id="datalist1">
                                    @foreach($classes as $class)
                                    @php
                                        $scheduleClass = \App\Models\Schedule::find($class->CLschedule_id);

                                        $facilityName = \App\Models\Facility::find($scheduleClass->facility_id);

                                        $start_timeClass = date('H:i A', strtotime($scheduleClass->start_time));
                                        $end_timeClass = date('H:i A', strtotime($scheduleClass->end_time));
                                    @endphp
                                        <option value="{{ $class->Cname }} ({{ $class->age_from }}-{{ $class->age_to }} {{ __('Years') }}), {{ __('Cycle') }}: {{ $class->CYid }}, {{ $facilityName->name }} / {{ $start_timeClass }} - {{ $end_timeClass }} / {{ $scheduleClass->sunday == 1 ? __('Sunday').',' : '' }} {{ $scheduleClass->monday == 1 ? __('Monday').',' : '' }} {{ $scheduleClass->tuesday == 1 ? __('Tuesday').',' : '' }} {{ $scheduleClass->wednesday == 1 ? __('Wednesday').',' : '' }} {{ $scheduleClass->thursday == 1 ? __('Thursday').',' : '' }} {{ $scheduleClass->friday == 1 ? __('Friday').',' : '' }} {{ $scheduleClass->saturday == 1 ? __('Saturday').',' : '' }} " data-value="{{ $class->id }}">
                                    @endforeach
                                </datalist> --}}
                            </div>


                            <div class="col-md-12 mb-3">
                                <label for="">{{ __('Notes') }}</label>
                                <textarea class="form-control border px-2 " name="notes" cols="30" rows="3">{{ old('notes') }}</textarea>
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

    <script>
        const input = document.getElementById('atletas');
        const list = document.getElementById('atletaslist');

        input.addEventListener('change', () => {
        const {value: inputVal} = input
        const children = Array.from(list.children)

        // Fetch matched elem
        const [matchedElem] = children.filter(({value}) => value === inputVal)

        // If element doesn't exist, no matches
        if(!matchedElem) {
            console.log('No matches found')

            return
        }
        atleta_id.value = matchedElem.textContent;
        // Do whatever
        console.log('Matched value for', matchedElem.value, 'is', matchedElem.textContent)
        });

    </script>


@endsection
