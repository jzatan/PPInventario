<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Editar activo informatico')

@push('css')

@endpush

@section('header-nav', 'Editar activo informatico')
@section('header', 'Editar activo informatico')
@section('content')
<!--Contenido-->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form id="formEquipos-update" action="{{route('equipos.update', $equipo -> id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-6 mb-3 mb-sm-3">
                                <label for="categoria_id">CATEGORIA</label>
                                <!-- Llamamos a las areas en estado 1 = activos-->
                                <select class="form-control text-center" id="categoria_id" name="categoria_id">
                                    @foreach ($categorias as $item)
                                    <option value="{{$item->id}}" {{ $equipo->categoria_id == $item->id ? 'selected' : '' }}>{{$item->nombre_categoria}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6 mb-3 mb-sm-3">
                                <label for="usuario_id">REGISTRADO POR</label>
                                <!-- Llamamos a las areas en estado 1 = activos-->
                                <input type="text" class="form-control text-center" title="solo números" value="{{$equipo->usuarios->nombres ?? ''}} {{$equipo->usuarios->apellidos ?? ''}}" disabled>
                                <input hidden type="text" id="usuario_id" name="usuario_id" value="{{$equipo->usuario_id ?? ''}}">
                            </div>
                            <div class="form-group col-sm-6 mb-3 mb-sm-3">
                                <label for="area_id">DESTINO</label>
                                <!-- Llamamos a las areas en estado 1 = activos-->
                                <select class="form-control text-center" id="area_id" name="area_id">
                                    @foreach ($areas as $item)
                                    <option value="{{$item->id}}" {{ $equipo->area_id == $item->id ? 'selected' : '' }}>{{$item->nombre_area ?? ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="cod_registro"> CODIGO DE REGISTRO</label>
                                <input type="text" class="form-control text-center" id="cod_registro" name="cod_registro" title="solo números" placeholder="INGRESE COD. REGISTRO" value="{{$equipo -> cod_registro}}" required oninput="solo_numeros(this)">
                                <div id="codregistroMessage" class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="ord_compra"> ORDEN DE COMPRA</label>
                                <input type="text" class="form-control text-center" id="ord_compra" name="ord_compra" title="solo letras" value="{{$equipo -> ord_compra ?? 'SIN ORDEN DE COMPRA'}}" placeholder="INGRESE ORDEN DE COMPRA" oninput="orden_compra(this)">
                            </div>
                        </div>

                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-3 mb-3 mb-sm-3">
                                <label for="nombre_equipo"> NOMBRE DE EQUIPO</label>
                                <input type="text" class="form-control text-center" name="nombre_equipo" id="nombre_equipo" title="Solo alfanumericos" placeholder="INGRESE NOMBRE EQUIPO" value="{{$equipo -> nombre_equipo}}" oninput="nombre_equipo(this)" required>
                            </div>
                            <div class="form-group col-sm-3 mb-3 mb-sm-3">
                                <label for="marca"> MARCA</label>
                                <input type="text" class="form-control text-center" id="marca" name="marca" title="Solo alfanumericos" placeholder="INGRESE MARCA DE EQUIPO" value="{{$equipo -> marca}}" required oninput="marca_equipo(this)">
                            </div>
                            <div class="form-group col-sm-3 mb-3 mb-sm-3">
                                <label for="modelo"> MODELO</label>
                                <input type="text" class="form-control text-center" id="modelo" name="modelo" title="Solo alfanumericos" placeholder="INGRESE MODELO DE EQUIPO" oninput="modelo_equipo(this)" value="{{$equipo -> modelo}}" required>
                            </div>
                            <div class="form-group col-sm-3 mb-3 mb-sm-0">
                                <label for="color">COLOR DEL EQUIPO</label>
                                <input type="text" class="form-control text-center" name="color" id="color" title="Solo letras" placeholder="INGRESE COLOR DEL EQUIPO" value="{{$equipo -> color}}" oninput="color_equipo(this)" required>
                            </div>
                            <!--<div class="form-group col-sm-3 mb-3 mb-sm-0">
                                <label for="nro_serie">NÚMERO DE SERIE</label>
                                <input type="text" class="form-control" name="nro_serie" id="nro_serie" title="Solo alfanumericos" placeholder="INGRESE NRO. SERIE" oninput="validateNROSERIE()" required>
                            </div>-->
                        </div>
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <label for="nro_serie">NÚMERO DE SERIE</label>
                                <input type="text" class="form-control text-center" name="nro_serie" id="nro_serie" title="Solo alfanumericos" placeholder="INGRESE NRO. SERIE" value="{{$equipo -> nro_serie}}" oninput="numero_serie(this)" required>
                            </div>
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <label for="fecha_adquision">FECHA DE ADQUISION</label>
                                <input type="date" class="form-control text-center" name="fecha_adquision" id="fecha_adquision" title="formato dd/mm/yy" value="{{$equipo -> fecha_adquision}}" required>
                            </div>
                            <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                <label for="estado">ESTADO</label>
                                <select name="estado" id="estado" class="form-control text-center text-bold">
                                    @php
                                    $estados = [
                                    "1" => "OPERATIVA",
                                    "2" => "REGULAR",
                                    "3" => "INOPERATIVA",
                                    "4" => "EN MANTENIMIENTO"
                                    ];
                                    @endphp
                                    @foreach ($estados as $value => $label)
                                    <option class="text-center" value="{{$value}}" @if($equipo -> estado == $value) selected @endif>{{$label}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                            <label for="observacion">OBSERVACIONES</label>
                            <textarea class="form-control" name="observacion" id="observacion" title="Solo alfanumericos" placeholder="DETALLAR OBSERVACIONES" oninput="observaciones(this)">{{$equipo -> observacion ?? 'SIN OBSERVACIONES'}}</textarea>
                        </div>
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-2 mb-3 mb-sm-3">
                                <hr>
                                <a class="btn btn-primary w-100" href="{{route ('activosregistrados')}}"><i class="fas fa-reply me-2" aria-hidden="true"></i>REGRESAR</a>
                            </div>
                            <div class="form-group col-sm-5 mb-3 mb-sm-3">
                                <hr>
                                <button type="reset" class="btn btn-secondary w-100"><span class="btn-inner--icon"><i class="fas fa-undo me-2"></i></span>DESHACER CAMBIOS</button>
                            </div>
                            <div class="form-group col-sm-5 mb-3 mb-sm-3">
                                <hr>
                                <button type="submit" class="btn w-100" name="action" value="register"><span class="btn-inner--icon"><i class="fa fa-save text-primary me-2"></i></span>CONFIRMAR</button>
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
<script src="{{asset ('assets/js/validacion-campos-imputs.js')}}"></script>
<script>
    /* 06. Script que me permite validar fechas*/

    // Obtener la fecha actual en formato YYYY-MM-DD
    const today = new Date().toISOString().split("T")[0];
    // Establecer el atributo max al input de fecha
    document.getElementById("fecha_adquision").setAttribute("max", today);
</script>
@endpush