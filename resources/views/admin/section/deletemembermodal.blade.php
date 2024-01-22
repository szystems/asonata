<!-- Delete Modal -->
<div class="modal fade" id="deleteMemberModal{{ $member->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteMemberModal{{ $member->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="deleteMemberModal{{ $member->id }}">{{ __('Delete') }} {{ __('Miembro') }}</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p><b>Equipo:</b> {{ $team->nombre }}</p>
            <p><b>Miembro:</b> {{ $member->nombre }}</p>
            <b>{{ __('Esta seguro de eliminar este miembro del equipo?') }}</b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-info" data-bs-dismiss="modal"><i class="material-icons">close</i> {{ __('Cancel') }}</button>
          <a href="{{ url('delete-member/'.$member->id) }}" type="button" class="btn bg-gradient-danger"><i class="material-icons">delete</i> {{ __('Delete') }}</a>
        </div>
      </div>
    </div>
  </div>
