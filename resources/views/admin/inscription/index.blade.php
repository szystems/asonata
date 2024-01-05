@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-warning shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">inventory</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">{{ __('Inscriptions') }}</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="{{ url('add-inscription') }}" class="btn btn-success">
                                <i class="material-icons opacity-10">add</i> {{ __('Add Inscription') }}
                            </a>

                        </div>
                        @include('admin.inscription.search')
                        @if (Auth::user()->role_as == 1)
                            <div class="col-md-12 mb-3">
                                <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteOldInscriptionsModal">
                                    <i class="material-icons">delete</i> {{ __('Delete old inscriptions') }}
                                </button>
                            </div>
                            @include('admin.inscription.deleteoldinscriptionsmodal')
                        @endif


                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-sm align-products-center mb-0 table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Date') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Inscription Number') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Athlete') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Class') }} </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Inscription') }} / {{ __('Badge') }} / {{ __('Monthly') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Assists') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Status') }}</th>
                                            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><i class="material-icons">format_list_bulleted</i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inscriptions as $inscription)
                                        <tr>
                                            @php
                                                $created_at = date("d-m-Y", strtotime($inscription->created_at));
                                                $atleta = \App\Models\Atleta::find($inscription->atleta_id);
                                                $class = \App\Models\Classs::find($inscription->class_id);
                                                $cycle = \App\Models\Cycle::find($inscription->cycle_id);
                                                $category = \App\Models\Category::find($class->category_id);

                                                //obtenemos las cabeceras de asistencias
                                                $asistenciasReales = \App\Models\Assist::where('class_id',$inscription->class_id)->get();
                                                //contamos el total de asistencias encontradas que nos da el numero maximo de asistencias
                                                $totalAsistencias = $asistenciasReales->count();

                                                //recorremos las asistencias reales para obtener el numero de asistencias del Atleta
                                                $asistencias = 0;
                                                foreach ($asistenciasReales as $asistencia) {
                                                    $attendances = \App\Models\Attendance::where('assist_id',$asistencia->id)->where('atleta_id',$inscription->atleta_id)->where('status',1)->get();
                                                    $asistencias = $asistencias + $attendances->count();
                                                }
                                            @endphp
                                            <td class="align-middle text-center text-sm"><strong>{{ $created_at }}</strong></td>
                                            <td class="align-middle text-center text-sm"><strong>{{ $inscription->inscription_number }}</strong></td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    @if ($atleta->image)
                                                        <div>
                                                            <img src="{{ asset('assets/uploads/athletes/'.$atleta->image) }}" class="avatar avatar-sm me-3">
                                                        </div>
                                                    @endif
                                                  <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-xs"><a href="{{ url('show-athlete/'.$atleta->id) }}">{{ $atleta->name }}</a></h6>
                                                    <p class="text-xs text-secondary mb-0">CUI:{{ $atleta->cui_dpi }} - <i class="fas fa-phone me-1" aria-hidden="true"></i>{{ $atleta->phone }} / <i class="fab fa-whatsapp me-1" aria-hidden="true"></i>{{ $atleta->whatsapp }} <br> <i class="far fa-envelope-open me-1" aria-hidden="true"></i>{{ $atleta->email }}</p>
                                                  </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <strong>{{ $category->name }}</strong> <br>
                                                Ciclo: {{ $cycle->name }} <br>
                                                Grupo: {{ $category->group->name }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @php
                                                    $inscriptionPayments=DB::table('payments')
                                                    ->where('inscription_id',$inscription->id)
                                                    ->whereBetween('type', [2,3])
                                                    ->get();
                                                @endphp
                                                @if($inscription->inscription_payment == 0)<span class="badge bg-warning text-dark">{{ $inscription->inscription_payment == 0 ? __('Pending') : '' }}</span>@endif @if($inscription->inscription_payment == 1)<span class="badge bg-success text-dark">{{ $inscription->inscription_payment == 1 ? __('Paid') : '' }}</span>@endif /
                                                @if($inscription->badge_payment == 0)<span class="badge bg-warning text-dark">{{ $inscription->badge_payment == 0 ? __('Pending') : '' }}</span>@endif @if($inscription->badge_payment == 1)<span class="badge bg-success text-dark">{{ $inscription->badge_payment == 1 ? __('Paid') : '' }}</span>@endif <br>
                                                {{ $config->currency_simbol }}{{ number_format($class->monthly_payment,2, '.', ',') }} @if ($inscription->payments != null) <b>({{ $inscriptionPayments->count() }}/{{ $inscription->payments }})</b>@endif
                                            </td>
                                            <td class="align-middle text-center text-sm"><strong>{{ $asistencias }} / {{ $totalAsistencias }}</strong></td>
                                            <td class="align-middle text-center text-sm"><strong>
                                                <span class="badge badge-sm bg-gradient-{{
                                                $inscription->inscription_status == '0' ? 'warning'
                                                : ($inscription->inscription_status == '1' ? 'success'
                                                : ($inscription->inscription_status == '2' ? 'danger'
                                                : ($inscription->inscription_status == '3' ? 'dark'
                                                : ($inscription->inscription_status == '4' ? 'secondary'
                                                : ($inscription->inscription_status == '5' ? 'info' : ""
                                                ))))) }}">
                                                    {{ $inscription->inscription_status == '0' ? __('Pending')
                                                    : ($inscription->inscription_status == '1' ? __('Confirmed')
                                                    : ($inscription->inscription_status == '2' ? __('Rejected')
                                                    : ($inscription->inscription_status == '3' ? __('Expelled')
                                                    : ($inscription->inscription_status == '4' ? __('Retired')
                                                    : ($inscription->inscription_status == '5' ? __('Promoted') : ""
                                                    ))))) }}
                                                </span>
                                            </strong></td>
                                            <td class="align-middle  text-sm">
                                                <a href="{{ url('show-inscription/'.$inscription->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                                                <a href="{{ url('edit-inscription/'.$inscription->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $inscription->id }}">
                                                    <i class="material-icons">delete</i>
                                                </button>

                                            </td>
                                        </tr>
                                        @include('admin.inscription.deletemodal')
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
                   {{ $inscriptions->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection
