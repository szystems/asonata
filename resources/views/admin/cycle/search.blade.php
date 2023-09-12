
                <form action="{{ url('index_cycles') }}" method="GET">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 mb-0">
                            <label for=""><strong>{{ __('Search') }} {{ __('Cycle') }}:</strong></label>

                        </div>
                        <div class="col-md-6 mb-3">

                            <input class="form-select px-2" list="userListOptions" placeholder="{{ __('Search by Name...') }}" name="fcycle" value="{{ $queryCycle }}">
                            <datalist id="facilityListOptions">
                                <option value="">All</option>
                                @if ($queryCycle != null)
                                    <option selected value="{{ $queryCycle }}" >{{ $queryCycle }}</option>
                                @endif
                                @foreach ($filterCycles as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </datalist>
                            {{-- </select> --}}
                        </div>
                        <div class="col-md-2 mb-3" >
                            <button type="submit" class="btn btn-info"><i class="material-icons">search</i> {{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
