<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Control de mantenimientos generales')

@push('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

@endpush

@section('header-nav', 'Control de mantenimientos generales')
@section('header', 'Control de mantenimientos generales')
@section('content')
<!--Contenido-->

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col justify-content-start">
                        </div>
                        <div class="col d-flex justify-content-end">
                            <div class="input-group mb-4">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input id="buscar" type="text" class="form-control" placeholder="Search" data-search="true">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-2">
                        <table id="tabla-equipos" class="table table-responsive align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">COD. REGISTRO</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">ACTIVO INFORMATICO</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">COLOR</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">estado</th>
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
                                        <h6 class="ms-auto text-center text-sm mb-0">{{$equipo -> nombre_equipo ?? ''}} {{$equipo -> marca ?? ''}} {{$equipo -> modelo ?? ''}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="ms-auto text-center text-sm mb-0">{{$equipo -> color ?? ''}}</h6>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if ($equipo->estado == 1)
                                        <span class="badge bg-success">OPERATIVA</span>
                                        @elseif ($equipo->estado == 2)
                                        <span class="badge bg-info">REGULAR</span>
                                        @elseif ($equipo->estado == 3)
                                        <span class="badge bg-danger">INOPERATIVA</span>
                                        @elseif ($equipo->estado == 4)
                                        <span class="badge bg-warning">EN MANTENIMIENTO</span>
                                        @else
                                        <span class="badge bg-light">ESTADO DESCONOCIDO</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="ms-auto text-center">
                                            @can('create-mantenimientos') <a title="MANTENIMIENTO" class="btn btn-link text-dark px-3 mb-0" href="{{route('mantenimientos.create', ['equipo' => $equipo->id])}}"><i class="fas fa-tools"></i></a>@endcan
                                            <a title="HISTORIAL DE MANTENIMIENTOS" data-bs-toggle="modal" data-bs-target="#historialModal-{{$equipo->id}}"><i class="fa-solid fa-clock-rotate-left"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@foreach ($equipos as $equipo)
<div class="modal fade" id="historialModal-{{$equipo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="container">
                            <div class="row">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 text-sm text-center text-primary">
                                        - HISTORIAL DE MANTENIMIENTOS CORRECTIVOS: {{$equipo->nombre_equipo ?? 'ERROR'}}
                                        {{$equipo->marca ?? ''}}
                                        {{$equipo->modelo ?? ''}} -
                                    </h6>
                                    <span class="mb-2 text-xs text-center">
                                        <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                            @php
                                            $historial_mantenimientos = $mantenimientos->where('equipo_id', $equipo->id);
                                            @endphp

                                            @if ($historial_mantenimientos->isEmpty())
                                            "NO EXISTEN REGISTROS DE REPORTES <br>
                                            DE MANTENIMIENTOS PARA ESTE ACTIVO INFORMATICO"

                                            @else
                                            <table class="table table-responsive align-items-center mb-0" id="tabla-mantenimientos">
                                                <thead>
                                                    <tr>
                                                        <th hidden class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">COD. REGISTRO</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">ID</th>
                                                        <th hidden class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">ACTIVO INFORMATICO</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">PERSONAL RESPONSABLE</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">FECHA DE ENVIO</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">FECHA DE RETORNO</th>
                                                        <th hidden class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">PROBLEMA</th>
                                                        <th hidden class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">DIAGNOSTICO</th>
                                                        <th hidden class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">OBSERVACIONES</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">ESTADO</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">DIAGNOSTICO FINAL</th>
                                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">ACCIONES</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($historial_mantenimientos as $mantenimiento)
                                                    <tr>
                                                        <td hidden>
                                                            {{$equipo ->cod_registro}}
                                                        </td>
                                                        <td>
                                                            <h6 class="ms-auto text-center text-sm mb-0">{{$mantenimiento-> id}}</h6>
                                                        </td>
                                                        <td hidden>
                                                            {{$equipo -> nombre_equipo ?? ''}} {{$equipo -> marca ?? ''}} {{$equipo -> modelo ?? ''}}
                                                        </td>
                                                        <td>
                                                            <h6 class="ms-auto text-center text-sm mb-0"> {{$mantenimiento->mantenimiento_usuario->nombres ?? ''}} {{$mantenimiento->mantenimiento_usuario->apellidos ?? ''}}</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="ms-auto text-center text-sm mb-0"> {{$mantenimiento->mantenimiento_detalle->fecha_envio }} </h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="ms-auto text-center text-sm mb-0">{{$mantenimiento->mantenimiento_detalle->fecha_retorno }} </h6>
                                                        </td>
                                                        <td hidden class="text-start">
                                                            {{$mantenimiento->mantenimiento_detalle->problema }}
                                                        </td>
                                                        <td hidden class="text-start">
                                                            {{$mantenimiento->mantenimiento_detalle->diagnostico }}
                                                        </td>
                                                        <td hidden class="text-start">
                                                            {{$mantenimiento->mantenimiento_detalle->observaciones }}
                                                        </td>
                                                        <td>
                                                            @if ($mantenimiento->mantenimiento_detalle->estado_mantenimiento == 1)
                                                            <span class="badge bg-warning">PENDIENTE</span>
                                                            @elseif ($mantenimiento->mantenimiento_detalle->estado_mantenimiento == 2)
                                                            <span class="badge bg-warning">EN PROCESO</span>
                                                            @elseif ($mantenimiento->mantenimiento_detalle->estado_mantenimiento == 3)
                                                            <span class="badge bg-success">FINALIZADO</span>
                                                            @else
                                                            <span class="badge bg-light">ESTADO DESCONOCIDO</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($mantenimiento->estado == 1)
                                                            <span class="badge bg-success">ACTIVO UTILIZABLE</span>
                                                            @elseif ($mantenimiento->estado == 2)
                                                            <span class="badge bg-danger">ACTIVO INUTILIZABLE</span>
                                                            @else
                                                            <span class="badge bg-light">ESTADO DESCONOCIDO</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="ms-auto text-center">
                                                            @can('edit-mantenimeintos')<a title="EDITAR" class="btn btn-link text-info px-3 mb-0" href="{{route ('mantenimientos.edit', ['mantenimiento' => $mantenimiento])}}"><i class="fas fa-pencil-alt text-info" aria-hidden="true"></i></a>  @endcan
                                                                <a title="DESCARGAR REPORTE" class="btn-pdf">
                                                                    <i class="fas fa-file-pdf text-danger"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endforeach


@endsection

@push('js')
<!-- SCRIPT QUE PERMITE OCULTAR EL MENU CUANDO ABRIMOS UN MODAL -->
<script>
    // Escuchar eventos de apertura y cierre de cualquier modal
    document.addEventListener('show.bs.modal', function() {
        document.getElementById('sidenav-main').style.zIndex = '1020'; // Ajusta el z-index del sidenav
    });

    document.addEventListener('hidden.bs.modal', function() {
        document.getElementById('sidenav-main').style.zIndex = '1030'; // Restaura el z-index del sidenav
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Seleccionar todos los botones con la clase 'btn-pdf'
        const botonesPdf = document.querySelectorAll('.btn-pdf');

        // Agregar un listener a cada botón
        botonesPdf.forEach((boton) => {
            boton.addEventListener('click', function(event) {
                event.preventDefault(); // Evitar el comportamiento predeterminado del enlace

                // Obtener la fila asociada al botón
                const fila = boton.closest('tr');
                if (!fila) return;

                // Extraer los datos de la fila
                const datos = [
                    `COD. REGISTRO: ${fila.cells[0].innerText}`,
                    `ACTIVO INFORMATICO: ${fila.cells[2].innerText}`,
                    `PERSONAL RESPONSABLE: ${fila.cells[3].innerText}`,
                    `FECHA DE ENVIO: ${fila.cells[4].innerText}`,
                    `FECHA DE RETORNO: ${fila.cells[5].innerText}`,
                    `PROBLEMA: ${fila.cells[6].innerText}`,
                    `DIAGNÓSTICO: ${fila.cells[7].innerText}`,
                    `OBSERVACIONES: ${fila.cells[8].innerText}`,
                    `ESTADO: ${fila.cells[9].innerText}`,
                    `DIAGNOSTICO FINAL: ${fila.cells[10].innerText}`,
                ];

                // Crear el PDF
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF();

                // Agregar título
                doc.setFontSize(16);
                doc.text('REPORTE DE MANTENIMIENTO CORRECTIVO - ', 20, 20);

                // Configurar márgenes y ancho máximo
                const marginX = 20; // Margen izquierdo
                const maxWidth = 160; // Ancho máximo para el texto
                let y = 40; // Coordenada Y inicial (ajustada para dejar espacio suficiente debajo del título)

                // Agregar los datos al PDF con alineación y separación adecuada
                doc.setFontSize(12); // Tamaño de letra
                datos.forEach((linea) => {
                    const partes = linea.split(':'); // Dividir el texto en "Etiqueta" y "Valor"
                    const etiqueta = partes[0] + ':'; // Parte antes de ":"
                    const valor = partes.slice(1).join(':').trim(); // Parte después de ":"

                    // Escribir la etiqueta
                    doc.text(etiqueta, marginX, y);

                    // Escribir el valor con ajuste de líneas largas
                    const lineasAjustadas = doc.splitTextToSize(valor, maxWidth - 50); // Ajuste de líneas largas
                    doc.text(lineasAjustadas, marginX + 60, y); // Sangría para el valor

                    // Incrementar Y según el número de líneas ajustadas
                    y += lineasAjustadas.length * 7; // Altura dinámica según las líneas usadas
                    y += 2; // Espaciado adicional para separar cada campo
                });

                // Descargar el PDF
                doc.save(`reporte_mantenimiento_${fila.rowIndex}.pdf`);
            });
        });
    });
</script>

@endpush