
                <form action="{{ url('my-classes') }}" method="GET">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 mb-0">
                            <label for=""><strong>{{ __('Search') }} {{ __('Classes') }}:</strong></label>

                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="">{{ __('Cycle') }}</label>
                            <select class="form-select px-2" aria-label="Default select example" name="fcycle">
                                    @if ($queryCycle != null)
                                        @php
                                            $cycleinfo = \App\Models\Cycle::find($queryCycle);
                                        @endphp
                                        <option selected value="{{ $cycleinfo->id }}">{{ $cycleinfo->name }}</option>
                                    @else
                                        <option selected value="">{{ __('All') }}</option>
                                    @endif
                                    <option value="">{{ __('All') }}</option>
                                    @foreach ($cyclesFilter as $cycle)
                                        <option value="{{ $cycle->id }}">{{ $cycle->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="">{{ __('Category') }}</label>
                            <select class="form-select px-2" aria-label="Default select example" name="fcategory">
                                    @if ($queryCategory != null)
                                        @php
                                            $categoryinfo = \App\Models\Category::find($queryCategory);
                                        @endphp
                                        <option selected value="{{ $categoryinfo->id }}">{{ $categoryinfo->name }}</option>
                                    @else
                                        <option selected value="">{{ __('All') }}</option>
                                    @endif
                                    <option value="">{{ __('All') }}</option>
                                    @foreach ($categoriesFilter as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="">{{ __('Facilities') }}</label>
                            <select class="form-select px-2" aria-label="Default select example" name="ffacility">
                                    @if ($queryFacility != null)
                                        @php
                                            $facilityinfo = \App\Models\Facility::find($queryFacility);
                                        @endphp
                                        <option selected value="{{ $facilityinfo->id }}">{{ $facilityinfo->name }}</option>
                                    @else
                                        <option selected value="">{{ __('All') }}</option>
                                    @endif
                                    <option value="">{{ __('All') }}</option>
                                    @foreach ($facilitiesFilter as $facility)
                                        <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="">{{ __('Instructors') }}</label>
                            <select class="form-select px-2" aria-label="Default select example" name="fuser">
                                    @if ($queryUser != null)
                                        @php
                                            $userinfo = \App\Models\User::find($queryUser);
                                        @endphp
                                        <option selected value="{{ $userinfo->id }}">{{ $userinfo->name }}</option>
                                    @else
                                        <option selected value="">{{ __('All') }}</option>
                                    @endif
                                    <option value="">{{ __('All') }}</option>
                                    @foreach ($usersFilter as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-1 mb-3" >
                            <label for="">{{ __('Search') }}</label><br>
                            <button type="submit" class="btn btn-info"><i class="material-icons">search</i></button>
                        </div>
                    </div>
                </form>
