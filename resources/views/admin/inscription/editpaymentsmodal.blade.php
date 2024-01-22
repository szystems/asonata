<!-- Delete Modal -->
<div class="modal fade" id="editPaymentsModalClass" tabindex="-1" role="dialog" aria-labelledby="editPaymentsModalClass" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="editPaymentsModalClass"> Cambiar Pagos</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ url('update-payments-inscription') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body" align="center">
                <br>


                <div class="col-md-3 mb-3">
                    <label for="">Cantidad de Pagos</label>
                    <select class="form-select px-2" aria-label="Default select example" name="payments" required>
                        <option selected value="{{ $inscription->payments }}">{{ $inscription->payments }}</option>
                        @for ($p = $inscriptionPayments->count(); $p <= 24; $p++)
                            <option value="{{ $p }}">{{ $p }}</option>
                        @endfor

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
