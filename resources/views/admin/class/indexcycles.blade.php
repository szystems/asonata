@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-warning shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">groups</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">{{ __('Classes') }}</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <div class="row">
                        @include('admin.cycle.search')
                        <div class="row">

                            <div class="row mb-4">
                                <div class="col-xl-12">
                                    <h4><u>{{ __('Select a cycle to view their respective classes') }}:</u></h4>
                                    <div class="row">
                                        @if ($cycles->count() != 0)
                                            @foreach ($cycles as $cycle)
                                                <div class="card" style="width: 20rem;">

                                                    <div class="card-body" align="center">
                                                        <a href="{{ url('index_classes/'.$cycle->id) }}"><h5 class="card-title"><u>{{ $cycle->name }}</u></h5></a>
                                                        <hr class="horizontal dark my-3">
                                                        @php
                                                            $start_date = date("d-m-Y", strtotime($cycle->start_date));
                                                            $end_date = date("d-m-Y", strtotime($cycle->end_date));
                                                            $classes=DB::table('class')
                                                            ->where('status',1)
                                                            ->where('cycle_id',$cycle->id)
                                                            ->get();
                                                        @endphp
                                                        <p><b><font color="limegreen">{{ $start_date }}</font> - <font color="red">{{ $end_date }}</font></b></p>
                                                        <p>{{ __('Classes') }}: {{ $classes->count() }}</p>

                                                        <a href="{{ url('index_classes/'.$cycle->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>

                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="alert alert-primary text-white" role="alert">
                                                <strong>{{ __('No cycles added or found!') }}</strong> <a href="{{ url('add-cycle') }}"> {{ __('Add Cycle') }}</a>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

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
