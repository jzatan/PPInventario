<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Editar registro de mantenimiento')

@push('css')

@endpush

@section('header-nav', 'Editar registro de mantenimiento')
@section('header', 'Editar registro de mantenimiento')
@section('content')
<!--Contenido-->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form id="form-mantenimientos-update" action="{{route('mantenimientos.update', $mantenimiento->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <label for="nombre_equipo"> ACTIVO INFORMATICO</label>
                                <input type="text" class="form-control" name="nombre_equipo" id="nombre_equipo" title="Solo alfanumericos" disabled value="{{$mantenimiento -> equipos -> nombre_equipo ?? ''}} {{$mantenimiento -> equipos -> marca ?? ''}} {{$mantenimiento -> equipos -> modelo ?? ''}}">
                                
                            </div>
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <label for="area_id">AREA DE ENVIO</label>
                                <!-- Llamamos a las areas en estado 1 = activos-->
                                <select class="form-control" id="area_id" name="area_id" disabled>
                                    <option value="">{{$mantenimiento -> equipos -> areas ->nombre_area ?? ''}}</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <label for="id_usuario_mantenimiento">ENCARGADO DE MANTENIMIENTO</label>
                                <!-- Llamamos a las areas en estado 1 = activos-->
                                <select class="form-control" id="id_usuario_mantenimiento" name="id_usuario_mantenimiento">
                                    @foreach ($usuarios as $item)
                                    <option value="{{$item->id}}" {{ $mantenimiento->id_usuario_mantenimiento == $item->id ? 'selected' : '' }}>{{$item->nombres}} {{$item->apellidos}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6 mb-3 mb-sm-3">
                                <label for="fecha_envio"> FECHA DE ENVIO</label>
                                <input type="date" class="form-control" name="fecha_envio" id="fecha_envio" placeholder="COD. PRESTAMO" title="Solo alfanumericos" value="{{$mantenimiento -> mantenimiento_detalle -> fecha_envio}}" disabled>
                            </div>
                            <div class="form-group col-sm-6 mb-3 mb-sm-3">
                                <label for="fecha_retorno"> FECHA RETORNO</label>
                                <input type="date" class="form-control" name="fecha_retorno" id="fecha_retorno" placeholder="COD. PRESTAMO" title="Solo alfanumericos" value="{{$mantenimiento -> mantenimiento_detalle -> fecha_retorno}}" required>
                            </div>

                            <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                <label for="problema"> PROBLEMA</label>
                                <textarea class="form-control" name="problema" id="problema" rows="4" title="Solo alfanumericos" placeholder="DETALLAR EL PROBLEMA" oninput="problemas(this)">{{$mantenimiento -> mantenimiento_detalle -> problema}}</textarea>
                            </div>
                            <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                <label for="diagnostico"> DIAGNOSTICO</label>
                                <textarea class="form-control" name="diagnostico" id="diagnostico" rows="4" title="Solo alfanumericos" placeholder="DETALLAR EL DIAGNOSTICO" oninput="diagnosticos_prestamo(this)">{{$mantenimiento -> mantenimiento_detalle -> diagnostico}}</textarea>
                            </div>
                            <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                <label for="observaciones"> OBSERVACIONES</label>
                                <textarea class="form-control" name="observaciones" id="observaciones" rows="4" title="Solo alfanumericos" placeholder="DETALLAR OBSERVACIONES" oninput="observaciones_mantenimiento(this)">{{$mantenimiento -> mantenimiento_detalle -> observaciones}}</textarea>
                            </div>
                            <div class="form-group col-sm-6 mb-3 mb-sm-3">
                                <label for="estado_mantenimiento">ESTADO DE MANTENIMIENTO</label>
                                <!-- Llamamos a las areas en estado 1 = activos-->
                                <select class="form-control" id="estado_mantenimiento" name="estado_mantenimiento">
                                    <option class="text-center" value="1" {{ $mantenimiento->mantenimiento_detalle->estado_mantenimiento == '1' ? 'selected' : '' }}>PENDIENTE</option>
                                    <option class="text-center" value="2" {{ $mantenimiento->mantenimiento_detalle->estado_mantenimiento == '2' ? 'selected' : '' }}>EN PROCESO</option>
                                    <option disabled class="text-center" value="3" {{ $mantenimiento->mantenimiento_detalle->estado_mantenimiento == '3' ? 'selected' : '' }}>FINALIZADO</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6 mb-3 mb-sm-3">
                                <label for="estado">DIAGNOSTICO FINAL</label>
                                <!-- Llamamos a las areas en estado 1 = activos-->
                                <select class="form-control" id="estado" name="estado">
                                    <option class="text-center" value="1" {{ $mantenimiento->estado == '1' ? 'selected' : '' }}>ACTIVO UTILIZABLE</option>
                                    <option class="text-center" value="2" {{ $mantenimiento->estado == '2' ? 'selected' : '' }}>ACTIVO INUTILIZABLE</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <hr>
                                <a class="btn btn-primary w-100" href="{{route ('mantenimientosgenerales')}}"><i class="fas fa-reply me-2" aria-hidden="true"></i>REGRESAR</a>
                            </div>
                            <div class="form-group col-sm-8 mb-3 mb-sm-3">
                                <hr>
                                <button type="submit" class="btn w-100"><span class="btn-inner--icon"><i class="fa fa-save text-secondary me-2"></i></span>ACTUALIZAR REGISTRO</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];

        // Configurar fecha mínima en el input de fecha de devolución
        const fechaDevolucion = document.getElementById('fecha_retorno');
        fechaDevolucion.min = today;

        // Actualizar la fecha mínima de devolución al seleccionar la fecha de préstamo (aunque es fija en este caso)
        fechaPrestamo.addEventListener('change', function() {
            fechaDevolucion.min = fechaPrestamo.value;
        });
    });
</script>

@endpush