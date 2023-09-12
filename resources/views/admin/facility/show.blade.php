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
                    <h4><u>{{ __('Show') }} {{ __('Facility') }}</u></h4>
                    <div>
                        <a href="{{ url('edit-facility/'.$facility->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                        <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $facility->id }}">
                            <i class="material-icons">delete</i>
                        </button>
                        @include('admin.facility.deletemodal')

                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for=""><strong>{{ __('Name') }}</strong></label>
                            <p>{{ $facility->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for=""><strong>{{ __('Description') }}</strong></label>
                            <p>{{ $facility->description }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for=""><strong>{{ __('Location') }}</strong></label>
                            <p>{{ $facility->location }}</p>
                        </div>
                        @if ($facility->image)
                            <div class="col-md-12 mb-3">
                                <label for=""><strong>{{ __('Image') }} </strong></label><br>
                                <img class="border-radius-md w-25 img-fluid"
                                    src="{{ asset('assets/uploads/facilities/' . $facility->image) }}" alt="Image">
                            </div>
                        @endif
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> --}}
                    </div>
                </div>
            </div>

        </div>
    @endsection
