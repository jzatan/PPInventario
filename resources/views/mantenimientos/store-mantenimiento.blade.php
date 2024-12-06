<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Registro de mantenimiento')

@push('css')

@endpush

@section('header-nav', 'Registro de mantenimiento')
@section('header', 'Registro de mantenimiento')
@section('content')
<!--Contenido-->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form id="form-prestamos" action="{{route('mantenimientos.store')}}" method="post">
                        @csrf
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <label for="nombre_equipo"> ACTIVO INFORMATICO</label>
                                <input type="text" class="form-control" name="nombre_equipo" id="nombre_equipo" title="Solo alfanumericos" disabled value="{{$equipo -> nombre_equipo ?? ''}} {{$equipo -> marca ?? ''}} {{$equipo -> modelo ?? ''}} ">
                                <input hidden type="text" name="equipo_id" id="equipo_id" value="{{$equipo -> id}}">
                            </div>
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <label for="area_id">AREA DE ENVIO</label>
                                <!-- Llamamos a las areas en estado 1 = activos-->
                                <select class="form-control" id="area_id" name="area_id">
                                    
                                    <option value="">{{$equipo -> areas -> nombre_area ?? ''}}</option>
                                 
                                </select>
                            </div>
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <label for="id_usuario_mantenimiento">ENCARGADO DE MANTENIMIENTO</label>
                                <!-- Llamamos a las areas en estado 1 = activos-->
                                <select class="form-control" id="id_usuario_mantenimiento" name="id_usuario_mantenimiento">
                                    @foreach ($usuarios as $item)
                                    <option value="{{$item->id}}">{{$item->nombres}} {{$item->apellidos}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6 mb-3 mb-sm-3">
                                <label for="fecha_envio"> FECHA DE ENVIO</label>
                                <input type="date" class="form-control" name="fecha_envio" id="fecha_envio" placeholder="COD. PRESTAMO" title="Solo alfanumericos" required>
                            </div>
                            <div class="form-group col-sm-6 mb-3 mb-sm-3">
                                <label for="fecha_retorno"> FECHA RETORNO</label>
                                <input type="date" class="form-control" name="fecha_retorno" id="fecha_retorno" placeholder="COD. PRESTAMO" title="Solo alfanumericos" required>
                            </div>

                            <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                <label for="problema"> PROBLEMA</label>
                                <textarea class="form-control" name="problema" id="problema" rows="4" title="Solo alfanumericos" placeholder="DETALLAR EL PROBLEMA"></textarea>
                            </div>
                            <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                <label for="diagnostico"> DIAGNOSTICO</label>
                                <textarea class="form-control" name="diagnostico" id="diagnostico" rows="4" title="Solo alfanumericos" placeholder="DETALLAR EL DIAGNOSTICO"></textarea>
                            </div>
                            <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                <label for="observaciones"> OBSERVACIONES</label>
                                <textarea class="form-control" name="observaciones" id="observaciones" rows="4" title="Solo alfanumericos" placeholder="DETALLAR OBSERVACIONES"></textarea>
                            </div>
                            <div class="form-group col-sm-6 mb-3 mb-sm-3">
                                <label for="estado_mantenimiento">ESTADO DE MANTENIMIENTO</label>
                                <!-- Llamamos a las areas en estado 1 = activos-->
                                <select class="form-control" id="estado_mantenimiento" name="estado_mantenimiento">
                                    <option class="text-center" value="1">PENDIENTE</option>
                                    <option class="text-center" value="2">EN PROCESO</option>
                                    <option class="text-center" value="3">FINALIZADO</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6 mb-3 mb-sm-3">
                                <label for="estado">DIAGNOSTICO FINAL</label>
                                <!-- Llamamos a las areas en estado 1 = activos-->
                                <select class="form-control" id="estado" name="estado">
                                    <option class="text-center" value="1">ACTIVO UTILIZABLE</option>
                                    <option class="text-center" value="2">ACTIVO INUTILIZABLE</option>
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
                                <button type="submit" class="btn w-100"><span class="btn-inner--icon"><i class="fa fa-save text-secondary me-2"></i></span>REGISTRAR MANTENIMIENTO</button>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];

        // Configurar fecha mínima y máxima en el input de fecha de préstamo
        const fechaPrestamo = document.getElementById('fecha_envio');
        fechaPrestamo.min = today;
        fechaPrestamo.max = today;

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