@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-secondary shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">payments</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">{{ __('Payments') }}</h4>
                        <div>
                            <form action="{{ url('pdf-payments') }}" method="GET" target="_blank">

                                <input type="hidden" name="fdesde" value="{{ $desde }}">
                                <input type="hidden" name="fhasta" value="{{ $hasta  }}">
                                <input type="hidden" name="fcui" value="{{ $queryCui  }}">
                                <input type="hidden" name="fin" value="{{ $queryIN  }}">
                                <input type="hidden" name="fcycle" value="{{ $queryCycle  }}">
                                <input type="hidden" name="fcategory" value="{{ $queryCategory  }}">
                                <input type="hidden" name="fgroup" value="{{ $queryGroup  }}">
                                <input type="hidden" name="ftype" value="{{ $queryType  }}">
                                <input type="hidden" name="fuser" value="{{ $queryUser  }}">


                                <button type="submit" class="btn btn-danger float-end m-1">
                                    <i class="material-icons opacity-10">picture_as_pdf</i> PDF
                                </button>
                            </form>
                        </div>
                        <div>
                            <form action="{{ url('export') }}" method="GET" target="_blank">

                                <input type="hidden" name="fdesde" value="{{ $desde }}">
                                <input type="hidden" name="fhasta" value="{{ $hasta  }}">
                                <input type="hidden" name="fcui" value="{{ $queryCui  }}">
                                <input type="hidden" name="fin" value="{{ $queryIN  }}">
                                <input type="hidden" name="fcycle" value="{{ $queryCycle  }}">
                                <input type="hidden" name="fcategory" value="{{ $queryCategory  }}">
                                <input type="hidden" name="fgroup" value="{{ $queryGroup  }}">
                                <input type="hidden" name="ftype" value="{{ $queryType  }}">
                                <input type="hidden" name="fuser" value="{{ $queryUser  }}">


                                <button type="submit" class="btn btn-success float-end m-1">
                                    <i class="material-icons opacity-10">description</i> Excel
                                </button>
                            </form>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <div class="row">
                        {{-- <div class="col-md-12 mb-3">
                            <a href="{{ url('add-payment') }}" class="btn btn-success">
                                <i class="material-icons opacity-10">add</i> {{ __('Add Payment') }}
                            </a>

                        </div> --}}
                        @include('admin.payment.search')
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-sm align-products-center mb-0 table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">#{{ __('Payment') }} / #Recibo</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Date') }}</th>
                                            <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Athlete') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Inscription Number') }}</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 col-4">{{ __('Payment Type') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Paid') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('User') }}</th>

                                            {{-- <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><i class="material-icons">format_list_bulleted</i></th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $exonerations = 0;
                                        @endphp
                                        @foreach ($payments as $payment)
                                        @php
                                            if($payment->type >= '3' && $payment->type <=6){
                                                $exonerations = $exonerations + $payment->paid;
                                            }
                                        @endphp
                                        <tr>
                                            <td class="align-middle text-center text-sm"><strong>{{ $payment->id }} @if ($payment->no_recibo != null) /  {{ $payment->no_recibo }} @endif</strong></td>
                                            <td class="align-middle text-center text-sm"><strong>{{ $payment->created_at->format('d-m-Y') }}</strong></td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    {{-- @if ($payment->inscription->atleta->image)
                                                        <div>
                                                            <img src="{{ asset('assets/uploads/athletes/'.$payment->inscription->atleta->image) }}" class="avatar avatar-sm me-3">
                                                        </div>
                                                    @endif --}}
                                                  <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-xs"><a href="{{ url('show-athlete/'.$payment->inscription->atleta->id) }}">{{ $payment->inscription->atleta->name }} </a></h6>
                                                    <p class="text-xs text-secondary mb-0">CUI: {{ $payment->inscription->atleta->cui_dpi }}</p>
                                                    <p class="text-xs text-secondary mb-0">{{ $payment->inscription->atleta->email }}</p>
                                                    <p class="text-xs text-secondary mb-0">{{ $payment->inscription->atleta->phone }} / {{ $payment->inscription->atleta->whatsapp }}</p>
                                                  </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-xs"><a href="{{ url('show-inscription/'.$payment->inscription_id) }}">{{ $payment->inscription->inscription_number }} </a></h6>
                                                        <p class="text-xs text-secondary mb-0">Ciclo: {{ $payment->inscription->cycle->name }}</p>
                                                        @php
                                                            $classinfo = \App\Models\Classs::find($payment->inscription->class_id);
                                                            $categoryinfo = \App\Models\Category::find($classinfo->category_id);
                                                            $userinfo = \App\Models\User::find($payment->user_id);
                                                        @endphp
                                                        <p class="text-xs text-secondary mb-0">Grupo: {{ $categoryinfo->group->name }}</p>
                                                        <p class="text-xs text-secondary mb-0">Categoría: {{ $categoryinfo->name }}</p>

                                                    </div>
                                                </div>
                                            </td>
                                            <td class="col-4 max-width-100"><strong>
                                                {{ $payment->type == '0' ? __('Inscription')
                                                    : ($payment->type == '1' ? __('Badge')
                                                    : ($payment->type == '2' ? __('Monthly')
                                                    : ($payment->type == '3' ? __('Monthly Exoneration')
                                                    : ($payment->type == '4' ? __('Monthly Exoneration')
                                                    : ($payment->type == '5' ? __('Inscription Total Exoneration')
                                                    : ($payment->type == '6' ? __('Badge Exoneration')
                                                    : ($payment->type == '7' ? __('Varios')
                                                    : "")))))))
                                                }}
                                                @if ($payment->note != null)
                                                    <br>
                                                    <p class="text-xs max-width-100 text-truncate" text-secondary mb-0">({{ $payment->note }})</p>
                                                @endif
                                            </strong></td>
                                            <td class="align-middle text-center text-sm"><strong>{{ $config->currency_simbol }}{{ number_format($payment->paid,2, '.', ',') }}</strong></td>
                                            <td class="align-middle text-center text-sm"><strong>{{ $userinfo->name }}</strong><br>
                                                ({{ $userinfo->role_as == '1' ? __('Admin')
                                                : ($userinfo->role_as == '0' ? __('User')
                                                : ($userinfo->role_as == '3' ? __('Instructor')
                                                : "")) }})
                                            </td>

                                            <td class="align-middle  text-sm">
                                                <a href="{{ url('show-payment/'.$payment->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                                                {{-- <a href="{{ url('edit-athlete/'.$payment->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $payment->id }}">
                                                    <i class="material-icons">delete</i>
                                                </button> --}}

                                            </td>
                                        </tr>
                                        {{-- @include('admin.atleta.deletemodal') --}}
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td class="align-middle text-rigth text-sm"><h6><b>{{ __('Payments') }}:</b></h6></td>
                                            <td class="align-middle text-center text-sm"><h6><b><font color="limegreen">{{ $config->currency_simbol }}{{ number_format($total-$exonerations,2, '.', ',') }}</font></b></h6></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td class="align-middle text-rigth text-sm"><h6><b>{{ __('Exonerations') }}:</b></h6></td>
                                            <td class="align-middle text-center text-sm"><h6><b><font color="orange">{{ $config->currency_simbol }}{{ number_format($exonerations,2, '.', ',') }}</font></b></h6></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td class="align-middle text-rigth text-sm"><h4><b>Total:</b></h4></td>
                                            <td class="align-middle text-center text-sm"><h4><b><font color="blue">{{ $config->currency_simbol }}{{ number_format($total,2, '.', ',') }}</font></b></h4></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
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
