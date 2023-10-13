@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-info shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">group_work</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">{{ __('Groups') }}</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <h4><u>{{ __('Group') }}: </u>{{ $group->name }}</h4>
                    <h4><u>{{ __('Category') }}: </u>{{ $category->name }}</h4>
                    <div>
                        <a href="{{ url('edit-category/'.$category->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                        <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal-{{ $category->id }}">
                            <i class="material-icons">delete</i>
                        </button>
                        @include('admin.group.deletecategorymodal')

                    </div>
                    <div class="row">
                        {{-- <div class="col-md-6 mb-3">
                            <label for=""><strong>{{ __('Name') }}</strong></label>
                            <p>{{ $category->name }}</p>
                        </div> --}}
                        @if ($category->image)
                            <div class="col-md-3 mb-3">
                                <label for=""><strong>{{ __('Image') }} </strong></label><br>
                                <img class="border-radius-md w-50 img-fluid"
                                    src="{{ asset('assets/uploads/categories/' . $category->image) }}" alt="Image">
                            </div>
                        @endif
                        <div class="col-md-6 mb-3">
                            <label for=""><strong>{{ __('Age') }}</strong></label>
                            <p>{{ $category->age_from }} - {{ $category->age_to }} {{ __('Years') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for=""><strong>{{ __('Course duration') }}</strong></label>
                            <textarea type="text" class="form-control border px-2 " rows="5">{{ $category->description }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for=""><strong>{{ __('Registration documents') }}</strong></label>
                            <textarea type="text" class="form-control border px-2 " rows="5">{{ $category->requirements }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for=""><strong>{{ __('Implements') }}</strong></label>
                            <textarea type="text" class="form-control border px-2 " rows="5">{{ $category->implements }}</textarea>
                        </div>

                        @if ($category->contract)
                            <div class="col-md-3 mb-3">
                                <label for=""><strong>{{ __('Contract') }} </strong></label><br>
                                <a class="btn btn-danger" href="{{ asset('assets/uploads/contracts/categories/'.$category->contract) }}" target="blank"><i class="material-icons opacity-10">picture_as_pdf</i> {{ __('Download Contract') }}</a>
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
