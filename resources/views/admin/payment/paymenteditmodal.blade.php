<!-- Delete Modal -->
<div class="modal fade" id="paymentEditModal-{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="paymentEditModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="paymentEditModal"><i class="material-icons">payments</i> {{ __('Editar Pago') }}</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ url('edit-payment') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body" align="center">
                {{ __('Inscription') }}: <b>{{ $inscription->inscription_number }}</b>
                <br>

                    <div class="col-md-5 mb-3">
                        <label for=""><b><u>{{ __('Cantidad Pagada') }}</u></b></label>
                        <div class="input-daterange input-group" >
                            <div class="input-group input-group-dynamic mb-4">
                                {{ $config->currency_simbol }}
                                <input readonly type="number" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{ number_format($payment->paid,2, '.', ',') }}" required>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for=""><b><u>{{ __('No. Recibo') }}</u></b></label>
                        <input type="text" class="form-control border px-2" name="no_recibo" value="{{ $payment->no_recibo }}">
                    </div>


                    <div class="col-md-12 mb-3">
                        <label for=""><b><u>{{ __('Note') }}</u></b></label>
                        <div class="input-group input-group-dynamic mb-4">
                            <textarea type="text" class="form-control border px-2 " rows="2" name="note" required>{{ $payment->note }}</textarea>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="inscription_id" value="{{ $inscription->id }}">
                <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="button" class="btn bg-gradient-info" data-bs-dismiss="modal"><i class="material-icons">close</i> {{ __('Cancel') }}</button>
                <button type="submit" class="btn btn-success"><i class="material-icons">edit</i> {{ __('Save') }}</button>
            </div>
        </form>
      </div>
    </div>
  </div>

