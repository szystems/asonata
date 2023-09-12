<!-- Delete Modal -->
<div class="modal fade" id="paymentModal-{{ $inscription->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="exampleModalLabel"><i class="material-icons">payments</i> {{ __('Make Payment') }}</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ url('add-payment') }}" method="POST">
            @csrf
            <div class="modal-body">
                {{ __('Inscription') }}: <b>{{ $inscription->inscription_number }}</b>
                <br>

                    <div class="col-md-6 mb-3">
                        <label for=""><b><u>{{ __('Monthly Payment') }}</u></b></label>
                        <div class="input-daterange input-group" >
                            <div class="input-group input-group-dynamic mb-4">
                                {{ $config->currency_simbol }}
                                <input readonly type="number" class="form-control" id="inscription_payment" aria-label="Amount (to the nearest dollar)" name="paid" value="{{ number_format($class->CLmonthly_payment,2, '.', ',') }}" >
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="inscription_id" value="{{ $inscription->id }}">
                <input type="hidden" name="type" value="2">
                <button type="button" class="btn bg-gradient-info" data-bs-dismiss="modal"><i class="material-icons">close</i> {{ __('Cancel') }}</button>
                <button type="submit" class="btn btn-success"><i class="material-icons">payments</i> {{ __('Make Payment') }}</button>
            </div>
        </form>
      </div>
    </div>
  </div>
