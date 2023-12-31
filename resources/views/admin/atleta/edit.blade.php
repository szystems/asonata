@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-warning shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">pool</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">{{ __('Athletes') }}</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <h4><u>{{ __('Edit') }} {{ __('Athlete') }}</u></h4>
                    @if (count($errors)>0)
                        <div class="alert alert-danger text-white" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                      <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif
                    <form action="{{ url('update-athlete/'.$atleta->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Date of Birth') }} </label>
                                    <div class="input-daterange input-group" >
                                        <div class="input-group input-group-dynamic mb-4">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            @php
                                                $fecha_nacimiento = date("d-m-Y", strtotime($atleta->birth));
                                            @endphp
                                            <input type="text" class="form-control" id="datepickerbirth" aria-label="Amount (to the nearest dollar)" name="birth" value="{{ $fecha_nacimiento }}" >
                                        </div>

                                    </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Gender') }}</label>
                                <select class="form-select px-2" aria-label="Default select example" name="gender">
                                    <option value="{{ $atleta->gender == '0' ? '0' : ($atleta->gender == '1' ? '1' : "") }}">
                                        {{ $atleta->gender == '0' ? __('Male') : ($atleta->gender == '1' ? __('Female') :  "") }}
                                    </option>
                                    <option value="0">{{ __('Male') }}</option>
                                    <option value="1">{{ __('Female') }}</option>
                                </select>
                                @if ($errors->has('gender'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('gender') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Name') }}</label>
                                <input type="text" class="form-control border px-2 " name="name" value="{{ $atleta->name }}" >
                                @if ($errors->has('name'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('name') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Athlete CUI') }}</label>
                                <input readonly type="number" class="form-control border px-2 " name="cui_dpi" onkeypress="return validarentero(event,this.value)" value="{{ $atleta->cui_dpi }}" >
                                @if ($errors->has('cui_dpi'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('cui_dpi') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Ethnic Group') }}</label>
                                <select class="form-select px-2" aria-label="Default select example" name="ethnic_group">
                                    <option value="{{ $atleta->ethnic_group }}">{{ $atleta->ethnic_group }}</option>
                                    <option value="Maya">Maya</option>
                                    <option value="Garífuna">Garífuna</option>
                                    <option value="Xinca">Xinca</option>
                                    <option value="Mestizo">Mestizo</option>
                                    <option value="Ladino">Ladino</option>
                                    <option value="Otra">Otra</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Covid19 Doses Number') }}</label>
                                <select class="form-select px-2" aria-label="Default select example" name="doses_number">
                                    <option value="{{ $atleta->doses_number }}">{{ $atleta->doses_number }}</option>
                                    <option value="Ninguna">Ninguna</option>
                                    <option value="1ra. Dosis">1ra. Dosis</option>
                                    <option value="2da. Dosis">2da. Dosis</option>
                                    <option value="3ra. Dosis">3ra. Dosis</option>
                                    <option value="Refuerzo y más">Refuerzo y más</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Education Obtained') }}</label>
                                <select class="form-select px-2" aria-label="Default select example" name="education_obtained">
                                    <option value="{{ $atleta->education_obtained }}">{{ $atleta->education_obtained }}</option>
                                    <option value="Ninguna">Ninguna</option>
                                    <option value="Kinder">Kinder</option>
                                    <option value="Parvulos">Parvulos</option>
                                    <option value="Primaria">Primaria</option>
                                    <option value="Basico">Basico</option>
                                    <option value="Diversificado">Diversificado</option>
                                    <option value="Tecnico">Tecnico</option>
                                    <option value="Universitario">Universitario</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Tshirt Size') }}</label>
                                <select class="form-select px-2" aria-label="Default select example" name="tshirt_size">
                                    <option value="{{ $atleta->tshirt_size }}">{{ $atleta->tshirt_size }}</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">{{ __('Phone') }}</label>
                                <input type="number" step="1" pattern="\d+" class="form-control border px-2 " name="phone" value="{{ $atleta->phone }}">
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
                                <input type="number" class="form-control border px-2 " name="whatsapp" value="{{ $atleta->whatsapp }}">
                                @if ($errors->has('whatsapp'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('whatsapp') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Email</label>
                                <input type="text" class="form-control border px-2 " name="email" value="{{ $atleta->email }}" >
                                @if ($errors->has('email'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('email') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">{{ __('Country') }}</label>
                                <input readonly type="text" class="form-control border px-2 " name="country" value="Guatemala">
                                @if ($errors->has('country'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('country') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">{{ __('State') }}</label>
                                <select class="form-control" name="state" id="departamentos" onchange="cargarMunicipios()">
                                    <option selected value="{{ $atleta->state }}">{{ $atleta->state }}</option>
                                    <option value="">Selecciona un departamento</option>
                                    <option value="Alta Verapaz">Alta Verapaz</option>
                                    <option value="Baja Verapaz">Baja Verapaz</option>
                                    <option value="Chimaltenango">Chimaltenango</option>
                                    <option value="Chiquimula">Chiquimula</option>
                                    <option value="El Progreso">El Progreso</option>
                                    <option value="Escuintla">Escuintla</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Huehuetenango">Huehuetenango</option>
                                    <option value="Izabal">Izabal</option>
                                    <option value="Jalapa">Jalapa</option>
                                    <option value="Jutiapa">Jutiapa</option>
                                    <option value="Petén">Petén</option>
                                    <option value="Quetzaltenango">Quetzaltenango</option>
                                    <option value="Quiché">Quiché</option>
                                    <option value="Retalhuleu">Retalhuleu</option>
                                    <option value="Sacatepéquez">Sacatepéquez</option>
                                    <option value="San Marcos">San Marcos</option>
                                    <option value="Santa Rosa">Santa Rosa</option>
                                    <option value="Sololá">Sololá</option>
                                    <option value="Suchitepéquez">Suchitepéquez</option>
                                    <option value="Totonicapán">Totonicapán</option>
                                    <option value="Zacapa">Zacapa</option>
                                </select>
                                @if ($errors->has('state'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('state') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">{{ __('City') }}</label>
                                <select name="city" type="text" class="form-control" id="municipios">
                                    <option selected value="{{ $atleta->city }}">{{ $atleta->city }}</option>
                                    <option value="">Selecciona un municipio</option>
                                </select>
                                @if ($errors->has('city'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('city') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">{{ __('Address') }}</label>
                                <input type="text" class="form-control border px-2 " name="address" value="{{ $atleta->address }}">
                                @if ($errors->has('address'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('address') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">{{ __('Change Athlete Image') }}</label>
                                <input type="file" name="image" class="form-control border">
                                @if ($errors->has('image'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('image') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>

                            @if ($atleta->image)
                                <div class="col-md-6 mb-3">
                                    <label for="">{{ __('PDF') }}</label><br>
                                    <img class="border-radius-md w-25 img-fluid" src="{{ asset('assets/uploads/athletes/' . $atleta->image) }}" alt="user Image">
                                </div>
                            @endif

                            <div class="col-md-9 mb-3">
                                <label for="">{{ __('Vaccination Card') }}</label>
                                <input type="file" name="vaccination_card" class="form-control border">
                                @if ($errors->has('vaccination_card'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('vaccination_card') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>

                            @if ($atleta->vaccination_card)
                                <div class="col-md-3 mb-3">
                                    <label for="">{{ __('PDF') }}</label><br>
                                    <a class="btn btn-danger" href="{{ asset('assets/uploads/vaccination/'.$atleta->vaccination_card) }}" target="blank"><i class="material-icons opacity-10">picture_as_pdf</i> {{ __('Download') }}</a>
                                </div>
                            @endif

                            <div class="col-md-9 mb-3">
                                <label for="">{{ __('Birth Certificate') }}</label>
                                <input type="file" name="birth_certificate" class="form-control border">
                                @if ($errors->has('birth_certificate'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('birth_certificate') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>

                            @if ($atleta->birth_certificate)
                                <div class="col-md-3 mb-3">
                                    <label for="">{{ __('PDF') }}</label><br>
                                    <a class="btn btn-danger" href="{{ asset('assets/uploads/certificate/'.$atleta->birth_certificate) }}" target="blank"><i class="material-icons opacity-10">picture_as_pdf</i> {{ __('Download') }}</a>
                                </div>
                            @endif

                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Responsible Name') }}</label>
                                <input type="text" class="form-control border px-2 " name="responsible_name" value="{{ $atleta->responsible_name }}" >
                                @if ($errors->has('responsible_name'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('responsible_name') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Responsible DPI') }}</label>
                                <input type="number" class="form-control border px-2 " name="responsible_dpi" value="{{ $atleta->responsible_dpi }}" >
                                @if ($errors->has('responsible_dpi'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('responsible_dpi') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Responsible Phone') }}</label>
                                <input type="number" class="form-control border px-2 " name="responsible_phone" value="{{ $atleta->responsible_phone }}" >
                                @if ($errors->has('responsible_phone'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('responsible_phone') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Responsible Whatsapp') }}</label>
                                <input type="number" class="form-control border px-2 " name="responsible_whatsapp" value="{{ $atleta->responsible_whatsapp }}" >
                                @if ($errors->has('responsible_whatsapp'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('responsible_whatsapp') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="">{{ __('Responsible Email') }}</label>
                                <input type="text" class="form-control border px-2 " name="responsible_email" value="{{ $atleta->responsible_email }}" >
                                @if ($errors->has('responsible_email'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('responsible_email') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-9 mb-3">
                                <label for="">{{ __('Responsible Address') }}</label>
                                <input type="text" class="form-control border px-2 " name="responsible_address" value="{{ $atleta->responsible_address }}" >
                                @if ($errors->has('responsible_address'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('responsible_address') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">{{ __('Kinship') }}</label>
                                <select class="form-select px-2" aria-label="Default select example" name="kinship">
                                    <option value="{{ $atleta->kinship }}">{{ $atleta->kinship }}</option>
                                    <option value="Madre">Madre</option>
                                    <option value="Padre">Padre</option>
                                    <option value="Abuelo">Abuelo</option>
                                    <option value="Abuela">Abuela</option>
                                    <option value="Encargado">Encargado</option>
                                    <option value="Hermano">Hermano</option>
                                    <option value="Hermana">Hermana</option>
                                    <option value="Primo">Primo</option>
                                    <option value="Prima">Prima</option>
                                    <option value="Tio">Tio</option>
                                    <option value="Tia">Tia</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">{{ __('Responsible Covid19 Doses Number') }}</label>
                                <select class="form-select px-2" aria-label="Default select example" name="responsible_doses_number">
                                    <option value="{{ $atleta->responsible_doses_number }}">{{ $atleta->responsible_doses_number }}</option>
                                    <option value="Ninguna">Ninguna</option>
                                    <option value="1ra. Dosis">1ra. Dosis</option>
                                    <option value="2da. Dosis">2da. Dosis</option>
                                    <option value="3ra. Dosis">3ra. Dosis</option>
                                    <option value="Refuerzo y más">Refuerzo y más</option>
                                </select>
                            </div>

                            <div class="col-md-9 mb-3">
                                <label for="">{{ __('Responsible DPI') }}</label>
                                <input type="file" name="responsible_image" class="form-control border">
                                @if ($errors->has('responsible_image'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('responsible_image') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>

                            @if ($atleta->responsible_image)
                                <div class="col-md-3 mb-3">
                                    <label for="">{{ __('PDF') }}</label><br>
                                    <a class="btn btn-danger" href="{{ asset('assets/uploads/responsible/'.$atleta->responsible_image) }}" target="blank"><i class="material-icons opacity-10">picture_as_pdf</i> {{ __('Download') }}</a>
                                </div>
                            @endif

                            <div class="col-md-9 mb-3">
                                <label for="">{{ __('Signed Contract') }}</label>
                                <input type="file" name="signed_contract" class="form-control border">
                                @if ($errors->has('signed_contract'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('signed_contract') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>

                            @if ($atleta->signed_contract)
                                <div class="col-md-3 mb-3">
                                    <label for="">{{ __('PDF') }}</label><br>
                                    <a class="btn btn-danger" href="{{ asset('assets/uploads/signedcontracts/'.$atleta->signed_contract) }}" target="blank"><i class="material-icons opacity-10">picture_as_pdf</i> {{ __('Download') }}</a>
                                </div>
                            @endif

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
            orientation: "auto"
        };
        $( '#datepickerbirth' ).datepicker( optSimple );

    </script>

<script>
    const municipiosPorDepartamento = {
      "Alta Verapaz": ["Cobán", "Chisec", "San Cristóbal Verapaz", "Santa Cruz Verapaz", "Tactic", "Tamahú", "San Juan Chamelco", "Panzós", "Senahú", "Cahabón", "Chahal", "Fray Bartolomé de las Casas", "Santa María Cahabón", "La Tinta", "Raxruhá"],
      "Baja Verapaz": ["Salamá", "San Miguel Chicaj", "Rabinal", "Cubulco", "Granados", "San Jerónimo", "Purulhá"],
      "Chimaltenango": ["Chimaltenango", "San José Poaquil", "San Martín Jilotepeque", "Comalapa", "Santa Apolonia", "Tecpán Guatemala", "Patzún", "Pochuta", "Patzicía", "Santa Cruz Balanyá", "Acatenango", "Yepocapa", "San Andrés Itzapa", "Parramos", "Zaragoza", "El Tejar"],
      "Chiquimula": ["Chiquimula", "San José La Arada", "San Juan Ermita", "Jocotán", "Camotán", "Olopa", "Esquipulas", "Concepción Las Minas", "Quetzaltepeque"],
      "El Progreso": ["Guastatoya", "Morazán", "San Agustín Acasaguastlán", "San Antonio La Paz", "San Cristóbal Acasaguastlán", "Sanarate", "Sansare", "Santa María Ixhuatán"],
      "Escuintla": ["Escuintla", "Santa Lucía Cotzumalguapa", "La Democracia", "Siquinalá", "Masagua", "Tiquisate", "La Gomera", "Guazacapán", "San José", "Iztapa", "Palín", "San Vicente Pacaya", "Nueva Concepción"],
      "Guatemala": ["Guatemala", "Santa Catarina Pinula", "San José Pinula", "San José del Golfo", "Palencia", "Chinautla", "San Pedro Ayampuc", "Mixco", "San Pedro Sacatepéquez", "San Juan Sacatepéquez", "San Raymundo", "Chuarrancho", "Fraijanes", "Amatitlán", "Villa Nueva", "Villa Canales", "San Miguel Petapa"],
      "Huehuetenango": ["Huehuetenango", "Chiantla", "Malacatancito", "Cuilco", "Nentón", "San Pedro Necta", "Jacaltenango", "San Pedro Soloma", "San Ildelfonso Ixtahuacán", "Santa Bárbara", "La Libertad", "La Democracia", "San Miguel Acatán", "San Rafael La Independencia", "Todos Santos Cuchumatán", "San Juan Atitán", "Santa Eulalia", "San Mateo Ixtatán", "Colotenango", "San Sebastián Huehuetenango", "Tectitán", "Concepción Huista", "San Juan Ixcoy", "San Antonio Huista", "San Sebastián Coatán", "Santa Cruz Barillas", "Aguacatán", "San Rafael Petzal", "San Gaspar Ixchil", "Santiago Chimaltenango", "Santa Ana Huista"],
      "Izabal": ["Puerto Barrios", "Livingston", "El Estor", "Morales", "Los Amates"],
      "Jalapa": ["Jalapa", "San Pedro Pinula", "San Luis Jilotepeque", "San Manuel Chaparrón", "San Carlos Alzatate", "Monjas", "Mataquescuintla"],
      "Jutiapa": ["Jutiapa", "El Progreso", "Santa Catarina Mita", "Agua Blanca", "Asunción Mita", "Yupiltepeque", "Atescatempa", "Jerez", "El Adelanto", "Zapotitlán", "Comapa", "Jalpatagua", "Conguaco", "Moyuta", "Pasaco", "San José Acatempa", "Quesada"],
      "Petén": ["Flores", "San José", "San Benito", "San Andrés", "La Libertad", "San Francisco", "Santa Ana", "Dolores", "San Luis", "Sayaxché", "Melchor de Mencos", "Poptún", "Las Cruces", "La Blanca", "El Chal"],
      "Quetzaltenango": ["Quetzaltenango", "Salcajá", "Olintepeque", "San Carlos Sija", "Sibilia", "Cabricán", "Cajolá", "San Miguel Siguilá", "Ostuncalco", "San Mateo", "Concepción Chiquirichapa", "San Martín Sacatepéquez", "Almolonga", "Cantel", "Huitán", "Zunil", "Colomba", "San Francisco La Unión", "El Palmar", "Coatepeque", "Génova", "Flores Costa Cuca", "La Esperanza"],
      "Quiché": ["Santa Cruz del Quiché", "Chiché", "Chinique", "Zacualpa", "Chajul", "Chichicastenango", "Patzité", "San Antonio Ilotenango", "San Pedro Jocopilas", "Cunén", "San Juan Cotzal", "Joyabaj", "Nebaj", "San Andrés Sajcabajá", "Uspantán", "Sacapulas", "San Bartolomé Jocotenango", "Canillá"],
      "Retalhuleu": ["Retalhuleu", "San Sebastián", "Santa Cruz Mulúa", "San Martín Zapotitlán", "San Felipe", "San Andrés Villa Seca", "Champerico", "Nuevo San Carlos", "El Asintal"],
      "Sacatepéquez": ["Antigua Guatemala", "Jocotenango", "Pastores", "Sumpango", "Santo Domingo Xenacoj", "Santiago Sacatepéquez", "San Bartolomé Milpas Altas", "San Lucas Sacatepéquez", "Santa Lucía Milpas Altas", "Magdalena Milpas Altas", "Santa María de Jesús", "Ciudad Vieja", "San Miguel Dueñas", "San Juan Alotenango", "San Antonio Aguas Calientes"],
      "San Marcos": ["San Marcos", "San Pedro Sacatepéquez", "San Antonio Sacatepéquez", "Comitancillo", "San Miguel Ixtahuacán", "Concepción Tutuapa", "Tacaná", "Sibinal", "Tajumulco", "Tejutla", "San Rafael Pie de la Cuesta", "Nuevo Progreso", "El Tumbador", "San José El Rodeo", "Malacatán", "Catarina", "Ayutla", "Ocós", "San Pablo", "El Quetzal", "La Reforma", "Pajapita", "Ixchiguan", "San José Ojetenam"],
      "Santa Rosa": ["Cuilapa", "Barberena", "Santa Rosa de Lima", "Casillas", "San Rafael Las Flores", "Oratorio", "San Juan Tecuaco", "Chiquimulilla", "Taxisco", "Santa María Ixhuatán", "Guazacapán", "Santa Cruz Naranjo", "Pueblo Nuevo Viñas", "Nueva Santa Rosa"],
      "Sololá": ["Sololá", "San José Chacayá", "Santa María Visitación", "Santa Lucía Utatlán", "Nahualá", "Santa Catarina Ixtahuacán", "Santa Clara La Laguna", "Concepción", "San Andrés Semetabaj", "Panajachel", "Santa Catarina Palopó", "San Antonio Palopó", "San Lucas Tolimán", "Santa Cruz La Laguna", "San Pablo La Laguna", "San Marcos La Laguna", "San Juan La Laguna", "San Pedro La Laguna"],
      "Suchitepéquez": ["Mazatenango", "Cuyotenango", "San Francisco Zapotitlán", "San Bernardino", "San José El Idolo", "Santo Domingo Suchitepéquez", "San Lorenzo", "Samayac", "San Pablo Jocopilas", "San Antonio Suchitepéquez", "San Miguel Panán", "San Gabriel", "Chicacao", "Patulul", "Santa Bárbara", "San Juan Bautista", "Santo Tomás La Unión", "Zunilito", "Pueblo Nuevo"],
      "Totonicapán": ["Totonicapán", "San Cristóbal Totonicapán", "San Francisco El Alto", "Santa María Chiquimula", "San Bartolo", "Santa Lucía La Reforma", "San Andrés Xecul", "Momostenango"],
      "Zacapa": ["Zacapa", "Estanzuela", "Río Hondo", "Gualán", "Teculután", "Usumatlán", "Cabañas", "San Diego", "La Unión", "Huite"],
    };

    function cargarMunicipios() {
      const departamentoSelect = document.getElementById("departamentos");
      const municipioSelect = document.getElementById("municipios");
      const departamento = departamentoSelect.value;

      municipioSelect.innerHTML = "<option value=''>Selecciona un municipio</option>";

      if (departamento && municipiosPorDepartamento.hasOwnProperty(departamento)) {
        const municipios = municipiosPorDepartamento[departamento];
        municipios.forEach(function(municipio) {
          const option = document.createElement("option");
          option.value = municipio;
          option.text = municipio;
          municipioSelect.appendChild(option);
        });
      }
    }
  </script>

    @push('scripts')

        <script>

            function validardecimal(e,txt)
            {
                tecla = (document.all) ? e.keyCode : e.which;
                if (tecla==8) return true;
                if (tecla==46 && txt.indexOf('.') != -1) return false;
                patron = /[\d\.]/;
                te = String.fromCharCode(tecla);
                return patron.test(te);
            }

            function validarentero(e,txt)
            {
                tecla = (document.all) ? e.keyCode : e.which;

                //Tecla de retroceso para borrar, siempre la permite
                if (tecla==8)
                {
                return true;
                }

                // Patron de entrada, en este caso solo acepta numeros
                patron =/[0-9]/;
                tecla_final = String.fromCharCode(tecla);
                return patron.test(tecla_final);
            }

        </script>

    @endpush

@endsection
