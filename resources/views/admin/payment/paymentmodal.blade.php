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
            <div class="modal-body" align="center">
                {{ __('Inscription') }}: <b>{{ $inscription->inscription_number }}</b>
                <br>

                    <div class="col-md-5 mb-3">
                        <label for=""><b><u>{{ __('Monthly Payment') }}</u></b></label>
                        <div class="input-daterange input-group" >
                            <div class="input-group input-group-dynamic mb-4">
                                {{ $config->currency_simbol }}
                                <input readonly type="number" class="form-control" id="monthly_payment" aria-label="Amount (to the nearest dollar)" name="monthly_payment" value="{{ number_format($class->CLmonthly_payment,2, '.', ',') }}" >
                            </div>

                        </div>
                    </div>
                    @if (Auth::user()->role_as == 1)
                    <div class="col-md-5 mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="exonarate_monthly">
                            <p class="text-warning">{{ __('Exoneration') }}</p>
                        </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for=""><b><u>{{ __('Amount to be exonerated') }}</u></b></label>
                        <div class="input-daterange input-group" >
                            <div class="input-group input-group-dynamic mb-4">
                                {{ $config->currency_simbol }}
                                <input type="number" class="form-control" id="amount_exonerated" aria-label="Amount (to the nearest dollar)" name="amount_exonerated" value="{{ number_format($class->CLmonthly_payment,2, '.', ',') }}" required>
                            </div>
                        </div>
                    </div>
                    @endif
                    {{-- <div class="col-md-5 mb-3">
                        <label for=""><b><u>{{ __('Payment Type') }}</u></b></label>
                        <div class="input-daterange input-group" >
                            <select class="form-select px-2" aria-label="Default select example" name="type">
                                @if (Auth::user()->role_as == 1)
                                    <option selected value="2">{{ __('Monthly') }}</option>
                                    <option value="3">{{ __('Exoneration') }}</option>
                                @else
                                <option selected value="2">{{ __('Monthly') }}</option>
                                @endif
                            </select>
                        </div>
                    </div> --}}
                    <div class="col-md-12 mb-3">
                        <label for=""><b><u>{{ __('Note') }}</u></b></label>
                        <div class="input-group input-group-dynamic mb-4">
                            <textarea type="text" class="form-control border px-2 " rows="2" name="note"></textarea>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="inscription_id" value="{{ $inscription->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="button" class="btn bg-gradient-info" data-bs-dismiss="modal"><i class="material-icons">close</i> {{ __('Cancel') }}</button>
                <button type="submit" class="btn btn-success"><i class="material-icons">payments</i> {{ __('Make Payment') }}</button>
            </div>
        </form>
      </div>
    </div>
  </div>
