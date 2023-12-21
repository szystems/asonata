@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-secondary shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">checklist_rtl</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">{{ __('Assists') }}</h4>
                        <div>
                            <form action="{{ url('pdf-assists') }}" method="GET" target="_blank">

                                <input type="hidden" name="fdesde" value="{{ $desde }}">
                                <input type="hidden" name="fhasta" value="{{ $hasta  }}">
                                <input type="hidden" name="fcui" value="{{ $queryCui  }}">
                                <input type="hidden" name="fcycle" value="{{ $queryCycle  }}">
                                <input type="hidden" name="fcategory" value="{{ $queryCategory  }}">
                                <input type="hidden" name="fgroup" value="{{ $queryGroup  }}">


                                <button type="submit" class="btn btn-danger float-end">
                                    <i class="material-icons opacity-10">picture_as_pdf</i> PDF
                                </button>
                            </form>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <div class="row">
                        @include('admin.assist.search')
                        <div class="row">
                            {{-- <div class="p-0 position-relative mt-n4 mx-3 z-index-2">
                                <span class="badge badge-sm bg-gradient-success float-end">
                                    <i class="	far fa-check-square text-white" aria-hidden="true"></i> = {{ $presentes->count() }}
                                </span>
                                <span class="badge badge-sm bg-gradient-danger float-end">
                                    <i class="fas fa-ban text-white" aria-hidden="true"></i> = {{ $noPresentes->count() }}
                                </span>
                            </div> --}}
                            <div class="table-responsive">
                                <table class="table table-sm align-products-center mb-0 table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Date') }}</th>
                                            <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Athlete') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Class') }}</th>
                                            <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-15 ps-2">
                                                <span class="badge badge-sm bg-gradient-success">
                                                    <i class="	far fa-check-square text-white" aria-hidden="true"></i> = {{ $presentes->count() }}
                                                </span>
                                                <span class="badge badge-sm bg-gradient-danger">
                                                    <i class="fas fa-ban text-white" aria-hidden="true"></i> = {{ $noPresentes->count() }}
                                                </span>
                                            </th>
                                            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><i class="material-icons">format_list_bulleted</i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendances as $attendance)
                                        @php
                                            $assistinfo = \App\Models\Assist::find($attendance->assist_id);
                                            $atletainfo = \App\Models\Atleta::find($attendance->atleta_id);
                                            $classinfo = \App\Models\Classs::find($assistinfo->class_id);
                                            $categoryinfo = \App\Models\Category::find($classinfo->category_id);
                                            $cycleinfo = \App\Models\Cycle::find($classinfo->cycle_id);
                                        @endphp
                                        <tr>
                                            <td class="align-middle text-center text-sm"><strong>{{ $attendance->created_at->format('d-m-Y') }}</strong></td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    @if ($attendance->atleta->image)
                                                    <div>
                                                        <img src="{{ asset('assets/uploads/athletes/'.$attendance->atleta->image) }}" class="avatar avatar-sm me-3">
                                                    </div>
                                                @endif
                                                  <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-xs"><a href="{{ url('show-athlete/'.$attendance->atleta_id) }}">{{ $attendance->atleta->name }} </a></h6>
                                                    <p class="text-xs text-secondary mb-0">CUI: {{ $attendance->atleta->cui_dpi }}</p>
                                                    <p class="text-xs text-secondary mb-0">{{ $attendance->atleta->email }}</p>
                                                    <p class="text-xs text-secondary mb-0">{{ $attendance->atleta->phone }} / {{ $attendance->atleta->whatsapp }}</p>
                                                  </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                        <h6 class="mb-0 text-xs"><a href="{{ url('show-class/'.$attendance->assist->class_id) }}">{{ $categoryinfo->name }} ({{ $categoryinfo->group->name }})</a></h6>
                                                        <p class="text-xs text-secondary mb-0">Categoría: {{ $categoryinfo->name }}</p>
                                                        <p class="text-xs text-secondary mb-0">Grupo: {{ $categoryinfo->group->name }}</p>
                                                        <p class="text-xs text-secondary mb-0">Ciclo: {{ $cycleinfo->name }}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-{{ $attendance->status == 0 ? 'danger':'success' }}">
                                                    @if ($attendance->status == 0)
                                                        <i class="fas fa-ban text-white" aria-hidden="true"></i>
                                                    @else
                                                    <i class="	far fa-check-square text-white" aria-hidden="true"></i>
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="align-middle  text-sm">
                                                <a href="{{ url('show-assist/'.$attendance->assist_id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>

                                            </td>
                                        </tr>
                                        {{-- @include('admin.atleta.deletemodal') --}}
                                        @endforeach
                                    </tbody>
                                    {{-- <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td class="align-middle text-rigth text-sm"><h4><b>Total:</b></h4></td>
                                            <td class="align-middle text-center text-sm"><h4><b><font color="limegreen">{{ $config->currency_simbol }}{{ number_format($total,2, '.', ',') }}</font></b></h4></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tfoot> --}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> --}}
                    {{-- {{ $payments->links() }} --}}
                </div>
            </div>
        </div>

    </div>
@endsection
