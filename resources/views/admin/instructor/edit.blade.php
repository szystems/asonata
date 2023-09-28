@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-warning shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">sports</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">{{ __('Instructors') }}</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <h4><u>{{ __('Edit') }} {{ __('Instructor') }}</u></h4>
                    @if (count($errors)>0)
                        <div class="alert alert-danger text-white" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                      <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif
                    <form action="{{ url('update-instructor/'.$user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Role') }}</label>
                                <input readonly type="text" class="form-control border px-2 " name="role_as" value="{{ $user->role_as == '3' ? __('Instructor') : '' }}" >
                                @if ($errors->has('role_as'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('role_as') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Name') }}</label>
                                <input disabled type="text" class="form-control border px-2 " value="{{ $user->name }}" >
                                <input type="hidden" name="name" value="{{ $user->name }}">
                                @if ($errors->has('name'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('name') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">Email</label>
                                <input disabled type="text" class="form-control border px-2 " value="{{ $user->email }}" >
                                <input type="hidden" name="email" value="{{ $user->email }}">
                                @if ($errors->has('email'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('email') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Phone') }}</label>
                                <input type="text" class="form-control border px-2 " name="phone" value="{{ $user->phone }}" >
                                @if ($errors->has('phone'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('phone') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">{{ __('Whatsapp') }}</label>
                                <input type="text" class="form-control border px-2 " name="whatsapp" value="{{ $user->whatsapp }}" >
                                @if ($errors->has('whatsapp'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('whatsapp') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">{{ __('Address') }} 1</label>
                                <input type="text" class="form-control border px-2 " name="address1" value="{{ $user->address1 }}" >
                                @if ($errors->has('address1'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('address1') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">{{ __('Address') }} 2</label>
                                <input type="text" class="form-control border px-2 " name="address2" value="{{ $user->address2 }}" >
                                @if ($errors->has('address2'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('address2') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('City') }}</label>
                                <input type="text" class="form-control border px-2 " name="city" value="{{ $user->city }}" >
                                @if ($errors->has('city'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('city') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('State') }}</label>
                                <input type="text" class="form-control border px-2 " name="state" value="{{ $user->state }}" >
                                @if ($errors->has('state'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('state') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Country') }}</label>
                                <input readonly type="text" class="form-control border px-2 " name="country" value="{{ $user->country }}" value="Guatemala">
                                @if ($errors->has('country'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('country') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Zipcode') }}</label>
                                <input type="text" class="form-control border px-2 " name="zipcode" value="{{ $user->zipcode }}" >
                                @if ($errors->has('zipcode'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('zipcode') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">{{ __('Timezone') }}</label>
                                <select class="form-select px-2" aria-label="Default select example" name="timezone" id="timezone">
                                    <option selected value="{{ $user->timezone }}">{{ $user->timezone }}</option>
                                    @foreach(Helpers::getTimeZoneList() as $timezone => $timezone_gmt_diff)
                                        <option value="{{ $timezone }}" {{ ( $timezone === old('timezone', $user->timezone)) ? 'selected' : '' }}>
                                            {{ $timezone_gmt_diff }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="">{{ __('Description') }}</label>
                                <textarea class="form-control border px-2 " name="description" cols="30" rows="10">{{ $user->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('description') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>

                            @if ($user->image)
                                <div class="col-md-12 mb-3">
                                    <img class="border-radius-md w-25 img-fluid"
                                        src="{{ asset('assets/uploads/users/' . $user->image) }}" alt="user Image">
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
