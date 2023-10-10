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
                    <h4><u>{{ __('Edit') }} {{ __('Category') }}</u></h4>
                    @if (count($errors)>0)
                        <div class="alert alert-danger text-white" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                      <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif
                    <form action="{{ url('update-category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">{{ __('Name') }}</label>
                                <input type="text" class="form-control border px-2 " name="name" value="{{ $category->name }}" >
                                @if ($errors->has('name'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('name') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Age from') }}</label>
                                <input type="number" class="form-control border px-2 " name="age_from" step="any" value="{{ $category->age_from }}" >
                                @if ($errors->has('age_from'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('age_from') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Age to') }}</label>
                                <input type="number" class="form-control border px-2 " name="age_to" step="any" value="{{ $category->age_to }}" >
                                @if ($errors->has('age_to'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('age_to') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">{{ __('Description') }}</label>
                                <textarea type="text" class="form-control border px-2 " rows="5" name="description">{{  $category->description  }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('description') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">{{ __('Requirements') }}</label><br>
                                <textarea class="form-control border px-2" name="requirements" rows="5">{{ $category->requirements }}</textarea>
                                @if ($errors->has('requirements'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('requirements') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">{{ __('Implements') }}</label><br>
                                <textarea class="form-control border px-2" name="implements" rows="5">{{ $category->implements }}</textarea>
                                @if ($errors->has('implements'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('implements') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>


                            @if ($category->image)
                                <div class="col-md-12 mb-3">
                                    <img class="border-radius-md w-25 img-fluid" src="{{ asset('assets/uploads/categories/' . $category->image) }}" alt="Image">
                                </div>
                            @endif

                            <div class="col-md-12 mb-3">
                                <label for="">{{ __('Change Image') }}</label>
                                <input type="file" name="image" class="form-control border">
                            </div>

                            <div class="col-md-12 mb-3" >
                                <button type="submit" class="btn btn-success"><i class="material-icons">save</i> {{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> --}}
                </div>
            </div>
        </div>

    </div>

@endsection
