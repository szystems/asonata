@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-info shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">rotate_left</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">{{ __('Cycles') }}</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <h4><u>{{ __('Add Cycle') }}</u></h4>
                    @if (count($errors)>0)
                        <div class="alert alert-danger text-white" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                      <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif
                    <form action="{{ url('insert-cycle') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="">{{ __('Name') }}</label>
                                <input type="text" class="form-control border px-2 " name="name" value="{{ old('name') }}" >
                                @if ($errors->has('name'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('name') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Start Date') }} </label>
                                    <div class="input-daterange input-group" >
                                        <div class="input-group input-group-dynamic mb-4">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control" id="startdate" aria-label="Amount (to the nearest dollar)" name="start_date" value="{{ old('start_date') }}" >
                                        </div>
                                    </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('End Date') }} </label>
                                    <div class="input-daterange input-group" >
                                        <div class="input-group input-group-dynamic mb-4">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control" id="enddate" aria-label="Amount (to the nearest dollar)" name="end_date" value="{{ old('end_date') }}" >
                                        </div>
                                    </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">{{ __('Description') }}</label><br>
                                <textarea class="form-control border px-2" name="description" rows="5">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('description') }}</font>
                                            </strong>
                                    </span>
                                @endif
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

    <script>
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

        var optSimple = {
            format: "dd-mm-yyyy",
            language: "es",
            autoclose: true,
            todayHighlight: true,
            todayBtn: "linked",
            orientation: "bottom auto"
        };
        $( '#startdate' ).datepicker( optSimple );
        $( '#enddate' ).datepicker( optSimple );
    </script>

@endsection


