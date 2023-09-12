@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-warning shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">pool</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">{{ __('Athletes') }}</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="{{ url('add-athlete') }}" class="btn btn-success">
                                <i class="material-icons opacity-10">add</i> {{ __('Add Athlete') }}
                            </a>

                        </div>
                        @include('admin.atleta.search')
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-sm align-products-center mb-0 table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Athlete') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Responsible') }}</th>
                                            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><i class="material-icons">format_list_bulleted</i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($atletas as $atleta)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    @if ($atleta->image)
                                                    <div>
                                                        <img src="{{ asset('assets/uploads/athletes/'.$atleta->image) }}" class="avatar avatar-sm me-3">
                                                    </div>
                                                @endif
                                                  <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-xs"><a href="{{ url('show-athlete/'.$atleta->id) }}">{{ $atleta->name }} </a></h6>
                                                    <p class="text-xs text-secondary mb-0">CUI: {{ $atleta->cui_dpi }} - <i class="fas fa-phone me-1" aria-hidden="true"></i> {{ $atleta->phone }} @if ($atleta->whatsapp != null) / <i class="fab fa-whatsapp me-1" aria-hidden="true"></i> {{ $atleta->whatsapp }} @endif</p>
                                                    <p class="text-xs text-secondary mb-0">{{ $atleta->email }}</p>
                                                  </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm"><strong>{{ $atleta->responsible_name }} </strong><br> <i class="fas fa-phone me-1" aria-hidden="true"></i> {{ $atleta->responsible_phone }} / <i class="fab fa-whatsapp me-1" aria-hidden="true"></i>{{ $atleta->responsible_whatsapp }}</td>
                                            <td class="align-middle  text-sm">
                                                <a href="{{ url('show-athlete/'.$atleta->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                                                <a href="{{ url('edit-athlete/'.$atleta->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $atleta->id }}">
                                                    <i class="material-icons">delete</i>
                                                </button>

                                            </td>
                                        </tr>
                                        @include('admin.atleta.deletemodal')
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
                    {{ $atletas->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection
