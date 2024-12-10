<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Editar empleado')

@push('css')

<link href=" {{asset ('/assets/css/cards.css')}}" rel="stylesheet" />
@endpush

@section('header-nav', 'Editar empleado')
@section('header', 'Editar empleado')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Editar empleado</h5>
                </div>
                <div class="card-body">
                    <form id="userForm-update" action="{{route('usuarios.update', $usuario -> id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="area_id">ARÉA DE TRABAJO</label>
                                    <!-- Llamamos a las areas en estado 1 = activos-->
                                    <select class="form-control text-center" id="area_id" name="area_id">
                                        @foreach ($areas as $item)
                                        <option value="{{$item->id}}" {{ $usuario->area_id == $item->id ? 'selected' : '' }}>{{$item->nombre_area}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label for="correo">CORREO ELECTRONICO</label>
                                    <input type="email" class="form-control text-center" id="correo" name="correo" placeholder="Crear usuario" value="{{$usuario -> correo ?? ''}}" oninput="correo_electronico(this)" required>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="nombres">NOMBRES</label>
                                    <input type="text" class="form-control text-center" name="nombres" id="nombres" title="Solo alfanumericos" placeholder="nombres de usuario" value="{{$usuario -> nombres}}" oninput="nombres_apellidos(this)" required>
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label for="apellidos">APELLIDOS</label>
                                    <input type="text" class="form-control text-center" id="apellidos" name="apellidos" placeholder="Ingresar la apellidos" value="{{$usuario -> apellidos}}" oninput="nombres_apellidos(this)" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label for="dni"> DOCUMENTO DE IDENTIDAD</label>
                                    <input type="text" class="form-control text-center" id="dni" name="dni" title="Digitos numericos" placeholder="Ingresar dni" value="{{$usuario -> dni}}" pattern="\d{8}" maxlength="8" oninput="solo_numeros(this)" required>
                                    <div id="dni-error" class="invalid-feedback">
                                        El DNI debe tener 8 dígitos numéricos.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label for="telefono">TELÉFONO</label>
                                    <input type="text" class="form-control text-center" id="telefono" name="telefono" title="Ingrese telefono" placeholder="Ingrese telefono" value="{{$usuario -> telefono}}" pattern="\d{9}" maxlength="9" oninput="solo_numeros(this)" required>
                                    <div id="telefono-error" class="invalid-feedback">
                                        El teléfono debe tener 9 dígitos numéricos.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label for="estado">ESTADO</label>
                                    <select class="form-control text-center" id="estado" name="estado" required>
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
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-2 mb-3 mb-sm-3">
                                <hr>
                                <a class="btn btn-primary w-100" href="{{route ('usuarios.index')}}"><i class="fas fa-reply me-2" aria-hidden="true"></i></a>
                            </div>
                            <div class="form-group col-sm-5 mb-3 mb-sm-3">
                                <hr>
                                <button type="reset" class="btn btn-secondary w-100"><span class="btn-inner--icon"><i class="fa fa-save text-secondary me-2"></i></span>CANCELAR</button>
                            </div>
                            <div class="form-group col-sm-5 mb-3 mb-sm-3">
                                <hr>
                                <button type="submit" class="btn w-100"><span class="btn-inner--icon"></span>ACTUALIZAR</button>
                            </div>
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
                        {{$usuario -> correo}} <br>
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
<script src="{{asset ('assets/js/validacion-campos-imputs.js')}}"></script>
@endpush