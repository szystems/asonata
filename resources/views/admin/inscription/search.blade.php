
                <form action="{{ url('inscriptions') }}" method="GET">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 mb-0">
                            <label for=""><strong>{{ __('Search') }} {{ __('Inscription') }}:</strong></label>

                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">{{ __('Inscription Number') }}</label>
                            <input class="form-control border px-2 " list="userListOptions" placeholder="{{ __('INSC-XXXXXXXXXXXX') }}" name="finscription" @if($queryInscription != null) value="{{ $queryInscription }}" @else value="" @endif>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="">{{ __('Status') }}</label>
                            <select class="form-select px-2" aria-label="Default select example" name="fstatus">
                                @if( $queryStatus != null)
                                    <option value="{{ $queryStatus }}">
                                    {{
                                        $queryStatus == '0' ? __('Pending')
                                        : ($queryStatus == '1' ? __('Confirmed')
                                        : ($queryStatus == '2' ? __('Rejected')
                                        : ($queryStatus == '3' ? __('Expelled')
                                        : ($queryStatus == '4' ? __('Retired')
                                        : ($queryStatus == '5' ? __('Promoted')
                                        : "")))))
                                    }}</option>
                                @endif
                                <option value="">{{ __('All') }}</option>
                                <option value="0">{{ __('Pending') }}</option>
                                <option value="1">{{ __('Confirmed') }}</option>
                                <option value="2">{{ __('Rejected') }}</option>
                                <option value="3">{{ __('Expelled') }}</option>
                                <option value="4">{{ __('Retired') }}</option>
                                <option value="5">{{ __('Promoted') }}</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3" >
                            <label for="">{{ __('Search') }}</label><br>
                            <button type="submit" class="btn btn-info "><i class="material-icons">search</i></button>
                        </div>
                    </div>
                </form>
