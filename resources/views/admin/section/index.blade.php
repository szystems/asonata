@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">language</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">{{ __('Secciones') }}</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    {{-- <h4><u>{{ __('Asonata Settings') }}</u></h4> --}}
                    <!-- .flash-message -->
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if (Session::has('alert-' . $msg))
                            <div class="alert alert-{{ $msg }} alert-dismissible text-white fade show"
                                role="alert">
                                <span class="alert-text"> {{ Session::get('alert-' . $msg) }}</span>
                                <span class="alert-icon align-middle">
                                    <span class="material-icons text-md">
                                        thumb_up_off_alt
                                    </span>
                                </span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        {{ session()->forget('alert-' . $msg) }}
                    @endforeach
                    <p>Selecciona la seccion que deseas editar:</p>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-inicio-tab" data-bs-toggle="tab" data-bs-target="#nav-inicio" type="button" role="tab" aria-controls="nav-inicio" aria-selected="true">Inicio</button>
                            <button class="nav-link" id="nav-slide-tab" data-bs-toggle="tab" data-bs-target="#nav-slide" type="button" role="tab" aria-controls="nav-slide" aria-selected="false">Carrusel de Imagenes</button>
                            <button class="nav-link" id="nav-nosotros-tab" data-bs-toggle="tab" data-bs-target="#nav-nosotros" type="button" role="tab" aria-controls="nav-nosotros" aria-selected="false">Nosotros</button>
                            <button class="nav-link" id="nav-equipo-tab" data-bs-toggle="tab" data-bs-target="#nav-equipo" type="button" role="tab" aria-controls="nav-equipo" aria-selected="false">Equipo</button>
                            <button class="nav-link" id="nav-contacto-tab" data-bs-toggle="tab" data-bs-target="#nav-contacto" type="button" role="tab" aria-controls="nav-contacto" aria-selected="false">Contacto</button>
                        </div>
                    </nav>
                    {{-- Inicio --}}
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-inicio" role="tabpanel"
                            aria-labelledby="nav-inicio-tab">

                            <div class="container-fluid py-4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card my-4">
                                            <div class="card-body p-4 pt-3">
                                                <h4><u>Sección de Inicio</u></h4>
                                                <div>
                                                    <form action="{{ url('/') }}" method="GET" target="_blank">
                                                        <button type="submit" class="btn btn-info">
                                                            <i class="material-icons opacity-10">visibility</i>
                                                            {{ __('Vista Previa') }}
                                                        </button>
                                                    </form>
                                                </div>
                                                <p>Edite los campos de la seccion de inicio y al finalizar presione el boton
                                                    de guardar:</p>
                                                <div class="row">
                                                    <form action="{{ url('update-section') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="section" value="inicio">
                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Titulo Inicio</label>
                                                            <div class="input-group input-group-dynamic mb-4">
                                                                <input type="text" name="inicio_titulo"
                                                                    class="form-control"
                                                                    placeholder="Titulo de la pagina de inicio"
                                                                    aria-describedby="basic-addon1"
                                                                    value="{{ $section->inicio_titulo }}">
                                                            </div>
                                                            @if ($errors->has('inicio_titulo'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('inicio_titulo') }}</font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Descripción de
                                                                Inicio</label>
                                                            <textarea type="text" class="form-control border px-2 " rows="5" name="inicio_descripcion">{{ $section->inicio_descripcion }}</textarea>
                                                            @if ($errors->has('inicio_descripcion'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('inicio_descripcion') }}
                                                                        </font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Descripción
                                                                Secundaria de Inicio</label>
                                                            <textarea type="text" class="form-control border px-2 " rows="5" name="inicio_descripcion_2">{{ $section->inicio_descripcion_2 }}</textarea>
                                                            @if ($errors->has('inicio_descripcion_2'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('inicio_descripcion_2') }}
                                                                        </font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <h4><u>Video de Inicio:</u></h4>
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Titulo del
                                                                Video</label>
                                                            <div class="input-group input-group-dynamic mb-4">
                                                                <input type="text" name="video_titulo"
                                                                    class="form-control"
                                                                    placeholder="Titulo del video de la pagina de inicio"
                                                                    aria-describedby="basic-addon1"
                                                                    value="{{ $section->video_titulo }}">
                                                            </div>
                                                            @if ($errors->has('video_titulo'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('video_titulo') }}</font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Descripción del
                                                                Video</label>
                                                            <textarea type="text" class="form-control border px-2 " rows="5" name="video_descripcion">{{ $section->video_descripcion }}</textarea>
                                                            @if ($errors->has('video_descripcion'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('video_descripcion') }}
                                                                        </font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Link del
                                                                Video</label>
                                                            <div class="input-group input-group-dynamic mb-4">
                                                                <input type="text" name="video_link"
                                                                    class="form-control"
                                                                    placeholder="Link del video (Youtube, Facebook, etc...) de la pagina de inicio"
                                                                    aria-describedby="basic-addon1"
                                                                    value="{{ $section->video_link }}">
                                                            </div>
                                                            @if ($errors->has('video_link'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('video_link') }}</font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label class="text-primary" for="">Cambiar Imagen de
                                                                Fondo del Video</label>
                                                            <input type="file" name="video_fondo"
                                                                class="form-control border">
                                                            @if ($errors->has('video_fondo'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('video_fondo') }}</font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        @if ($section->video_fondo)
                                                            <div class="col-md-6 mb-3">
                                                                <label class="text-primary" for="">Imagen de
                                                                    Fondo</label><br>
                                                                <img class="border-radius-md w-25 img-fluid"
                                                                    src="{{ asset('assets/uploads/video/' . $section->video_fondo) }}"
                                                                    alt="Imagen de fondo del video">
                                                            </div>
                                                        @endif

                                                        <br>
                                                        <hr class="dark horizontal my-0">
                                                        <br>

                                                        <div class="col-md-12 mb-3" align="center">
                                                            <button type="submit" class="btn btn-success"><i
                                                                    class="material-icons">save</i>
                                                                {{ __('Save') }}</button>
                                                        </div>

                                                    </form>
                                                </div>

                                            </div>
                                            {{-- <hr class="dark horizontal my-0">
                                            <div class="card-footer p-3">
                                                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Carrusel de imagenes --}}
                        <div class="tab-pane fade" id="nav-slide" role="tabpanel" aria-labelledby="nav-slide-tab">
                            <div class="container-fluid py-4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card my-4">
                                            <div class="card-body p-4 pt-3">
                                                <h4><u>Carrusel de Diapositivas de Inicio</u> ({{ $slides->count() }})</h4>
                                                <div class="col-md-12 mb-3">
                                                    <a href="{{ url('/') }}" type="button" class="btn btn-info"><i
                                                            class="material-icons">visibility</i> Vista Previa</a>
                                                    <button type="button" class="btn bg-gradient-success"
                                                        data-bs-toggle="modal" data-bs-target="#newSlideModal">
                                                        <i class="material-icons">add</i> Agregar Diapositiva
                                                    </button>
                                                    @include('admin.section.newslidemodal')
                                                </div>

                                                {{-- Listado de diapositivas --}}
                                                <div class="card my-4">
                                                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                                        <div
                                                            class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                                            <h6 class="text-white text-capitalize ps-3">Listado de Diapositivas de Carrusel</h6>
                                                        </div>
                                                    </div>
                                                    <div class="card-body px-0 pb-2">
                                                        <div class="table-responsive p-0">
                                                            <table class="table align-items-center mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Imagen / Titulo / Descripción</th>
                                                                        {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Descripcion</th> --}}
                                                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Boton</th>
                                                                        {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th> --}}
                                                                        <th class="text-secondary opacity-7"><i class="material-icons">format_list_bulleted</i></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    @foreach ($slides as $slide)
                                                                        <tr>
                                                                            <td>
                                                                                <div class="d-flex px-2 py-1">
                                                                                    <div>
                                                                                        <img src="{{ asset('assets/uploads/slides/' . $slide->imagen) }}" class="avatar avatar-xxl  me-3 border-radius-lg" alt="{{ $slide->titulo }}">
                                                                                    </div>
                                                                                    <div
                                                                                        class="d-flex flex-column justify-content-center">
                                                                                        <h6 class="mb-0 text-sm">{{ $slide->titulo }}</h6>
                                                                                        <p class="text-xs text-secondary mb-0">{{ $slide->descripcion }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            {{-- <td>
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    Manager</p>
                                                                                <p class="text-xs text-secondary mb-0">
                                                                                    Organization</p>
                                                                            </td> --}}
                                                                            <td class="align-middle text-center text-sm">
                                                                                <span class="badge badge-sm bg-gradient-info">{{ $slide->boton_texto }}</span>
                                                                                <p class="text-xs text-secondary mb-0">{{ $slide->boton_link }}</p>
                                                                            </td>
                                                                            {{-- <td class="align-middle text-center">
                                                                                <span
                                                                                    class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                                                            </td> --}}
                                                                            <td class="align-middle">
                                                                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                                                    <button type="button" class="btn bg-gradient-warning" data-bs-toggle="modal" data-bs-target="#editSlideModal{{ $slide->id }}"><i class="material-icons">edit</i></button>
                                                                                </a><button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $slide->id }}">
                                                                                    <i class="material-icons">delete</i>
                                                                                </button>
                                                                                @include('admin.section.editslidemodal')
                                                                                @include('admin.section.deletemodal')
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <p>La vista previa de abajo solo es una representacion de los elementos de
                                                    cada diapositiva del carrusel y sus elementos, en la pagina principal
                                                    llevara el estilo de la misma</p>

                                                {{-- carrusel --}}
                                                <div id="carouselExampleControls" class="carousel slide" slide
                                                    data-interval="10000" data-bs-ride="carousel">
                                                    <div class="carousel-inner mb-4">
                                                        @empty($slides)
                                                            <div class="alert alert-secondary text-white" role="alert">
                                                                <strong>No se encontro ninguna diapositiva para el
                                                                    carrusel!</strong>
                                                            </div>
                                                        @else
                                                            @php
                                                                $firstSlide = 0;
                                                            @endphp
                                                            @foreach ($slides as $slide)
                                                                <div
                                                                    class="carousel-item @if ($firstSlide == 0) active @endif">
                                                                    <div class="page-header min-vh-75 m-3 border-radius-xl"
                                                                        style="background-image: url('{{ asset('assets/uploads/slides/' . $slide->imagen) }}');">
                                                                        <span class="mask bg-gradient-dark "></span>
                                                                        <div class="container">
                                                                            <div class="row" align="center">
                                                                                <div class="col-lg-6 my-auto">
                                                                                    @if ($slide->titulo != null)
                                                                                        <h1
                                                                                            class="text-white fadeIn2 fadeInBottom">
                                                                                            {{ $slide->titulo }}</h1>
                                                                                    @endif
                                                                                    @if ($slide->descripcion != null)
                                                                                        <p
                                                                                            class="lead text-white opacity-8 fadeIn3 fadeInBottom">
                                                                                            {{ $slide->descripcion }}
                                                                                        </p>
                                                                                    @endif
                                                                                    @if ($slide->boton_link != null)
                                                                                        <a href="{{ $slide->boton_link }}"
                                                                                            class="btn btn-info">
                                                                                            <i class="material-icons opacity-10">start</i>
                                                                                            {{ $slide->boton_texto }}
                                                                                        </a>
                                                                                    @endif


                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                @php
                                                                    $firstSlide++;
                                                                @endphp
                                                            @endforeach
                                                        @endempty


                                                    </div>
                                                    <div class="min-vh-75 position-absolute w-100 top-0">
                                                        <a class="carousel-control-prev" href="#carouselExampleControls"
                                                            role="button" data-bs-slide="prev">
                                                            <span
                                                                class="carousel-control-prev-icon position-absolute bottom-50"
                                                                aria-hidden="true"></span>
                                                            <span class="visually-hidden">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carouselExampleControls"
                                                            role="button" data-bs-slide="next">
                                                            <span
                                                                class="carousel-control-next-icon position-absolute bottom-50"
                                                                aria-hidden="true"></span>
                                                            <span class="visually-hidden">Next</span>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                            {{-- <hr class="dark horizontal my-0">
                                            <div class="card-footer p-3">
                                                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Seccion Nosotros --}}
                        <div class="tab-pane fade" id="nav-nosotros" role="tabpanel" aria-labelledby="nav-nosotros-tab">
                            <div class="container-fluid py-4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card my-4">
                                            <div class="card-body p-4 pt-3">
                                                <h4><u>Sección de Nosotros</u></h4>
                                                <div>
                                                    <form action="{{ url('about-us') }}" method="GET" target="_blank">
                                                        <button type="submit" class="btn btn-info">
                                                            <i class="material-icons opacity-10">visibility</i>
                                                            {{ __('Vista Previa') }}
                                                        </button>
                                                    </form>
                                                </div>
                                                <p>Edite los campos de la seccion de nosotros y al finalizar presione el
                                                    boton de guardar:</p>
                                                <div class="row">
                                                    <form action="{{ url('update-section') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="section" value="nosotros">
                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Titulo
                                                                Nosotros</label>
                                                            <div class="input-group input-group-dynamic mb-4">
                                                                <input type="text" name="nosotros_titulo"
                                                                    class="form-control"
                                                                    placeholder="Titulo de la seccion de Nosotros"
                                                                    aria-describedby="basic-addon1"
                                                                    value="{{ $section->nosotros_titulo }}">
                                                            </div>
                                                            @if ($errors->has('nosotros_titulo'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('nosotros_titulo') }}</font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Descripción de
                                                                Nosotros</label>
                                                            <textarea type="text" class="form-control border px-2 " rows="5" name="nosotros_descripcion">{{ $section->nosotros_descripcion }}</textarea>
                                                            @if ($errors->has('nosotros_descripcion'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('nosotros_descripcion') }}
                                                                        </font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Descripción
                                                                Secundaria de Nosotros</label>
                                                            <textarea type="text" class="form-control border px-2 " rows="5" name="nosotros_descripcion2">{{ $section->nosotros_descripcion2 }}</textarea>
                                                            @if ($errors->has('nosotros_descripcion2'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('nosotros_descripcion2') }}
                                                                        </font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <h4><u>Imagen de Nosotros:</u></h4>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label class="text-primary" for="">Cambiar Imagen de
                                                                Nosotros</label>
                                                            <input type="file" name="nosotros_imagen"
                                                                class="form-control border">
                                                            @if ($errors->has('nosotros_imagen'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('nosotros_imagen') }}</font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        @if ($section->nosotros_imagen)
                                                            <div class="col-md-6 mb-3">
                                                                <label class="text-primary" for="">Imagen de
                                                                    Nosotros</label><br>
                                                                <img class="border-radius-md w-25 img-fluid"
                                                                    src="{{ asset('assets/uploads/nosotros/' . $section->nosotros_imagen) }}"
                                                                    alt="Imagen de nosotros">
                                                            </div>
                                                        @endif

                                                        <br>
                                                        <hr class="dark horizontal my-0">
                                                        <br>

                                                        <div class="col-md-12 mb-3" align="center">
                                                            <button type="submit" class="btn btn-success"><i
                                                                    class="material-icons">save</i>
                                                                {{ __('Save') }}</button>
                                                        </div>

                                                    </form>
                                                </div>

                                            </div>
                                            {{-- <hr class="dark horizontal my-0">
                                            <div class="card-footer p-3">
                                                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Seccion de Equipo --}}
                        <div class="tab-pane fade" id="nav-equipo" role="tabpanel" aria-labelledby="nav-equipo-tab">
                            <div class="container-fluid py-4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card my-4">
                                            <div class="card-body p-4 pt-3">
                                                {{-- <h4><u>Equipos</u> </h4> --}}
                                                <div class="col-md-12 mb-3">
                                                    <a href="{{ url('about-us') }}" type="button" class="btn btn-info"><i
                                                            class="material-icons">visibility</i> Vista Previa</a>
                                                    <button type="button" class="btn bg-gradient-success"
                                                        data-bs-toggle="modal" data-bs-target="#newTeamModal">
                                                        <i class="material-icons">add</i> Agregar Equipo
                                                    </button>
                                                    @include('admin.section.newteammodal')
                                                </div>

                                                {{-- Listado de diapositivas --}}
                                                <div class="card my-4">
                                                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                                        <div
                                                            class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                                            <h6 class="text-white text-capitalize ps-3">Listado de Equipos ({{ $teams->count() }})</h6>
                                                        </div>
                                                    </div>
                                                    <div class="card-body px-0 pb-2">
                                                        <div class="table-responsive p-0">
                                                            <table class="table align-items-center mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre / Descripción</th>
                                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Miembros</th>
                                                                        {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Boton</th> --}}
                                                                        {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th> --}}
                                                                        <th class="text-secondary opacity-7"><i class="material-icons">format_list_bulleted</i></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    @foreach ($teams as $team)
                                                                        <tr>
                                                                            <td>
                                                                                <div class="d-flex px-2 py-1">
                                                                                    {{-- <div>
                                                                                        <img src="{{ asset('assets/uploads/slides/' . $slide->imagen) }}" class="avatar avatar-xxl  me-3 border-radius-lg" alt="{{ $slide->titulo }}">
                                                                                    </div> --}}
                                                                                    <div
                                                                                        class="d-flex flex-column justify-content-center">
                                                                                        {{-- <h6 class="mb-0 text-md">{{ $team->nombre }}</h6> --}}
                                                                                        <h4 class="mb-0"><u>{{ $team->nombre }}</u></h4>
                                                                                        <br>
                                                                                        <p class="text-xs text-secondary mb-0">{{ $team->descripcion }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <button type="button" class="btn bg-gradient-success btn-sm"
                                                                                    data-bs-toggle="modal" data-bs-target="#newMemberModal-{{ $team->id }}">
                                                                                    <i class="fa fa-plus"></i> Agregar Miembro
                                                                                </button>
                                                                                <hr class="dark horizontal my-0">
                                                                                @include('admin.section.newmembermodal')
                                                                                @php
                                                                                    $members = \App\Models\TeamMember::where('team_id',$team->id)->get();
                                                                                    // dd($members);
                                                                                @endphp


                                                                                @foreach ($members as $member)
                                                                                    <p class="text-xs mb-0">

                                                                                         - @if ($member->cargo != null)<b>{{ $member->cargo }}</b>:@endif
                                                                                        {{ $member->nombre }}
                                                                                        <br>
                                                                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Member">
                                                                                            <button type="button" class="btn bg-gradient-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editMemberModal{{ $member->id }}"><i class="fa fa-pencil"></i></button>
                                                                                        </a>
                                                                                        <button type="button" class="btn bg-gradient-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteMemberModal{{ $member->id }}">
                                                                                            <i class="fa fa-minus"></i>
                                                                                        </button>

                                                                                        <hr class="dark horizontal my-0">
                                                                                    </p>
                                                                                    @include('admin.section.editmembermodal')
                                                                                    @include('admin.section.deletemembermodal')
                                                                                @endforeach

                                                                            </td>
                                                                            {{-- <td class="align-middle text-center text-sm">
                                                                                <span class="badge badge-sm bg-gradient-info">{{ $slide->boton_texto }}</span>
                                                                                <p class="text-xs text-secondary mb-0">{{ $slide->boton_link }}</p>
                                                                            </td> --}}
                                                                            {{-- <td class="align-middle text-center">
                                                                                <span
                                                                                    class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                                                            </td> --}}
                                                                            <td class="align-middle">
                                                                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                                                    <button type="button" class="btn bg-gradient-warning" data-bs-toggle="modal" data-bs-target="#editTeamModal{{ $team->id }}"><i class="material-icons">edit</i></button>
                                                                                </a><button type="button" class="btn bg-gradient-danger" data-bs-toggle="modal" data-bs-target="#deleteTeamModal-{{ $team->id }}">
                                                                                    <i class="material-icons">delete</i>
                                                                                </button>
                                                                                @include('admin.section.editteammodal')
                                                                                @include('admin.section.deleteteammodal')
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            {{-- <hr class="dark horizontal my-0">
                                            <div class="card-footer p-3">
                                                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-contacto" role="tabpanel" aria-labelledby="nav-contacto-tab">
                            <div class="container-fluid py-4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card my-4">
                                            <div class="card-body p-4 pt-3">
                                                <h4><u>Sección de Contacto</u></h4>
                                                <div>
                                                    <form action="{{ url('contact') }}" method="GET" target="_blank">
                                                        <button type="submit" class="btn btn-info">
                                                            <i class="material-icons opacity-10">visibility</i>
                                                            {{ __('Vista Previa') }}
                                                        </button>
                                                    </form>
                                                </div>
                                                <p>Edite los campos de la seccion de contacto y al finalizar presione el
                                                    boton de guardar:</p>
                                                <div class="row">
                                                    <form action="{{ url('update-section') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="section" value="contacto">
                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Titulo
                                                                Información</label>
                                                            <div class="input-group input-group-dynamic mb-4">
                                                                <input type="text" name="contacto_titulo"
                                                                    class="form-control"
                                                                    placeholder="Titulo de informacion de la pagina de contacto"
                                                                    aria-describedby="basic-addon1"
                                                                    value="{{ $section->contacto_titulo }}">
                                                            </div>
                                                            @if ($errors->has('contacto_titulo'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('contacto_titulo') }}</font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Descripción de
                                                                Información</label>
                                                            <textarea type="text" class="form-control border px-2 " rows="5" name="contacto_descripcion">{{ $section->contacto_descripcion }}</textarea>
                                                            @if ($errors->has('contacto_descripcion'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('contacto_descripcion') }}
                                                                        </font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Titulo
                                                                Formulario</label>
                                                            <div class="input-group input-group-dynamic mb-4">
                                                                <input type="text" name="contacto_titulo2"
                                                                    class="form-control"
                                                                    placeholder="Titulo del formulario de contacto"
                                                                    aria-describedby="basic-addon1"
                                                                    value="{{ $section->contacto_titulo2 }}">
                                                            </div>
                                                            @if ($errors->has('contacto_titulo2'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('contacto_titulo2') }}</font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Descripción de
                                                                Información</label>
                                                            <textarea type="text" class="form-control border px-2 " rows="5" name="contacto_descripcion2">{{ $section->contacto_descripcion2 }}</textarea>
                                                            @if ($errors->has('contacto_descripcion2'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('contacto_descripcion2') }}
                                                                        </font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <h4><u>Datos de Información:</u></h4>
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Dirección</label>
                                                            <div class="input-group input-group-dynamic mb-4">
                                                                <input type="text" name="contacto_direccion"
                                                                    class="form-control"
                                                                    placeholder="Dirección de atención"
                                                                    aria-describedby="basic-addon1"
                                                                    value="{{ $section->contacto_direccion }}">
                                                            </div>
                                                            @if ($errors->has('contacto_direccion'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('contacto_direccion') }}
                                                                        </font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Teléfono 1</label>
                                                            <div class="input-group input-group-dynamic mb-4">
                                                                <input type="text" name="contacto_telefono"
                                                                    class="form-control" placeholder="XXXX XXXX"
                                                                    aria-describedby="basic-addon1"
                                                                    value="{{ $section->contacto_telefono }}">
                                                            </div>
                                                            @if ($errors->has('contacto_telefono'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('contacto_telefono') }}
                                                                        </font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Teléfono 2</label>
                                                            <div class="input-group input-group-dynamic mb-4">
                                                                <input type="text" name="contacto_telefono2"
                                                                    class="form-control" placeholder="XXXX XXXX"
                                                                    aria-describedby="basic-addon1"
                                                                    value="{{ $section->contacto_telefono2 }}">
                                                            </div>
                                                            @if ($errors->has('contacto_telefono2'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('contacto_telefono2') }}
                                                                        </font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Email de
                                                                Contacto</label>
                                                            <div class="input-group input-group-dynamic mb-4">
                                                                <input type="text" name="contacto_email"
                                                                    class="form-control"
                                                                    placeholder="correodecontacto@dominio.com"
                                                                    aria-describedby="basic-addon1"
                                                                    value="{{ $section->contacto_email }}">
                                                            </div>
                                                            @if ($errors->has('contacto_email'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('contacto_email') }}</font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Horario de Lunes a
                                                                Viernes 1ra. Jornada</label>
                                                            <div class="input-group input-group-dynamic mb-4">
                                                                <input type="text" name="contacto_lunes_viernes"
                                                                    class="form-control" placeholder="7am-1pm"
                                                                    aria-describedby="basic-addon1"
                                                                    value="{{ $section->contacto_lunes_viernes }}">
                                                            </div>
                                                            @if ($errors->has('contacto_lunes_viernes'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('contacto_lunes_viernes') }}
                                                                        </font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Horario de Lunes a
                                                                Viernes 2da. Jornada</label>
                                                            <div class="input-group input-group-dynamic mb-4">
                                                                <input type="text" name="contacto_lunes_viernes2"
                                                                    class="form-control" placeholder="2pm-7pm"
                                                                    aria-describedby="basic-addon1"
                                                                    value="{{ $section->contacto_lunes_viernes2 }}">
                                                            </div>
                                                            @if ($errors->has('contacto_lunes_viernes2'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('contacto_lunes_viernes2') }}
                                                                        </font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-primary" for="">Horario de
                                                                Sabado</label>
                                                            <div class="input-group input-group-dynamic mb-4">
                                                                <input type="text" name="contacto_domingo"
                                                                    class="form-control" placeholder="8am-12pm"
                                                                    aria-describedby="basic-addon1"
                                                                    value="{{ $section->contacto_domingo }}">
                                                            </div>
                                                            @if ($errors->has('contacto_domingo'))
                                                                <span class="help-block opacity-7">
                                                                    <strong>
                                                                        <font color="red">
                                                                            {{ $errors->first('contacto_domingo') }}</font>
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <br>
                                                        <hr class="dark horizontal my-0">
                                                        <br>

                                                        <div class="col-md-12 mb-3" align="center">
                                                            <button type="submit" class="btn btn-success"><i
                                                                    class="material-icons">save</i>
                                                                {{ __('Save') }}</button>
                                                        </div>

                                                    </form>
                                                </div>

                                            </div>
                                            {{-- <hr class="dark horizontal my-0">
                                            <div class="card-footer p-3">
                                                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p>
                                            </div> --}}
                                        </div>
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
