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
                    <h4><u>{{ __('Show') }} {{ __('Noticia') }}</u></h4>
                    <div>
                        <a href="{{ url('edit-noticia/'.$noticia->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                        <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $noticia->id }}">
                            <i class="material-icons">delete</i>
                        </button>
                        <a href="{{ url('noticias/' . $noticia->id) }}" class="btn btn-info" target="_blank">
                            <i class="material-icons opacity-10">visibility</i> {{ __('Vista Previa') }}
                        </a>
                        @include('admin.noticia.deletemodal')

                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for=""><strong>{{ __('Titulo') }}</strong></label>
                            <p>{{ $noticia->titulo }}</p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for=""><strong>{{ __('Contenido') }}</strong></label>
                            <p>
                                {!! html_entity_decode($noticia->contenido) !!}
                            </p>
                        </div>
                        @if ($noticia->imagen)
                            <div class="col-md-12 mb-3">
                                <label for=""><strong>{{ __('Image') }} </strong></label><br>
                                <img class="border-radius-md w-25 img-fluid"
                                    src="{{ asset('assets/uploads/noticias/' . $noticia->imagen) }}" alt="Image">
                            </div>
                        @endif
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> --}}
                    </div>
                </div>
            </div>

        </div>

    @endsection
