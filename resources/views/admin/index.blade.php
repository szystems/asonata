@extends('layouts.admin')

@section('content')
    <div class="row">

        {{-- <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
        <div class="card background">
        <div class="card-header p-3 pt-2">
            <div
                class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">dashboard</i>
            </div>
            <div class="text-center pt-1">
                <h4 class="mb-0">Dashboard</h4>
            </div>
            <hr class="dark horizontal my-0">
        </div> --}}
        <div class="row mb-4">
            <div class="col-xl-12">
                <div class="row">

                    @if (Auth::user()->role_as != 3)
                        <div class="col-md-2 col-6">
                            <div class="card">
                                <a href="{{ url('inscriptions') }}">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div
                                            class="icon icon-shape icon-lg bg-gradient-warning shadow text-center border-radius-lg">
                                            <i class="material-icons opacity-10">inventory</i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        {{-- <h6 class="text-center mb-0">Paypal</h6>
                                        <span class="text-xs">Freelance Payment</span> --}}
                                        <hr class="horizontal dark my-3">
                                        @php
                            $inscriptionsBadge = \App\Models\Inscription::where('inscription_status',0)->where('status',1)->get();
                        @endphp
                                        <h5 class="mb-0">{{ __('Inscriptions') }}&nbsp<span class="badge bg-primary">{{ $inscriptionsBadge->count() }}</span></h5>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-2 col-6">
                            <div class="card">
                                <a href="{{ url('instructores') }}">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div
                                            class="icon icon-shape icon-lg bg-gradient-warning shadow text-center border-radius-lg">
                                            <i class="material-icons opacity-10">sports</i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        {{-- <h6 class="text-center mb-0">Paypal</h6>
                                        <span class="text-xs">Freelance Payment</span> --}}
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ __('Instructors') }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-2 col-6">
                            <div class="card">
                                <a href="{{ url('/index_athletes') }}">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div
                                            class="icon icon-shape icon-lg bg-gradient-warning shadow text-center border-radius-lg">
                                            <i class="material-icons opacity-10">pool</i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        {{-- <h6 class="text-center mb-0">Paypal</h6>
                                        <span class="text-xs">Freelance Payment</span> --}}
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ __('Athletes') }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-2 col-6">
                            <div class="card">
                                <a href="{{ url('/index_cycle_classes') }}">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div
                                            class="icon icon-shape icon-lg bg-gradient-warning shadow text-center border-radius-lg">
                                            <i class="material-icons opacity-10">groups</i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        {{-- <h6 class="text-center mb-0">Paypal</h6>
                                        <span class="text-xs">Freelance Payment</span> --}}
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ __('Classes') }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-2 col-6">
                            <div class="card">
                                <a href="{{ url('/index_asistencias') }}">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div
                                            class="icon icon-shape icon-lg bg-gradient-secondary shadow text-center border-radius-lg">
                                            <i class="material-icons opacity-10">checklist_rtl</i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        {{-- <h6 class="text-center mb-0">Paypal</h6>
                                        <span class="text-xs">Freelance Payment</span> --}}
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ __('Assists') }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-2 col-6">
                            <div class="card">
                                <a href="{{ url('/index_payments') }}">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div
                                            class="icon icon-shape icon-lg bg-gradient-secondary shadow text-center border-radius-lg">
                                            <i class="material-icons opacity-10">payments</i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        {{-- <h6 class="text-center mb-0">Paypal</h6>
                                        <span class="text-xs">Freelance Payment</span> --}}
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ __('Payments') }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @if (Auth::user()->role_as != "0")


                            <div class="col-md-2 col-6">
                                <div class="card">
                                    <a href="{{ url('/index_facilities') }}">
                                        <div class="card-header mx-4 p-3 text-center">
                                            <div
                                                class="icon icon-shape icon-lg bg-gradient-info shadow text-center border-radius-lg">
                                                <i class="material-icons opacity-10">waves</i>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 p-3 text-center">
                                            {{-- <h6 class="text-center mb-0">Paypal</h6>
                                            <span class="text-xs">Freelance Payment</span> --}}
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0">{{ __('Facilities') }}</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-2 col-6">
                                <div class="card">
                                    <a href="{{ url('/index_groups') }}">
                                        <div class="card-header mx-4 p-3 text-center">
                                            <div
                                                class="icon icon-shape icon-lg bg-gradient-info shadow text-center border-radius-lg">
                                                <i class="material-icons opacity-10">group_work</i>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 p-3 text-center">
                                            {{-- <h6 class="text-center mb-0">Paypal</h6>
                                            <span class="text-xs">Freelance Payment</span> --}}
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0">{{ __('Groups') }}</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class="card">
                                    <a href="{{ url('/index_cycles') }}">
                                        <div class="card-header mx-4 p-3 text-center">
                                            <div
                                                class="icon icon-shape icon-lg bg-gradient-info shadow text-center border-radius-lg">
                                                <i class="material-icons opacity-10">rotate_left</i>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 p-3 text-center">
                                            {{-- <h6 class="text-center mb-0">Paypal</h6>
                                            <span class="text-xs">Freelance Payment</span> --}}
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0">{{ __('Cycles') }}/{{ __('Schedules') }}/{{ __('Quota') }}</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-2 col-6">
                                <div class="card">
                                    <a href="{{ url('users') }}">
                                        <div class="card-header mx-4 p-3 text-center">
                                            <div
                                                class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                                <i class="material-icons opacity-10">people_alt</i>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 p-3 text-center">
                                            {{-- <h6 class="text-center mb-0">Paypal</h6>
                                            <span class="text-xs">Freelance Payment</span> --}}
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0">{{ __('Users') }}</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class="card">
                                    <a href="{{ url('config') }}">
                                        <div class="card-header mx-4 p-3 text-center">
                                            <div
                                                class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                                <i class="material-icons opacity-10">settings</i>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 p-3 text-center">
                                            {{-- <h6 class="text-center mb-0">Paypal</h6>
                                            <span class="text-xs">Freelance Payment</span> --}}
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0">{{ __('Settings') }}</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="col-md-2 col-6">
                            <div class="card">
                                <a href="{{ url('/my-classes') }}">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div
                                            class="icon icon-shape icon-lg bg-gradient-warning shadow text-center border-radius-lg">
                                            <i class="material-icons opacity-10">groups</i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        {{-- <h6 class="text-center mb-0">Paypal</h6>
                                        <span class="text-xs">Freelance Payment</span> --}}
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ __('My Classes') }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="col-md-2 col-6">
                        <div class="card">
                            <a href="{{ url('show-user/'.Auth::id()) }}">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-lg">
                                        <i class="material-icons opacity-10">person</i>
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    {{-- <h6 class="text-center mb-0">Salary</h6>
                                    <span class="text-xs">Belong Interactive</span> --}}
                                    <hr class="horizontal dark my-3">
                                    <h5 class="mb-0">{{ __('My Profile') }}</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (Auth::user()->role_as != 3)
            <div class="row mb-12">

                {{-- Payment Alert --}}
                <div class="col-lg-4 col-md-12 mb-md-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-12 col-7">
                                    <h5>{{ __('Pending Inscriptions') }}</h5>
                                    <hr class="horizontal dark my-3">
                                    {{-- <p class="text-sm mb-0">
                                        <i class="fas fa-exclamation-circle text-warning" aria-hidden="true"></i>
                                        <span class="font-weight-bold ms-1"></span> = {{ __('late payment less than 1 month') }}
                                    </p>
                                    <p class="text-sm mb-0">
                                        <i class="fas fa-exclamation-triangle text-danger" aria-hidden="true"></i>
                                        <span class="font-weight-bold ms-1"></span> = {{ __('Late payment more than 1 month') }}
                                    </p> --}}
                                </div>
                                <div>
                                    <form action="{{ url('inscriptions') }}" method="GET" target="_blank">
                                        <button type="submit" class="btn btn-info float-end">
                                            <i class="material-icons opacity-10">visibility</i> {{ __('View All') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                {{ __('Inscription') }}</th>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                {{ __('Athlete') }}
                                            </th>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                {{ __('Date') }}
                                            </th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach ($pendingInscriptions as $inscription)
                                            <tr>

                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm"><a href="{{ url('show-inscription/'.$inscription->id) }}">{{ $inscription->inscription_number }}</a></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                @php
                                                    $atleta = \App\Models\Atleta::find($inscription->atleta_id);
                                                @endphp
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm"><a href="{{ url('show-athlete/'.$inscription->atleta_id) }}">{{ $atleta->name }}</a></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-sm">
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column">
                                                            <h6 class="mb-0 text-sm"><a href="{{ url('show-inscription/'.$inscription->id) }}">
                                                                {{ $inscription->created_at->format('d-m-Y') }}
                                                            </a></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Payment Alert --}}
                <div class="col-lg-4 col-md-12 mb-md-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-12 col-7">
                                    <h5>{{ __('Payment Alert') }}</h5>
                                    <hr class="horizontal dark my-3">
                                    <p class="text-sm mb-0">
                                        <i class="fas fa-exclamation-circle text-warning" aria-hidden="true"></i>
                                        <span class="font-weight-bold ms-1"></span> = {{ __('late payment less than 1 month') }}
                                    </p>
                                    <p class="text-sm mb-0">
                                        <i class="fas fa-exclamation-triangle text-danger" aria-hidden="true"></i>
                                        <span class="font-weight-bold ms-1"></span> = {{ __('Late payment more than 1 month') }}
                                    </p>
                                </div>
                                <div>
                                    <form action="{{ url('pdf-alert-payments') }}" method="GET" target="_blank">
                                        <button type="submit" class="btn btn-danger float-end">
                                            <i class="material-icons opacity-10">picture_as_pdf</i> PDF
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                {{ __('Inscription') }}
                                            </th>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                {{ __('Athlete') }}
                                            </th>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                {{ __('Status') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activeInscriptions as $inscription)
                                            @php
                                                $cuotas = $inscription->payments;
                                                $cuotasPagadas = DB::table('payments')
                                                ->where('inscription_id',$inscription->id)
                                                ->where('type',2)
                                                ->get();
                                                $cuotasPendientes = $cuotas - $cuotasPagadas->count();
                                            @endphp
                                            @if ($cuotasPendientes != 0)
                                                @php
                                                    $hoy = date("Y-m-d", strtotime(now()->toDateString()));
                                                    $created_at = date("Y-m-d", strtotime($inscription->created_at));
                                                    $sumarMeses = date("Y-m-d", strtotime($created_at.'+'.$cuotasPagadas->count().' month' ));

                                                @endphp
                                                @if ($hoy > $sumarMeses)
                                                    <tr>

                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm"><a href="{{ url('show-inscription/'.$inscription->id) }}">{{ $inscription->inscription_number }}</a></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @php
                                                            $atleta = \App\Models\Atleta::find($inscription->atleta_id);
                                                        @endphp
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm"><a href="{{ url('show-athlete/'.$inscription->atleta_id) }}">{{ $atleta->name }}</a></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @php
                                                            $hoy = DateTime::createFromFormat('Y-m-d', $hoy);
                                                            $mesesDePago = DateTime::createFromFormat('Y-m-d', $sumarMeses);

                                                            $difference = $mesesDePago->diff($hoy);
                                                            // ECHO "diferencia: ".$difference->y." Años ".$difference->m." Meses ".$difference->d." Dias";

                                                            $meses = 0;
                                                            if ($difference->y > 0) {
                                                                $meses = ($meses + ($difference->y * 12));
                                                            }
                                                            if ($difference->m > 0) {
                                                                $meses = $meses + $difference->m;
                                                            }
                                                            if ($difference->d > 0) {
                                                                $meses = $meses + 1;
                                                            }
                                                        @endphp
                                                        <td class="text-sm">
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column">
                                                                    <h6 class="mb-0 text-sm"><a href="{{ url('show-inscription/'.$inscription->id) }}">
                                                                        @if ($meses == 1)
                                                                            <p class="text-sm mb-0">
                                                                                <i class="fas fa-exclamation-circle text-warning" aria-hidden="true"></i>
                                                                                <span class="font-weight-bold ms-1"></span>
                                                                            </p>
                                                                        @elseif ($meses > 1)
                                                                            <p class="text-sm mb-0">
                                                                                <i class="fas fa-exclamation-triangle text-danger" aria-hidden="true"></i>
                                                                                <span class="font-weight-bold ms-1"></span>
                                                                            </p>
                                                                        @endif
                                                                    </a></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Cycle Assists Alert --}}
                <div class="col-lg-4 col-md-12 mb-md-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-12 col-7">
                                    <h5>{{ __('Assists alerts for the current cycle') }}</small></h6>
                                        <hr class="horizontal dark my-3">
                                    <p class="text-sm mb-0">
                                        <i class="fas fa-exclamation-circle text-warning" aria-hidden="true"></i>
                                        <span class="font-weight-bold ms-1"></span> = {{ __('3 to 5 absences') }}
                                    </p>
                                    <p class="text-sm mb-0">
                                        <i class="fas fa-exclamation-triangle text-danger" aria-hidden="true"></i>
                                        <span class="font-weight-bold ms-1"></span> = {{ __('More than 5 absences') }}
                                    </p>
                                </div>
                                <div>
                                    <form action="{{ url('pdf-alert-assists') }}" method="GET" target="_blank">
                                        <button type="submit" class="btn btn-danger float-end">
                                            <i class="material-icons opacity-10">picture_as_pdf</i> PDF
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                {{ __('Inscription') }}
                                            </th>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                {{ __('Athlete') }}
                                            </th>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                {{ __('Status') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activeInscriptionsCycle as $inscription)
                                            @php
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

                                                $ausencias = $totalAsistencias - $asistencias;
                                            @endphp
                                            @if ($ausencias >= 3)
                                                @if ($asistencias != $totalAsistencias)
                                                    <tr>

                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm"><a href="{{ url('show-inscription/'.$inscription->id) }}">{{ $inscription->inscription_number }}</a></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @php
                                                            $atleta = \App\Models\Atleta::find($inscription->atleta_id);
                                                        @endphp
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm"><a href="{{ url('show-athlete/'.$inscription->atleta_id) }}">{{ $atleta->name }}</a></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-sm">
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column">
                                                                    <h6 class="mb-0 text-sm">
                                                                        <a href="{{ url('show-inscription/'.$inscription->id) }}">
                                                                            @if ($ausencias >= 3 and $ausencias <= 5)
                                                                                <p class="text-sm mb-0">
                                                                                    {{ $asistencias }} / {{ $totalAsistencias }}
                                                                                    <i class="fas fa-exclamation-circle text-warning" aria-hidden="true"></i>
                                                                                    <span class="font-weight-bold ms-1"></span>
                                                                                </p>
                                                                            @elseif ($ausencias >= 6 )
                                                                                <p class="text-sm mb-0">
                                                                                    {{ $asistencias }} / {{ $totalAsistencias }}
                                                                                    <i class="fas fa-exclamation-triangle text-danger" aria-hidden="true"></i>
                                                                                    <span class="font-weight-bold ms-1"></span>
                                                                                </p>
                                                                            @endif
                                                                        </a>
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        @else
            <div class="row mb-12">

                {{-- Instructor assists alert --}}
                <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-12 col-7">
                                    <h5>{{ __('Assists alerts for the current cycle') }}</small></h6>
                                        <hr class="horizontal dark my-3">
                                    <p class="text-sm mb-0">
                                        <i class="fas fa-exclamation-circle text-warning" aria-hidden="true"></i>
                                        <span class="font-weight-bold ms-1"></span> = {{ __('3 to 5 absences') }}
                                    </p>
                                    <p class="text-sm mb-0">
                                        <i class="fas fa-exclamation-triangle text-danger" aria-hidden="true"></i>
                                        <span class="font-weight-bold ms-1"></span> = {{ __('More than 5 absences') }}
                                    </p>
                                </div>
                                <div>
                                    <form action="{{ url('pdf-alert-assists-instructor') }}" method="GET" target="_blank">
                                        <button type="submit" class="btn btn-danger float-end">
                                            <i class="material-icons opacity-10">picture_as_pdf</i> PDF
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                {{ __('Athlete') }}
                                            </th>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                {{ __('Class') }}
                                            </th>

                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                {{ __('Instructor') }}
                                            </th>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                {{ __('Inscription') }}
                                            </th>

                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                {{ __('Status') }}
                                            </th>
                                            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><i class="material-icons">format_list_bulleted</i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activeInscriptionsCycleInstructor as $inscription)
                                            @php
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

                                                $ausencias = $totalAsistencias - $asistencias;
                                            @endphp
                                            @if ($ausencias >= 3)
                                                @if ($asistencias != $totalAsistencias)
                                                    <tr>
                                                        @php
                                                            $atleta = \App\Models\Atleta::find($inscription->atleta_id);
                                                            $class = \App\Models\Classs::find($inscription->class_id);
                                                            $cycle = \App\Models\Cycle::find($class->cycle_id);
                                                            $instructor = \App\Models\User::find($class->instructor_id);
                                                            $category = \App\Models\Category::find($class->category_id);
                                                            $scheduleClass = \App\Models\Schedule::find($class->schedule_id);
                                                            $facilityName = \App\Models\Facility::find($scheduleClass->facility_id);
                                                            $start_dateClass = date("d-m-Y", strtotime($class->start_date));
                                                            $end_dateClass = date("d-m-Y", strtotime($class->end_date));
                                                            $start_timeClass = date('h:i A', strtotime($scheduleClass->start_time));
                                                            $end_timeClass = date('h:i A', strtotime($scheduleClass->end_time));
                                                        @endphp
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                  <h6 class="mb-0 text-xs">{{ $atleta->name }}</h6>
                                                                  <p class="text-xs text-secondary mb-0">CUI: {{ $atleta->dpi }}</p>
                                                                  <p class="text-xs text-secondary mb-0"><i class="fa fa-envelope-o me-1" aria-hidden="true"></i>{{ $atleta->email }}</p>
                                                                  <p class="text-xs text-secondary mb-0"><i class="fa fa-phone me-1" aria-hidden="true"></i>{{ $atleta->phone }} @if ($atleta->whatsapp != null) / <i class="fab fa-whatsapp me-1" aria-hidden="true"></i> {{ $atleta->whatsapp }} @endif</p>
                                                                </div>
                                                              </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                              <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xs">{{ $category->name }} ({{ $cycle->name }})</h6>
                                                                <p class="text-xs text-secondary mb-0"><font color="limegreen"> {{ $start_dateClass }}</font> / </i><font color="red"> {{ $end_dateClass }}</font></p>
                                                                <p class="text-xs text-secondary mb-0"><i class="far fa-clock"></i> {{ $facilityName->name }} / {{ $start_timeClass }} - {{ $end_timeClass }} / {{ $scheduleClass->sunday == 1 ? __('Sunday').',' : '' }} {{ $scheduleClass->monday == 1 ? __('Monday').',' : '' }} {{ $scheduleClass->tuesday == 1 ? __('Tuesday').',' : '' }} {{ $scheduleClass->wednesday == 1 ? __('Wednesday').',' : '' }} {{ $scheduleClass->thursday == 1 ? __('Thursday').',' : '' }} {{ $scheduleClass->friday == 1 ? __('Friday').',' : '' }} {{ $scheduleClass->saturday == 1 ? __('Saturday').',' : '' }}</p>
                                                              </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm">{{ $instructor->name }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm">{{ $inscription->inscription_number }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-sm">
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column">
                                                                    <h6 class="mb-0 text-sm">
                                                                        @if ($ausencias >= 3 and $ausencias <= 5)
                                                                            <p class="text-sm mb-0">
                                                                                {{ $asistencias }} / {{ $totalAsistencias }}
                                                                                <i class="fas fa-exclamation-circle text-warning" aria-hidden="true"></i>
                                                                                <span class="font-weight-bold ms-1"></span>
                                                                            </p>
                                                                        @elseif ($ausencias >= 6 )
                                                                            <p class="text-sm mb-0">
                                                                                {{ $asistencias }} / {{ $totalAsistencias }}
                                                                                <i class="fas fa-exclamation-triangle text-danger" aria-hidden="true"></i>
                                                                                <span class="font-weight-bold ms-1"></span>
                                                                            </p>
                                                                        @endif
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle  text-sm">
                                                            <a href="{{ url('my-classes/'.$inscription->class_id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>

                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        @endif


    </div>
@endsection
