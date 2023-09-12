@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-info shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">waves</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">{{ __('Facilities') }}</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="{{ url('add-facility') }}" class="btn btn-success">
                                <i class="material-icons opacity-10">add</i> {{ __('Add Facility') }}
                            </a>

                        </div>
                        @include('admin.facility.search')
                        <div class="row">

                            <div class="row mb-4">
                                <div class="col-xl-12">
                                    <div class="row">
                                        @foreach ($facilities as $facility)
                                            <div class="card" style="width: 20rem;">
                                                @if ($facility->image)
                                                    <img class="card-img-top max-height-150" src="{{ asset('assets/uploads/facilities/'.$facility->image) }}">
                                                @else
                                                    <img class="card-img-top max-height-150" src="{{ asset('assets/imgs/noimage.png') }}">
                                                @endif

                                                <div class="card-body" align="center">
                                                    <h5 class="card-title">{{ $facility->name }}</h5>
                                                    <hr class="horizontal dark my-3">
                                                    <a href="{{ url('show-facility/'.$facility->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                                                    <a href="{{ url('edit-facility/'.$facility->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                    <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $facility->id }}">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </div>
                                            </div>
                                            @include('admin.facility.deletemodal')
                                        @endforeach
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
