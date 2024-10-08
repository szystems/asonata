<!-- Delete Modal -->
<div class="modal modal-xl fade" id="editSlideModal{{ $slide->id }}" tabindex="-1" role="dialog" aria-labelledby="editSlideModal{{ $slide->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="editSlideModal{{ $slide->id }}"> {{ __('Agregar') }} {{ __('Carrousel') }}</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ url('update-carrousel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body" align="center">
                <br>
                <div class="col-md-12 mb-3">
                    <label class="text-primary" for="">Titulo</label>
                    <div class="input-group input-group-dynamic mb-4">
                        <input type="text" name="titulo" class="form-control" placeholder="Titulo del carrousel" aria-describedby="basic-addon1" value="{{ $slide->titulo }}">
                    </div>
                    @if ($errors->has('titulo'))
                        <span class="help-block opacity-7">
                            <strong>
                                <font color="red">
                                    {{ $errors->first('titulo') }}</font>
                            </strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-12 mb-3">
                    <label class="text-primary" for="">Descripción</label>
                    <textarea type="text" class="form-control border px-2 " rows="5" name="descripcion">{{ $slide->descripcion }}</textarea>
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

                <div class="col-md-12 mb-3">
                    <label class="text-primary" for="">Texto del Boton</label>
                    <div class="input-group input-group-dynamic mb-4">
                        <input type="text" name="boton_texto" class="form-control" placeholder="Texto del boton del link" aria-describedby="basic-addon1" value="{{ $slide->boton_texto }}">
                    </div>
                    @if ($errors->has('boton_texto'))
                        <span class="help-block opacity-7">
                            <strong>
                                <font color="red">
                                    {{ $errors->first('boton_texto') }}</font>
                            </strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-12 mb-3">
                    <label class="text-primary" for="">Link del Boton</label>
                    <div class="input-group input-group-dynamic mb-4">
                        <input type="text" name="boton_link" class="form-control" placeholder="Link del boton 'https://mi-link.com'" aria-describedby="basic-addon1" value="{{ $slide->boton_link }}">
                    </div>
                    @if ($errors->has('boton_link'))
                        <span class="help-block opacity-7">
                            <strong>
                                <font color="red">
                                    {{ $errors->first('boton_link') }}</font>
                            </strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-12 mb-3">
                    <h4><u>Imagen del Carrousel:</u></h4>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="text-primary" for="">Cambiar Imagen</label>
                    <input type="file" name="imagen" class="form-control border">
                    @if ($errors->has('imagen'))
                        <span class="help-block opacity-7">
                            <strong>
                                <font color="red">
                                    {{ $errors->first('imagen') }}</font>
                            </strong>
                        </span>
                    @endif
                </div>
                @empty($slide->imagen)
                @else
                    <div class="col-md-6 mb-3">
                        {{-- <label class="text-primary" for="">Imagen</label> --}}
                        <img src="{{ asset('assets/uploads/slides/' . $slide->imagen) }}" class="avatar avatar-xxl  me-3 border-radius-lg" alt="{{ $slide->titulo }}">
                    </div>
                @endempty

            </div>
            <div class="modal-footer">
                <input type="hidden" name="slide_id" value="{{ $slide->id }}">
                <button type="button" class="btn bg-gradient-info" data-bs-dismiss="modal"><i class="material-icons">close</i> {{ __('Cancelar') }}</button>
                <button type="submit" class="btn btn-success"><i class="material-icons">save</i> {{ __('Save') }}</button>
            </div>
        </form>
      </div>
    </div>
  </div>
