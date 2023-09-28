
                <form action="{{ url('index_payments') }}" method="GET">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 mb-0">
                            <label for=""><strong>{{ __('Search') }} {{ __('Payments') }}:</strong></label>

                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="">{{ __('From') }} </label>
                                <div class="input-daterange input-group" >
                                    <div class="input-group input-group-dynamic mb-4">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control" id="datepickerdesde" aria-label="Amount (to the nearest dollar)" name="fdesde" value="{{ $desde }}" >
                                    </div>

                                </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="">{{ __('To') }} </label>
                                <div class="input-daterange input-group" >
                                    <div class="input-group input-group-dynamic mb-4">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control" id="datepickerhasta" aria-label="Amount (to the nearest dollar)" name="fhasta"  value="{{ $hasta }}">
                                    </div>

                                </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="">{{ __('Athlete CUI') }}</label>
                            <input class="form-control px-2" placeholder="{{ __('Search by CUI...') }}" name="fcui" value="{{ $queryCui }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="">{{ __('Inscription Number') }}</label>
                            <input class="form-control px-2" placeholder="{{ __('INS-XXXXXXXXXX') }}" name="fin" value="{{ $queryIN }}">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="">{{ __('Cycle') }}</label>
                            <select class="form-select px-2" aria-label="Default select example" name="fcycle">
                                    @if ($queryCycle != null)
                                        <option selected value="{{ $queryCycle }}">{{ $queryCycle }}</option>
                                    @else
                                        <option selected value="">{{ __('All') }}</option>
                                    @endif
                                    <option value="">{{ __('All') }}</option>
                                    @foreach ($cyclesFilter as $cycle)
                                        <option value="{{ $cycle->name }}">{{ $cycle->name }}</option>
                                    @endforeach
                            </select>
                            {{-- </select> --}}
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="">{{ __('Category') }}</label>
                            <select class="form-select px-2" aria-label="Default select example" name="fcategory">
                                    @if ($queryCategory != null)
                                        <option selected value="{{ $queryCategory }}">{{ $queryCategory }}</option>
                                    @else
                                        <option selected value="">{{ __('All') }}</option>
                                    @endif
                                    <option value="">{{ __('All') }}</option>
                                    @foreach ($categoriesFilter as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                            </select>
                            {{-- </select> --}}
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="">{{ __('Group') }}</label>
                            <select class="form-select px-2" aria-label="Default select example" name="fgroup">
                                    @if ($queryGroup != null)
                                        <option selected value="{{ $queryGroup }}">{{ $queryGroup }}</option>
                                    @else
                                        <option selected value="">{{ __('All') }}</option>
                                    @endif
                                    <option value="">{{ __('All') }}</option>
                                    @foreach ($groupFilter as $group)
                                        <option value="{{ $group->name }}">{{ $group->name }}</option>
                                    @endforeach
                            </select>
                            {{-- </select> --}}
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="">{{ __('Payment Type') }}</label>
                            <select class="form-select px-2" aria-label="Default select example" name="ftype">
                                    @if ($queryType != null)
                                        <option selected value="{{ $queryType }}">
                                        {{ $queryType == '0' ? __('Inscription')
                                            : ($queryType == '1' ? __('Badge')
                                            : ($queryType == '2' ? __('Monthly')
                                            : ($queryType == '3' ? __('Exoneration')
                                            : "")))
                                        }}
                                        </option>
                                    @endif
                                    <option value="">{{ __('All') }}</option>
                                    <option value="0">{{ __('Inscription') }}</option>
                                    <option value="1">{{ __('Badge') }}</option>
                                    <option value="2">{{ __('Monthly') }}</option>
                                    <option value="3">{{ __('Exoneration') }}</option>
                            </select>
                            {{-- </select> --}}
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="">{{ __('Users') }}</label>
                            <select class="form-select px-2" aria-label="Default select example" name="fuser">
                                    @if ($queryUser != null)
                                        <option selected value="{{ $queryUser }}">{{ $queryUser }}</option>
                                    @else
                                        <option selected value="">{{ __('All') }}</option>
                                    @endif
                                    <option value="">{{ __('All') }}</option>
                                    @foreach ($usersFilter as $user)
                                        <option value="{{ $user->name }}">{{ $user->name }} ({{ $user->role_as == '0' ? __('User') : ($user->role_as == '1' ? __('Admin') : ($user->role_as == '3' ? __('Instructor') : "")) }})</option>
                                    @endforeach
                            </select>
                            {{-- </select> --}}
                        </div>
                        <div class="col-md-1 mb-3" >
                            <label for="">{{ __('Search') }}</label><br>
                            <button type="submit" class="btn btn-info"><i class="material-icons">search</i></button>
                        </div>
                    </div>
                </form>

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
                    $( '#datepickerdesde' ).datepicker( optSimple );

                    $( '#datepickerhasta' ).datepicker( optSimple );
                </script>
