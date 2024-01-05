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
                                                        <a href="{{ url('index_classes/'.$cycle->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                                                        <hr class="horizontal dark my-3">
                                                        <a href="{{ url('index_classes/'.$cycle->id) }}"><h5 class="card-title"><u>{{ $cycle->name }}</u></h5></a>
                                                        <hr class="horizontal dark my-3">
                                                        @php
                                                            $start_date = date("d-m-Y", strtotime($cycle->start_date));
                                                            $end_date = date("d-m-Y", strtotime($cycle->end_date));
                                                            $classes=DB::table('class')
                                                            ->where('status',1)
                                                            ->where('cycle_id',$cycle->id)
                                                            ->get();

                                                            $athlets=DB::table('inscriptions')
                                                            ->where('cycle_id',$cycle->id)
                                                            ->where('inscription_status', 1)
                                                            ->get();
                                                        @endphp
                                                        <p><b><font color="limegreen">{{ $start_date }}</font> - <font color="red">{{ $end_date }}</font></b></p>
                                                        <p>
                                                            <b>{{ __('Classes') }}:</b> {{ $classes->count() }} <br>
                                                            <b>{{ __('Athletes') }}:</b> {{ $athlets->count() }} <br>
                                                            @if ($athlets->count() != 0)
                                                            <b><u>{{ __('Tallas') }}:</u></b> <br>
                                                            @endif
                                                            @php
                                                                $talla = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
                                                                //21 = XL
                                                                //20 = L
                                                                //19 = M
                                                                //18 = S
                                                            @endphp
                                                            @foreach ($athlets as $athlet)
                                                                @php
                                                                    $atleta = \App\Models\Atleta::find($athlet->atleta_id);

                                                                    for ($i=0; $i <= 16 ; $i++) {
                                                                        if($atleta->tshirt_size == $i)
                                                                        {
                                                                            $talla[$i]++;
                                                                        }

                                                                    }
                                                                    if ($atleta->tshirt_size == "XL") {
                                                                            $talla[20]++;
                                                                    }
                                                                    if ($atleta->tshirt_size == "L") {
                                                                        $talla[19]++;
                                                                    }

                                                                    if ($atleta->tshirt_size == "M") {
                                                                        $talla[18]++;
                                                                    }
                                                                    if ($atleta->tshirt_size == "S") {
                                                                        $talla[17]++;
                                                                    }
                                                                @endphp
                                                            @endforeach
                                                            @if ($talla[17] != 0)
                                                                <p class="text-xs text-secondary mb-0"><b>S:</b>&nbsp;&nbsp;{{$talla[17]}}</p>
                                                            @endif
                                                            @if ($talla[18] != 0)
                                                                <p class="text-xs text-secondary mb-0"><b>M:</b>&nbsp;&nbsp;{{$talla[18]}}</p>
                                                            @endif
                                                            @if ($talla[19] != 0)
                                                                <p class="text-xs text-secondary mb-0"><b>L:</b>&nbsp;&nbsp;{{$talla[19]}}</p>
                                                            @endif
                                                            @if ($talla[20] != 0)
                                                                <p class="text-xs text-secondary mb-0"><b>XL:</b>&nbsp;&nbsp;{{$talla[20]}}</p>
                                                            @endif
                                                            @for ($i = 1; $i <= 16; $i++)
                                                                @if ($talla[$i] != 0)
                                                                    <p class="text-xs text-secondary mb-0"><b>{{$i}}:</b>&nbsp;&nbsp;{{$talla[$i]}}</p>
                                                                @endif
                                                            @endfor
                                                        </p>



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
