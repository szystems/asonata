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
                    <h4><u>{{ __('Show') }} {{ __('Group') }}: </u>{{ $group->name }}</h4>
                    <div>
                        <a href="{{ url('edit-group/'.$group->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                        <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $group->id }}">
                            <i class="material-icons">delete</i>
                        </button>
                        @include('admin.group.deletemodal')

                    </div>
                    <div class="row">
                        {{-- <div class="col-md-6 mb-3">
                            <label for=""><strong>{{ __('Name') }}</strong></label>
                            <p>{{ $group->name }}</p>
                        </div> --}}
                        @if ($group->image)
                            <div class="col-md-3 mb-3">
                                <label for=""><strong>{{ __('Image') }} </strong></label><br>
                                <img class="border-radius-md w-70 img-fluid"
                                    src="{{ asset('assets/uploads/groups/' . $group->image) }}" alt="Image">
                            </div>
                        @endif
                        <div class="col-md-9 mb-3">
                            <label for=""><strong>{{ __('Description') }}</strong></label>
                            <p>{{ $group->description }}</p>
                        </div>

                        <hr class="dark horizontal my-0">

                        <div class="card-body p-3 pt-2">
                            <div class="row">
                                <h4><u>{{ __('Categories') }} {{ $group->name }}</u></h4>
                                <div class="col-md-12 mb-3">
                                    <a href="{{ url('add-category/'.$group->id) }}" class="btn btn-success">
                                        <i class="material-icons opacity-10">add</i> {{ __('Add Category') }}
                                    </a>

                                </div>
                                <div class="row">
                                    @if ($categories->count() != 0)
                                        <div class="row mb-4">
                                            <div class="col-xl-12">
                                                <div class="row">
                                                    @foreach ($categories as $category)
                                                        <div class="card" style="width: 20rem;">
                                                            @if ($category->image)
                                                                <img class="card-img-top max-height-200" src="{{ asset('assets/uploads/categories/'.$category->image) }}">
                                                            @else
                                                                <img class="card-img-top max-height-200" src="{{ asset('assets/imgs/noimage.png') }}">
                                                            @endif

                                                            <div class="card-body" align="center">
                                                                <h5 class="card-title">{{ $category->name }}</h5>
                                                                <p class="mb-0">{{ __('Age') }}: {{ $category->age_from }} - {{ $category->age_to }} {{ __('Years') }}
                                                                <hr class="horizontal dark my-3">
                                                                <a href="{{ url('show-category/'.$category->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                                                                <a href="{{ url('edit-category/'.$category->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                                <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal-{{ $category->id }}">
                                                                    <i class="material-icons">delete</i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        @include('admin.group.deletecategorymodal')
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-primary text-white" role="alert">
                                            <strong>{{ __('No categories have been added to this group!') }}</strong> <a href="{{ url('add-category') }}"> {{ __('Add Category') }}</a>
                                        </div>
                                    @endif


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
