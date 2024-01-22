<!-- Delete Modal -->
<div class="modal modal-xl fade" id="editTeamModal{{ $team->id }}" tabindex="-1" role="dialog" aria-labelledby="editTeamModal{{ $team->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="editTeamModal{{ $team->id }}"> {{ __('Agregar') }} {{ __('Equipo') }}</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ url('update-team') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body" align="center">
                <br>
                <div class="col-md-12 mb-3">
                    <label class="text-primary" for="">Nombre</label>
                    <div class="input-group input-group-dynamic mb-4">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre del Equipo" aria-describedby="basic-addon1" value="{{ $team->nombre }}" required>
                    </div>
                    @if ($errors->has('nombre'))
                        <span class="help-block opacity-7">
                            <strong>
                                <font color="red">
                                    {{ $errors->first('nombre') }}</font>
                            </strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-12 mb-3">
                    <label class="text-primary" for="">Descripción</label>
                    <textarea type="text" class="form-control border px-2 " rows="5" name="descripcion">{{ $team->descripcion }}</textarea>
                    @if ($errors->has('descripcion'))
                        <span class="help-block opacity-7">
                            <strong>
                                <font color="red">
                                    {{ $errors->first('descripcion') }}
                                </font>
                            </strong>
                        </span>
                    @endif
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="team_id" value="{{ $team->id }}">
                <button type="button" class="btn bg-gradient-info" data-bs-dismiss="modal"><i class="material-icons">close</i> {{ __('Cancelar') }}</button>
                <button type="submit" class="btn btn-success"><i class="material-icons">save</i> {{ __('Save') }}</button>
            </div>
        </form>
      </div>
    </div>
  </div>
