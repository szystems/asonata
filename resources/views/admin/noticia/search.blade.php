
                <form action="{{ url('index_noticias') }}" method="GET">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 mb-0">
                            <label for=""><strong>{{ __('Search') }} {{ __('Noticia') }}:</strong></label>

                        </div>
                        <div class="col-md-6 mb-3">

                            <input class="form-select px-2" placeholder="{{ __('Buscar por titulo...') }}" name="fnoticia" value="{{ $queryNoticia }}">
                        </div>
                        <div class="col-md-2 mb-3" >
                            <button type="submit" class="btn btn-info"><i class="material-icons">search</i> {{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
