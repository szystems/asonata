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
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="{{ url('add-noticia') }}" class="btn btn-success">
                                <i class="material-icons opacity-10">add</i> {{ __('Agregar Noticia') }}
                            </a>
                            <a href="{{ url('noticias') }}" class="btn btn-info" target="_blank">
                                <i class="material-icons opacity-10">visibility</i> {{ __('Vista Previa') }}
                            </a>

                        </div>
                        @include('admin.noticia.search')

                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-sm align-products-center mb-0 table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Creación / Actualizacion') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Titulo Noticia') }}</th>
                                            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><i class="material-icons">format_list_bulleted</i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($noticias as $noticia)
                                        <tr>
                                            @php
                                                $created = date("d-m-Y", strtotime($noticia->created_at));
                                                $updated = date("d-m-Y", strtotime($noticia->updated_at));
                                            @endphp
                                            <td class="align-middle text-center text-sm"><strong>{{ $created }} / {{ $updated }}</strong></td>
                                            <td class="align-middle text-center text-sm"><strong>{{ $noticia->titulo }}</strong></td>
                                            <td class="align-middle  text-sm">
                                                <a href="{{ url('show-noticia/'.$noticia->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                                                <a href="{{ url('edit-noticia/'.$noticia->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $noticia->id }}">
                                                    <i class="material-icons">delete</i>
                                                </button>

                                            </td>
                                        </tr>
                                        @include('admin.noticia.deletemodal')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> --}}
                   {{ $noticias->links() }}
                </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> --}}
                </div>
            </div>
        </div>

    </div>
@endsection
