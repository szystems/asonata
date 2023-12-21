<!-- Delete Modal -->
<div class="modal modal-xl fade" id="editModalClass" tabindex="-1" role="dialog" aria-labelledby="editModalClass" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="editModalClass"> {{ __('Editar') }} {{ __('Class') }}</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ url('update-class_inscription') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body" align="center">
                <br>


                <div class="col-md-12 mb-3">
                    <label for="">{{ __('Available Classes') }}</label>
                    <select class="form-select px-2" aria-label="Default select example" name="class_id" required>
                        <option selected value="">{{ __('Select a class') }}</option>
                        @foreach ($classesavailable as $availableClass)
                            @php
                                $scheduleClass1 = \App\Models\Schedule::find($availableClass->CLschedule_id);

                                $facilityName1 = \App\Models\Facility::find($scheduleClass1->facility_id);

                                $start_timeClass1 = date('H:i A', strtotime($scheduleClass1->start_time));
                                $end_timeClass1 = date('H:i A', strtotime($scheduleClass1->end_time));

                                //obtener cupos ocupados
                                $cuposOcupados1=DB::table('inscriptions as i')
                                ->join('class as c','i.class_id','=','c.id')
                                ->where('c.schedule_id',$availableClass->CLschedule_id)
                                ->where('i.inscription_status','=',1)
                                ->where('i.status','=',1)
                                ->get();

                                //obtenemos cupo total y cupo ocupado
                                $disponibilidad = $availableClass->quota;
                                $ocupados = $cuposOcupados1->count();
                                //restamos los cupos ocupados a la disponibilidad
                                $disponibles1 = $disponibilidad - $ocupados;

                            @endphp
                            // si hay 1 o mas cupos disponibles1 se realiza la confirmacion
                            @if ($disponibles1 >= 1)
                            <option value="{{ $availableClass->id }}">{{ $availableClass->Cname }} ({{ $availableClass->age_from }}-{{ $availableClass->age_to }} {{ __('Years') }}), {{ __('Cycle') }}: {{ $class->CYid }}, {{ $facilityName1->name }} / {{ $start_timeClass1 }} - {{ $end_timeClass1 }} / {{ $scheduleClass1->sunday == 1 ? __('Sunday').',' : '' }} {{ $scheduleClass1->monday == 1 ? __('Monday').',' : '' }} {{ $scheduleClass1->tuesday == 1 ? __('Tuesday').',' : '' }} {{ $scheduleClass1->wednesday == 1 ? __('Wednesday').',' : '' }} {{ $scheduleClass1->thursday == 1 ? __('Thursday').',' : '' }} {{ $scheduleClass1->friday == 1 ? __('Friday').',' : '' }} {{ $scheduleClass1->saturday == 1 ? __('Saturday').',' : '' }} </option>
                            @endif

                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="inscription_id"  value="{{ $inscription->id }}">
                <button type="button" class="btn bg-gradient-info" data-bs-dismiss="modal"><i class="material-icons">close</i> {{ __('Cancelar') }}</button>
                <button type="submit" class="btn btn-success"><i class="material-icons">save</i> {{ __('Grabar') }}</button>
            </div>
        </form>
      </div>
    </div>
  </div>
