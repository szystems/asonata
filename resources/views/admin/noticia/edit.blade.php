@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">newspaper</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">{{ __('Noticias') }}</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <h4><u>{{ __('Edit') }} {{ __('Noticia') }}</u></h4>
                    @if (count($errors)>0)
                        <div class="alert alert-danger text-white" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                      <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif
                    <form action="{{ url('update-noticia/'.$noticia->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">{{ __('Titulo') }}</label>
                                <input type="text" class="form-control border px-2 " name="titulo" value="{{ $noticia->titulo }}" >
                                @if ($errors->has('titulo'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('titulo') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">{{ __('Contenido') }}</label>
                                <textarea id="editor" type="text" class="form-control border px-2 " rows="10" name="contenido">{{  $noticia->contenido  }}</textarea>
                                @if ($errors->has('contenido'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('contenido') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>


                            @if ($noticia->imagen)
                                <div class="col-md-12 mb-3">
                                    <img class="border-radius-md w-25 img-fluid" src="{{ asset('assets/uploads/noticias/' . $noticia->imagen) }}" alt="Imagen">
                                </div>
                            @endif

                            <div class="col-md-12 mb-3">
                                <label for="">{{ __('Change Image') }}</label>
                                <input type="file" name="imagen" class="form-control border">
                            </div>

                            <div class="col-md-12 mb-3" >
                                <button type="submit" class="btn btn-success"><i class="material-icons">save</i> {{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> --}}
                </div>
            </div>
        </div>

    </div>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ),{
                ckfinder:{
                    uploadUrl: '{{ url('upload_imagen').'?_token='.csrf_token() }}'
                }
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>

@endsection
