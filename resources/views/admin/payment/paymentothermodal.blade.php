<!-- Delete Modal -->
<div class="modal fade" id="paymentOtherModal-{{ $inscription->id }}" tabindex="-1" role="dialog" aria-labelledby="paymentOtherModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="paymentOtherModal"><i class="material-icons">payments</i> {{ __('Pagos Varios') }}</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ url('add-payment-other') }}" method="POST" id="id_del_formulario2">
            @csrf
            <div class="modal-body" align="center">
                {{ __('Inscription') }}: <b>{{ $inscription->inscription_number }}</b>
                <br>

                    <div class="col-md-5 mb-3">
                        <label for=""><b><u>{{ __('Cantidad a Pagar') }}</u></b></label>
                        <div class="input-daterange input-group" >
                            <div class="input-group input-group-dynamic mb-4">
                                {{ $config->currency_simbol }}
                                <input type="number" class="form-control" id="amount" aria-label="Amount (to the nearest dollar)" name="amount" value="{{ number_format('0',2, '.', ',') }}" required>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for=""><b><u>{{ __('No. Recibo') }}</u></b></label>
                        <input type="text" class="form-control border px-2" name="no_recibo">
                    </div>


                    <div class="col-md-12 mb-3">
                        <label for=""><b><u>{{ __('Note') }}</u></b></label>
                        <div class="input-group input-group-dynamic mb-4">
                            <textarea type="text" class="form-control border px-2 " rows="2" name="note" required></textarea>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="inscription_id" value="{{ $inscription->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="button" class="btn bg-gradient-info" data-bs-dismiss="modal"><i class="material-icons">close</i> {{ __('Cancel') }}</button>
                <button type="submit" class="btn btn-success" id="id_del_boton_de_pago2"><i class="material-icons">payments</i> {{ __('Make Payment') }}</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Agrega el siguiente código a tu vista para cerrar el modal automáticamente -->
<script>
  document.getElementById("id_del_boton_de_pago2").addEventListener("click", function(){
  $('#paymentModal-' + '{{ $inscription->id }}').modal('hide');
  alert("Presione aceptar y espere a que se realice el pago.");
  document.getElementById("id_del_boton_de_pago2").setAttribute("disabled", true);
  document.getElementById("id_del_formulario2").submit();
});
</script>
