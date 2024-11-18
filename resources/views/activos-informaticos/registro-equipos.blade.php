<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Registrar equipos')

@push('css')

@endpush

@section('header-nav', 'Registrar equipos')
@section('header', 'Registrar equipos')
@section('content')
<!--Contenido-->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form id="formEquipos" action="{{route('equipos.store')}}" method="post">
                        @csrf
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-3 mb-3 mb-sm-3">
                                <label for="categoria_id">CATEGORIA</label>
                                <!-- Llamamos a las areas en estado 1 = activos-->
                                <select class="form-control" id="categoria_id" name="categoria_id">
                                    @foreach ($categorias as $item)
                                    <option value="{{$item->id}}">{{$item->nombre_categoria}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-3 mb-3 mb-sm-3">
                                <label for="usuario_id">USUARIO</label>
                                <!-- Llamamos a las areas en estado 1 = activos-->
                                <select class="form-control" id="usuario_id" name="usuario_id">
                                    @foreach ($usuarios as $item)
                                    <option value="{{$item->id}}">{{$item->nombres}} {{$item->apellidos}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="cod_registro"> CODIGO DE REGISTRO</label>
                                <input type="text" class="form-control" id="cod_registro" name="cod_registro" title="solo números" placeholder="INGRESE COD. REGISTRO" required oninput="validateCODREGISTRO()">
                                <div id="codregistroMessage" class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="ord_compra"> ORDEN DE COMPRA</label>
                                <input type="text" class="form-control" id="ord_compra" name="ord_compra" title="solo letras" placeholder="INGRESE ORDEN DE COMPRA">
                            </div>
                        </div>

                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-3 mb-3 mb-sm-3">
                                <label for="nombre_equipo"> NOMBRE DE EQUIPO</label>
                                <input type="text" class="form-control" name="nombre_equipo" id="nombre_equipo" title="Solo alfanumericos" placeholder="INGRESE NOMBRE EQUIPO" oninput="validateNOMEQUIPOS()" required>
                            </div>
                            <div class="form-group col-sm-3 mb-3 mb-sm-3">
                                <label for="marca"> MARCA</label>
                                <input type="text" class="form-control" id="marca" name="marca" title="Solo alfanumericos" placeholder="INGRESE MARCA DE EQUIPO" required oninput="validateMarca()">
                            </div>
                            <div class="form-group col-sm-3 mb-3 mb-sm-3">
                                <label for="modelo"> MODELO</label>
                                <input type="text" class="form-control" id="modelo" name="modelo" title="Solo alfanumericos" placeholder="INGRESE MODELO DE EQUIPO" oninput="validateModelo()" required>
                            </div>
                            <div class="form-group col-sm-3 mb-3 mb-sm-0">
                                <label for="color">COLOR DEL EQUIPO</label>
                                <input type="text" class="form-control" name="color" id="color" title="Solo letras" placeholder="INGRESE COLOR DEL EQUIPO" oninput="" required>
                            </div>
                            <!--<div class="form-group col-sm-3 mb-3 mb-sm-0">
                                <label for="nro_serie">NÚMERO DE SERIE</label>
                                <input type="text" class="form-control" name="nro_serie" id="nro_serie" title="Solo alfanumericos" placeholder="INGRESE NRO. SERIE" oninput="validateNROSERIE()" required>
                            </div>-->
                        </div>
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <label for="nro_serie">NÚMERO DE SERIE</label>
                                <input type="text" class="form-control" name="nro_serie" id="nro_serie" title="Solo alfanumericos" placeholder="INGRESE NRO. SERIE" oninput="validateNROSERIE()" required>
                            </div>
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <label for="fecha_adquision">FECHA DE ADQUISION</label>
                                <input type="date" class="form-control" name="fecha_adquision" id="fecha_adquision" title="formato dd/mm/yy" required>
                            </div>
                            <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                <label for="estado">ESTADO</label>
                                <select name="estado" id="estado" class="form-control text-center text-bold">
                                    <option value="" class="ms-auto text-center text-xs text-secondary mb-0">― SELECCIONAR ―</option>
                                    <option value="1" class="text-center">OEPRATIVA</option>
                                    <option value="2" class="text-center">REGULAR</option>
                                    <option value="3" class="text-center">INOPERATIVA</option>
                                    <option hidden value="4" class="text-center">EN MANTENIMIENTO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                            <label for="observacion">OBSERVACIONES</label>
                            <textarea class="form-control" name="observacion" id="observacion" title="Solo alfanumericos" placeholder="DETALLAR OBSERVACIONES"></textarea>
                        </div>
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-2 mb-3 mb-sm-3">
                                <hr>
                                <a class="btn btn-primary w-100" href="{{route ('equipos.index')}}"><i class="fas fa-reply me-2" aria-hidden="true"></i>REGRESAR</a>
                            </div>
                            <div class="form-group col-sm-5 mb-3 mb-sm-3">
                                <hr>
                                <button type="submit" class="btn w-100" name="action" value="register_and_redirect"><span class="btn-inner--icon"><i class="fas fa-laptop-code text-primary me-2"></i></span> AGREGAR COMPONENTES</button>
                            </div>
                            <div class="form-group col-sm-5 mb-3 mb-sm-3">
                                <hr>
                                <button type="submit" class="btn w-100" name="action" value="register"><span class="btn-inner--icon"><i class="fa fa-save text-primary me-2"></i></span>GUARDAR ACTIVO INFORMATICO</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{asset ('assets/js/inputs-validations-equipos.js')}}"></script>
@endpush