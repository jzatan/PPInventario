<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Editar usuario')

@push('css')

<link href=" {{asset ('/assets/css/cards.css')}}" rel="stylesheet" />
@endpush

@section('header-nav', 'Editar usuario')
@section('header', 'Editar usuario')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Editar usuario</h5>
                </div>
                <div class="card-body">
                    <form id="userForm-update" action="{{route('usuarios.update', $usuario -> id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label for="area_id">ARÉA DE TRABAJO</label>
                                    <!-- Llamamos a las areas en estado 1 = activos-->
                                    <select class="form-control" id="area_id" name="area_id">
                                        @foreach ($areas as $item)
                                        <option value="{{$item->id}}" {{ $usuario->area_id == $item->id ? 'selected' : '' }}>{{$item->nombre_area}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5 px-1">
                                <div class="form-group">
                                    <label for="usuario">USUARIO</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Crear usuario" value="{{$usuario -> usuario}}" required>
                                </div>
                            </div>
                            <div class="col-md-3 pl-1">
                                <div class="form-group">
                                    <label for="contraseña">CONTRASEÑA</label>
                                    <input type="text" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" maxlength="8" value="{{$usuario -> contraseña}}" oninput="validatePassword()" required>
                                    <div id="contraseña-error" class="invalid-feedback">
                                        La contraseña debe tener exactamente 8 caracteres.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="nombres">NOMBRES</label>
                                    <input type="text" class="form-control" name="nombres" id="nombres" title="Solo alfanumericos" placeholder="nombres de usuario" value="{{$usuario -> nombres}}" oninput="validateNombres()" required>
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label for="apellidos">APELLIDOS</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ingresar la apellidos" value="{{$usuario -> apellidos}}" oninput="validateApellidos()" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label for="dni"> DOCUMENTO DE IDENTIDAD</label>
                                    <input type="text" class="form-control" id="dni" name="dni" title="Digitos numericos" placeholder="Ingresar dni" value="{{$usuario -> dni}}" pattern="\d{8}" maxlength="8" oninput="validateDNI()" required>
                                    <div id="dni-error" class="invalid-feedback">
                                        El DNI debe tener 8 dígitos numéricos.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label for="telefono">TELÉFONO</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" title="Ingrese telefono" placeholder="Ingrese telefono" value="{{$usuario -> telefono}}" pattern="\d{9}" maxlength="9" oninput="validateTelefono()" required>
                                    <div id="telefono-error" class="invalid-feedback">
                                        El teléfono debe tener 9 dígitos numéricos.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label for="estado">ESTADO</label>
                                    <select class="form-control" id="estado" name="estado" required>
                                        @if ($usuario->estado == 1)
                                        <option value="1" selected class="text-center">Activo</option>
                                        <option value="0" class="text-center">Inactivo</option>
                                        @else
                                        <option value="0" selected class="text-center">Inactivo</option>
                                        <option value="1" class="text-center">Activo</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="d-flex flex-column justify-content-end">
                            <button type="submit" class="btn btn-primary btn-ciclos">Confirmar</button>
                            <button type="reset" class="btn btn-secondary btn-ciclos" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card profile-card-4">
                <div class="card-img-block">
                    <img class="img-fluid" src="{{asset ('assets/img/bg-pt.jpg')}}" alt="Card image cap">
                </div>
                <div class="card-body pt-5">
                    <img src="{{asset ('assets/img/usuario.png')}}" alt="profile-image" class="profile" />
                    <h5 class="card-title text-center">{{$usuario->nombres}} {{$usuario->apellidos ?? ''}}</h5>
                    <p class="card-text text-center">
                        {{$usuario -> areas-> nombre_area}} <br>
                        {{$usuario -> usuario}} <br>
                        {{$usuario -> telefono}} <br>
                    </p>
                    <div class="icon-block text-center"><a href="https://www.facebook.com/SubRegiondeSaludMorroponHuancabamba"><i class="fa fa-facebook"></i></a><a href="https://x.com/sub_region">
                            <i class="fa fa-twitter"></i></a><a href="https://www.instagram.com/dsrsmh/"> <i class="fa fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{asset ('assets/js/imputs-validations.js')}}"></script>

@endpush