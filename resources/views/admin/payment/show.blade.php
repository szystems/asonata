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
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <h4><u>{{ __('Show') }} {{ __('Payment') }}</u></h4>
                    {{-- <div>
                        <form action="{{ url('pdf-athlete') }}" method="GET" target="_blank">
                            <input type="hidden" name="ratleta" value="{{ $atleta->id }}">
                            <button type="submit" class="btn btn-danger float-end">
                                <i class="material-icons opacity-10">picture_as_pdf</i> PDF
                            </button>
                        </form>
                        <a href="{{ url('edit-athlete/'.$atleta->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                        <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $atleta->id }}">
                            <i class="material-icons">delete</i>
                        </button>
                        @include('admin.atleta.deletemodal')

                    </div> --}}
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label for=""><strong>{{ __('Athlete') }}</strong></label>
                            <div class="d-flex px-2 py-1">
                                @if ($payment->inscription->atleta->image)
                                <div>
                                    <img src="{{ asset('assets/uploads/athletes/'.$payment->inscription->atleta->image) }}" class="avatar avatar-sm me-3">
                                </div>
                            @endif
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-xs"><a href="{{ url('show-athlete/'.$payment->inscription->atleta->id) }}">{{ $payment->inscription->atleta->name }} </a></h6>
                                <p class="text-xs text-secondary mb-0">CUI: {{ $payment->inscription->atleta->cui_dpi }}</p>
                                <p class="text-xs text-secondary mb-0">{{ $payment->inscription->atleta->email }}</p>
                              </div>
                            </div>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for=""><strong>{{ __('Inscription Number') }}</strong></label>

                            <div class="d-flex px-2 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-xs"><a href="{{ url('show-inscription/'.$payment->inscription_id) }}">{{ $payment->inscription->inscription_number }} </a></h6>
                                <p class="text-xs text-secondary mb-0">{{ __('Cycle') }}: {{ $payment->inscription->cycle->name }}</p>
                                @php
                                    $classinfo = \App\Models\Classs::find($payment->inscription->class_id);
                                    $categoryinfo = \App\Models\Category::find($classinfo->category_id);
                                    $userinfo = \App\Models\User::find($payment->user_id);
                                @endphp
                                <p class="text-xs text-secondary mb-0">{{ $categoryinfo->name }} ({{ $categoryinfo->group->name }})</p>
                              </div>
                            </div>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for=""><strong>{{ __('Date') }}</strong></label>
                            <div class="d-flex px-2 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-xs">{{ $payment->created_at->format('d-m-Y') }}</h6>
                              </div>
                            </div>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for=""><strong>{{ __('Payment Type') }}</strong></label>
                            <p>
                                {{ $payment->type == '0' ? __('Inscription')
                                    : ($payment->type == '1' ? __('Badge')
                                    : ($payment->type == '2' ? __('Monthly')
                                    : ($payment->type == '3' ? __('Exoneration')
                                    : "")))
                                }}
                            </p>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for=""><strong>{{ __('User') }}</strong></label>
                            <p>{{ $userinfo->name }}</br>
                                ({{ $userinfo->role_as == '1' ? __('Admin')
                                : ($userinfo->role_as == '0' ? __('User')
                                : ($userinfo->role_as == '3' ? __('Instructor')
                                : "")) }})
                            </p>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for=""><strong>{{ __('Paid') }}</strong></label>
                            <p>{{ $config->currency_simbol }}{{ number_format($payment->paid,2, '.', ',') }}</p>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for=""><strong>{{ __('Note') }}</strong></label>
                            <p>{{ $payment->note }}</p>
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
