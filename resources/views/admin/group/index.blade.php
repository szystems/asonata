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
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="{{ url('add-group') }}" class="btn btn-success">
                                <i class="material-icons opacity-10">add</i> {{ __('Add Group') }}
                            </a>

                        </div>
                        @include('admin.group.search')
                        <div class="row">
                            {{-- <div class="table-responsive">
                                <table class="table table-sm align-products-center mb-0 table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Name') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Description') }}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Location') }}</th>
                                            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><i class="material-icons">format_list_bulleted</i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($facilities as $facility)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    @if ($facility->image)
                                                    <div>
                                                        <img src="{{ asset('assets/uploads/facilities/'.$facility->image) }}" class="avatar avatar-sm me-3">
                                                    </div>
                                                @endif
                                                  <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-xs"><a href="{{ url('show-facility/'.$facility->id) }}">{{ $facility->name }} </a></h6>
                                                  </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm"><strong>{{ $facility->description }}</td>
                                            <td class="align-middle text-center text-sm"><strong>{{ $facility->location }} </strong></td>
                                            <td class="align-middle  text-sm">
                                                <a href="{{ url('show-facility/'.$facility->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                                                <a href="{{ url('edit-facility/'.$facility->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $facility->id }}">
                                                    <i class="material-icons">delete</i>
                                                </button>

                                            </td>
                                        </tr>
                                        @include('admin.facility.deletemodal')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> --}}

                            <div class="row mb-4">
                                <div class="col-xl-12">
                                    <div class="row">
                                        @foreach ($groups as $group)
                                            <div class="card" style="width: 20rem;">
                                                @if ($group->image)
                                                    <img class="card-img-top max-height-200" src="{{ asset('assets/uploads/groups/'.$group->image) }}">
                                                @else
                                                    <img class="card-img-top max-height-200" src="{{ asset('assets/imgs/noimage.png') }}">
                                                @endif

                                                <div class="card-body" align="center">
                                                    <h5 class="card-title">{{ $group->name }}</h5>
                                                    @php
                                                        $categories=DB::table('categories')
                                                        ->where('status',1)
                                                        ->where('group_id',$group->id)
                                                        ->orderBy('name','asc')
                                                        ->get();
                                                    @endphp
                                                    <p>{{ __('Categories') }}: {{ $categories->count(); }}</p>
                                                    <hr class="horizontal dark my-3">
                                                    <a href="{{ url('show-group/'.$group->id) }}" type="button" class="btn btn-info"><i class="material-icons">visibility</i></a>
                                                    <a href="{{ url('edit-group/'.$group->id) }}" type="button" class="btn btn-warning"><i class="material-icons">edit</i></a>
                                                    <button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $group->id }}">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </div>
                                            </div>
                                            @include('admin.group.deletemodal')
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
