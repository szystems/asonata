<!-- Delete Modal -->
<div class="modal modal-xl fade" id="editMemberModal{{ $member->id }}" tabindex="-1" role="dialog" aria-labelledby="editMemberModal{{ $member->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="editMemberModal{{ $member->id }}"> {{ __('Editar') }} {{ __('Miembro') }}</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ url('update-member') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body" align="center">
                <br>
                <div class="col-md-12 mb-3">
                    <label class="text-primary" for="">Cargo del Miembro:</label>
                    <div class="input-group input-group-dynamic mb-4">
                        <input type="text" name="cargo" class="form-control" placeholder="Cargo del Miembro del equipo: {{ $team->cargo }}" aria-describedby="basic-addon1" value="{{ $member->cargo }}">
                    </div>
                    @if ($errors->has('cargo'))
                        <span class="help-block opacity-7">
                            <strong>
                                <font color="red">
                                    {{ $errors->first('cargo') }}</font>
                            </strong>
                        </span>
                    @endif
                </div>
                <div class="col-md-12 mb-3">
                    <label class="text-primary" for="">Nombre Miembro</label>
                    <div class="input-group input-group-dynamic mb-4">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre del Miembro" aria-describedby="basic-addon1" value="{{ $member->nombre }}" required>
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

            </div>
            <div class="modal-footer">
                <input type="hidden" name="member_id" value="{{ $member->id }}">
                <button type="button" class="btn bg-gradient-info" data-bs-dismiss="modal"><i class="material-icons">close</i> {{ __('Cancelar') }}</button>
                <button type="submit" class="btn btn-success"><i class="material-icons">save</i> {{ __('Save') }}</button>
            </div>
        </form>
      </div>
    </div>
  </div>
