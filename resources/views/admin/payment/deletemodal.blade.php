<!-- Delete Modal -->
<div class="modal fade" id="deleteModalPayment-{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="exampleModalLabel">{{ __('Delete') }} {{ __('Payment') }}</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{ __('Are you sure to remove this payment?') }}
        </div>
        <div class="modal-footer">
            <form action="{{ url('delete-payment/'.$payment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="inscription_id" value="{{ $inscription->id }}">
                <button type="button" class="btn bg-gradient-info" data-bs-dismiss="modal"><i class="material-icons">close</i> {{ __('Cancel') }}</button>
                <button type="submit" class="btn btn-danger"><i class="material-icons">save</i> {{ __('Delete') }}</button>
            </form>
        </div>
      </div>
    </div>
  </div>
