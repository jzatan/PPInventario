<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Equipos informaticos')


@push('css')
<!-- Script que nos permitira descargar en excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<!-- Scripts que nos permitira descargar en pdf -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

@endpush

@section('header-nav', 'Equipos informaticos')
@section('header', 'Equipos informaticos')
@section('content')

<!--Contenido-->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">

                        <div class="col justify-content-start">
                            <div class="input-group mb-4">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input id="buscar" type="text" class="form-control" placeholder="Search" data-search="true">
                            </div>
                        </div>

                        <div class="col d-flex justify-content-end">
                            <a class="btn btn-white" id="exportar-pdf"><i class="fas fa-file-pdf  text-danger me-2" aria-hidden="true"></i>PDF</a>
                            <a class="btn btn-white" id="exportar-excel"><i class="fa fa-solid fa-file-excel text-success me-2" aria-hidden="true"></i>EXCEL</a>
                            <a class="btn btn-white" href="{{route ('equipos.create')}}"><i class="fa fa-cloud-upload-alt text-primary me-2" aria-hidden="true"></i>REGISTRAR EQUIPOS</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="tabla-resultado" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">COD. REGISTRO</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">ORD. COMPRA</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">EQUIPO INFORMATICO</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">MARCA - modelo</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">COLOR</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">NRO. SERIE</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">FECHA ADQUISION</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">estado</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">OBSERVACIONES</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipos as $equipo)
                                <tr>
                                    <td>
                                        <h6 class="text-center text-sm mb-0">{{$equipo -> cod_registro}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center text-sm mb-0">{{$equipo -> ord_compra ?? 'SIN ORDEN DE COMPRA'}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center text-sm mb-0">{{$equipo -> nombre_equipo}}</h6>
                                    </td>
                                    <td>
                                        <a href="" title="Componentes" data-bs-toggle="modal" data-bs-target="#componentesModal-{{$equipo->id}}">
                                            <h6 class="ms-auto text-center text-sm mb-0">{{$equipo -> marca}} - {{$equipo -> modelo}}</h6>
                                        </a>
                                    </td>
                                    <td>
                                        <h6 class="text-center text-sm mb-0">{{$equipo -> color}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center text-sm mb-0">{{$equipo -> nro_serie}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center text-sm mb-0">{{\Carbon\Carbon::parse($equipo -> fecha_adquision)->format('d-m-Y')}}</h6>
                                    </td>
                                    <!--@if ($equipo->estado==1)
                                        <span class="fw-bolder p-1 rounded bg-success text-white d-flex justify-content-center align-items-center" style="height: 35px; width: 70px;">Activo</span>
                                        @else
                                        <span class="fw-bolder p-1 rounded bg-danger text-white d-flex justify-content-center align-items-center" style="height: 35px; width: 70px;">Inactivo</span>
                                        @endif-->
                                    <td class="align-middle text-center text-sm">
                                        @if ($equipo->estado == 0)
                                        <span class="badge bg-success d-flex justify-content-center align-items-center">BUENA</span>
                                        @elseif ($equipo->estado == 1)
                                        <span class="badge bg-success d-flex justify-content-center align-items-center">OPERATIVA</span>
                                        @elseif ($equipo->estado == 2)
                                        <span class="badge bg-warning d-flex justify-content-center align-items-center">REGULAR</span>
                                        @elseif ($equipo->estado == 3)
                                        <span class="badge bg-danger d-flex justify-content-center align-items-center">MALA</span>
                                        @elseif ($equipo->estado == 4)
                                        <span class="badge bg-danger d-flex justify-content-center align-items-center">INOPERATIVA</span>
                                        @else
                                        <span class="badge bg-light d-flex justify-content-center align-items-center">ESTADO DESCONOCIDO</span>
                                        @endif
                                    </td>
                                    <td>
                                        <h6 class="text-center text-sm mb-0">{{$equipo -> observacion ?? 'SIN OBSERVACIONES'}}</h6>
                                    </td>
                                    <td>
                                        <div class="ms-auto text-center">
                                            <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-tools me-2"></i></a>
                                            <a class="btn btn-link text-info px-3 mb-0" href="{{route ('equipos.edit', ['equipo' => $equipo])}}"><i class="fas fa-pencil-alt text-info me-2" aria-hidden="true"></i></a>
                                            <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="" data-bs-toggle="modal" data-bs-target="#deleteEquipoModal"><i class="far fa-trash-alt me-2"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- WARNING DELETE EQUIPOS -->
                                <div class="modal fade" id="deleteEquipoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Advertencia</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Seguro que deseas eliminar el equipo informatico?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                                <form action="{{route('equipos.destroy',['equipo'=>$equipo->id])}}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn bg-gradient-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END WARNING DELETE EQUIPOS -->

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @foreach ($equipos as $equipo)
                    <!--- modal-componentes -->
                    <div class="modal fade" id="componentesModal-{{$equipo -> id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7" id="exampleModalLabel">{{$equipo -> nombre_equipo}} - {{$equipo -> marca}} {{$equipo -> modelo}}</h6>
                                    <a class="btn btn-white" data-bs-toggle="modal" data-bs-target="#createComponente-{{$equipo -> id}}"><i class="fas fa-laptop-code text-primary me-2" aria-hidden="true"></i>REGISTRAR COMPONENTES</a>
                                </div>
                                <div class="modal-body">
                                    @php
                                    $componentesDelEquipo = $componentes->where('equipo_id', $equipo->id);
                                    @endphp

                                    @if ($componentesDelEquipo->isEmpty())
                                    <!-- Tabla vacía si no hay componentes -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">COMPONENTES</th>
                                                <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="3" class="text-center ms-auto text-start text-sm mb-0">NO SE REGISTRARON COMPONENTES PARA ESTE EQUIPO</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @else
                                    <!-- Tabla con los componentes si existen -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">COMPONENTES</th>
                                                <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($componentesDelEquipo as $componente)
                                            <tr>
                                                <td>
                                                    <a href="" title="Componentes" data-bs-toggle="modal" data-bs-target="#componentesModal-{{$equipo->id}}">
                                                        <h6 class="ms-auto text-start text-sm mb-0">{{$componente -> descripcion}}</h6>
                                                    </a>
                                                    <p class="ms-auto text-start text-xs text-secondary mb-0">{{$componente -> nombre_componente}}</p>
                                                </td>
                                                <td>
                                                    <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#updateComponente"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--- Fin-modal-componentes-->
                    @endforeach

                    @foreach ($equipos as $equipo)
                    <!-- createComponentes modal -->
                    <div class="modal fade" id="createComponente-{{$equipo -> id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7" id="exampleModalLabel">{{$equipo -> nombre_equipo}} - {{$equipo -> marca}} {{$equipo -> modelo}}</h6>

                                </div>
                                <div class="modal-body">
                                    AQUI REGISTRARAN COMPONENTES
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- fin createComponentes modal -->
                    @endforeach
                    <!--  UpdateComponentes modal -->
                    <div class="modal fade" id="updateComponente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7" id="exampleModalLabel">{{$equipo -> nombre_equipo ?? ''}} - {{$equipo -> marca ?? ''}} {{$equipo -> modelo ?? ''}}</h6>
                                    <a href="{{route ('componentes.create')}}" class="btn btn-white"><i class="fas fa-laptop-code text-primary me-2" aria-hidden="true"></i>REGISTRAR COMPONENTES</a>
                                </div>
                                <div class="modal-body">
                                    AQUI ESTE EDITARA COMPONENTE
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- fin UpdateComponentes modal -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<!-- Script que permite buscar los equipos registrados -->
<script>
    var busqueda = document.getElementById('buscar');
    var table = document.getElementById("tabla-resultado").tBodies[0];

    buscaTabla = function() {
        texto = busqueda.value.toLowerCase();
        var r = 0;
        while (row = table.rows[r++]) {
            if (row.innerText.toLowerCase().indexOf(texto) !== -1)
                row.style.display = null;
            else
                row.style.display = 'none';
        }
    }
    busqueda.addEventListener('keyup', buscaTabla);
</script>

<script src="{{asset ('assets/js/equipos-informaticos.js')}}"></script>
<!-- Script para descargar PDF -->
<script>
    document.getElementById('exportar-pdf').addEventListener('click', function() {

        // Obtener los datos de la tabla
        var tabla = document.getElementById('tabla-resultado');

        // Crear un array para almacenar las cabeceras
        var cabeceras = [];
        // Tomamos las cabeceras de la tabla, excepto la columna de "Acciones"
        var headers = tabla.rows[0].cells;
        for (var i = 0; i < headers.length - 1; i++) { // Nota el "-1" para omitir la última columna
            cabeceras.push(headers[i].innerText.trim());
        }

        // Crear un array para almacenar los datos de las filas
        var data = [];

        // Recorrer las filas de la tabla
        for (var i = 1, row; row = tabla.rows[i]; i++) {
            var fila = [];
            // Recorrer las celdas de cada fila (omitimos la última columna "Acciones")
            for (var j = 0; j < row.cells.length - 1; j++) {
                fila.push(row.cells[j].innerText.trim());
            }
            data.push(fila); // Guardar la fila en los datos
        }

        // Crear un nuevo documento PDF en orientación horizontal
        var {
            jsPDF
        } = window.jspdf;
        var doc = new jsPDF({
            orientation: 'landscape'
        });

        // Generar tabla con jsPDF-AutoTable
        doc.autoTable({
            head: [cabeceras], // Cabeceras de la tabla
            body: data, // Datos de la tabla
            theme: 'grid' // Estilo de tabla
        });

        // Guardar el PDF
        doc.save('equipos_informaticos.pdf');
    });
</script>



@endpush