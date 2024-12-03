<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Registrar prestamo')

@push('css')

@endpush

@section('header-nav', 'Registrar prestamo')
@section('header', 'Registrar prestamo')
@section('content')
<!--Contenido-->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form id="form-prestamos" action="{{route('prestamos.store')}}" method="post">
                        @csrf

                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-8 mb-3 mb-sm-3">
                                <label for="nombre_equipo"> NOMBRE DE EQUIPO</label>
                                <input type="text" class="form-control" name="nombre_equipo" id="nombre_equipo" title="Solo alfanumericos" disabled value="{{$equipo -> nombre_equipo ?? ''}} {{$equipo -> marca ?? ''}} {{$equipo -> modelo ?? ''}} ">
                                <input hidden type="text" name="equipo_id" id="equipo_id" value="{{$equipo -> id}}">
                            </div>
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <label for="cod_prestamo"> COD. PRESTAMO</label>
                                <input type="text" class="form-control" name="cod_prestamo" id="cod_prestamo" placeholder="COD. PRESTAMO" title="Solo alfanumericos" required >
                            </div>
                            <div class="form-group col-sm-6 mb-3 mb-sm-3">
                                <label for="id_prestario">PRESTAMISTA</label>
                                <!-- Llamamos a las areas en estado 1 = activos-->
                                <select class="form-control" id="id_prestario" name="id_prestario">
                                    <option value="">{{$equipo -> areas -> nombre_area}}</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6 mb-3 mb-sm-3">
                                <label for="id_prestador_area">PRESTATARIO</label>
                                <!-- Llamamos a las areas en estado 1 = activos-->
                                <select class="form-control" id="id_prestador_area" name="id_prestador_area">
                                    @foreach ($areas as $item)
                                    <option value="{{$item->id}}">{{$item->nombre_area ?? ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <label for="fecha_prestamo"> FECHA PRESTAMO</label>
                                <input type="date" class="form-control" name="fecha_prestamo" id="fecha_prestamo" placeholder="COD. PRESTAMO" title="Solo alfanumericos" required >
                            </div>
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <label for="fecha_devolucion"> FECHA DEVOLUCION</label>
                                <input type="date" class="form-control" name="fecha_devolucion" id="fecha_devolucion" placeholder="COD. PRESTAMO" title="Solo alfanumericos" required >
                            </div>
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <label for="estado">ESTADO</label>
                                <select name="estado" id="estado" class="form-control text-center text-bold">
                                    <option value="0" class="text-center">PRESTADO</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                <label for="observaciones"> OBSERVACIONES</label>
                                <textarea class="form-control" name="observaciones" id="observaciones" title="Solo alfanumericos" placeholder="DETALLAR OBSERVACIONES"></textarea>
                            </div>

                        </div>



                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <hr>
                                <a class="btn btn-primary w-100" href="{{route ('activosdisponibles')}}"><i class="fas fa-reply me-2" aria-hidden="true"></i>REGRESAR</a>
                            </div>
                            <div class="form-group col-sm-8 mb-3 mb-sm-3">
                                <hr>
                                <button type="submit" class="btn w-100"><span class="btn-inner--icon"><i class="fa fa-save text-secondary me-2"></i></span>REGISTRAR PRESTAMO</button>
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
        const fechaPrestamo = document.getElementById('fecha_prestamo');
        fechaPrestamo.min = today;
        fechaPrestamo.max = today;

        // Configurar fecha mínima en el input de fecha de devolución
        const fechaDevolucion = document.getElementById('fecha_devolucion');
        fechaDevolucion.min = today;

        // Actualizar la fecha mínima de devolución al seleccionar la fecha de préstamo (aunque es fija en este caso)
        fechaPrestamo.addEventListener('change', function() {
            fechaDevolucion.min = fechaPrestamo.value;
        });
    });
</script>

@endpush