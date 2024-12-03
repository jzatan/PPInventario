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
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-2">
                        <table id="tabla-equipos" class="table table-responsive align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">COD. REGISTRO</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">ORD. COMPRA</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">ACTIVO INFORMATICO</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">COLOR</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">DESTINO</th>
                                    <th hidden class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">FECHA ADQUISICIÓN</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">TIEMPO ADQUISICIÓN</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">estado</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">OBSERVACIONES</th>
                                    @can('edit-equipos') <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">ACCIONES</th> @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipos as $equipo)
                                <tr>
                                    <td>
                                        <div class="ms-auto text-center">
                                            <a class="btn btn-link text-dark px-3 mb-0" href="" title="DETALLES" data-bs-toggle="modal" data-bs-target="#componentesModal-{{$equipo->id}}">
                                                <i class="fas fa-info-circle text-dark"></i>
                                            </a>
                                        </div>
                                        <div class="ms-auto text-center">
                                            <a class="btn btn-link text-dark px-3 mb-0" href="" title="HISTORIAL DE PRESTAMOS" data-bs-toggle="modal" data-bs-target="#historialModal-{{$equipo->id}}">
                                                <i class="fas fa-history text-dark"></i>
                                            </a>
                                        </div>
                                    </td>

                                    <td>
                                        <h6 class="text-center text-sm mb-0">{{$equipo -> cod_registro}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center text-sm mb-0">{{$equipo -> ord_compra ?? 'SIN ORDEN DE COMPRA'}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="ms-auto text-center text-sm mb-0">{{$equipo -> nombre_equipo ?? ''}} {{$equipo -> marca ?? ''}} {{$equipo -> modelo ?? ''}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="ms-auto text-center text-sm mb-0">{{$equipo -> color ?? ''}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="ms-auto text-center text-sm mb-0">{{$equipo -> areas ->nombre_area ?? ''}}</h6>
                                    </td>
                                    <td hidden>
                                        <h6 class="fecha_adquision text-center text-sm mb-0">{{ \Carbon\Carbon::parse($equipo->fecha_adquision)->format('Y-m-d') }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="resultado text-center text-sm mb-0"></h6>
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
                                        <h6 class="text-center text-sm mb-0">{{$equipo -> observacion ?? 'SIN OBSERVACIONES'}}</h6>
                                    </td>
                                    @can('edit-equipos')
                                    <td>
                                        <div class="ms-auto text-center">
                                            <a title="EDITAR" class="btn btn-link text-info px-3 mb-0" href="{{route ('equipos.edit', ['equipo' => $equipo])}}"><i class="fas fa-pencil-alt text-info" aria-hidden="true"></i></a>
                                            <a title="ELIMINAR" class="btn btn-link text-danger text-gradient px-3 mb-0" href="" data-bs-toggle="modal" data-bs-target="#deleteEquipoModal-{{$equipo->id}}"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                    @endcan
                                </tr>

                                <!-- WARNING DELETE EQUIPOS -->
                                <div class="modal fade" id="deleteEquipoModal-{{$equipo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                    <!-- tabla equipos oculta -->
                    <table hidden id="tabla-equipos-oculta">
                        <thead>
                            <tr>
                                <th>COD. REGISTRO</th>
                                <th>ACTIVO INFORMATICO</th>
                                <th>MARCA</th>
                                <th>MODELO</th>
                                <th>COLOR</th>
                                <th>NRO. SERIE</th>
                                <th>ORD. COMPRA</th>
                                <th>DESTINO</th>
                                <th>FECHA DE ADQUISICIÓN</th>
                                <th>ESTADO</th>
                                <th>COMPONENTES</th>
                                <th>OBSERVACIONES</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equipos as $equipo)
                            <tr>
                                <td>{{$equipo->cod_registro ?? ''}}</td>
                                <td>{{$equipo->nombre_equipo ?? ''}}</td>
                                <td>{{$equipo->marca ?? ''}}</td>
                                <td>{{$equipo->modelo ?? ''}}</td>
                                <td>{{$equipo->color ?? ''}}</td>
                                <td>{{$equipo->nro_serie ?? ''}}</td>
                                <td>{{$equipo->ord_compra ?? ''}}</td>
                                <td>{{$equipo->areas->nombre_area ?? ''}}</td>
                                <td>{{$equipo->fecha_adquision ?? ''}}</td>
                                <td>
                                    @if ($equipo->estado == 1)
                                    <span class="badge bg-success">OPERATIVA</span>
                                    @elseif ($equipo->estado == 2)
                                    <span class="badge bg-warning">REGULAR</span>
                                    @elseif ($equipo->estado == 3)
                                    <span class="badge bg-danger">INOPERATIVA</span>
                                    @elseif ($equipo->estado == 4)
                                    <span class="badge bg-info">EN MANTENIMIENTO</span>
                                    @else
                                    <span class="badge bg-light">ESTADO DESCONOCIDO</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                    $componentesDelEquipo = $componentes->where('equipo_id', $equipo->id);
                                    @endphp

                                    @if ($componentesDelEquipo->isEmpty())
                                    "SIN COMPONENTES REGISTRADOS"
                                    @else
                                    @foreach ($componentesDelEquipo as $componente)
                                    {{$componente->nombre_componente ?? ''}}:{{$componente->descripcion ?? ''}}
                                    @endforeach
                                    @endif
                                </td>
                                <td>{{$equipo -> observacion ?? 'SIN OBSERVACIONES'}}</td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <!-- fin de tabla oculta -->

                    @foreach ($equipos as $equipo)
                    <!--- modal-componentes -->
                    <div class="modal fade" id="componentesModal-{{$equipo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <ul class="list-group">
                                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="d-flex flex-column">
                                                                <h6 class="mb-3 text-sm">
                                                                    {{$equipo->nombre_equipo ?? 'ERROR'}}
                                                                    {{$equipo->marca ?? ''}}
                                                                    {{$equipo->modelo ?? ''}}
                                                                </h6>
                                                                <span class="mb-2 text-xs">DESTINO:
                                                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                                                        {{$equipo->areas->nombre_area}}
                                                                    </span>
                                                                </span>
                                                                <span class="mb-2 text-xs">CATEGORIA:
                                                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                                                        {{$equipo->categorias->nombre_categoria}}
                                                                    </span>
                                                                </span>
                                                                <span class="mb-2 text-xs">REGISTRADO POR:
                                                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                                                        {{$equipo->usuarios->nombres ?? 'ERROR'}}
                                                                        {{$equipo->usuarios->apellidos ?? ''}}
                                                                    </span>
                                                                </span>
                                                                <span class="mb-2 text-xs">CODIGO DE REGISTRO:
                                                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                                                        {{$equipo->cod_registro ?? ''}}
                                                                    </span>
                                                                </span>
                                                                <span class="mb-2 text-xs">ORDEN DE COMPRA:
                                                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                                                        {{$equipo->ord_compra ?? 'SIN ORDEN DE COMPRA'}}
                                                                    </span>
                                                                </span>
                                                                <span class="mb-2 text-xs">COLOR:
                                                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                                                        {{$equipo->color ?? ''}}
                                                                    </span>
                                                                </span>
                                                                <span class="mb-2 text-xs">NÚMERO DE SERIE:
                                                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                                                        {{$equipo->nro_serie ?? ''}}
                                                                    </span>
                                                                </span>
                                                                <span class="mb-2 text-xs">FECHA DE ADQUISICIÓN:
                                                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                                                        {{$equipo->fecha_adquision ?? ''}}
                                                                    </span>
                                                                </span>
                                                                <span class="mb-2 text-xs">OBSERVACIONES:
                                                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                                                        {{$equipo->observacion ?? 'SIN OBSERVACIONES'}}
                                                                    </span>
                                                                </span>
                                                                <span class="mb-2 text-xs">ESTADO DE EQUIPO:
                                                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                                                        @if ($equipo->estado == 1)
                                                                        <span class="badge bg-success">OPERATIVA</span>
                                                                        @elseif ($equipo->estado == 2)
                                                                        <span class="badge bg-success">REGULAR</span>
                                                                        @elseif ($equipo->estado == 3)
                                                                        <span class="badge bg-warning">EN MANTENIMIENTO</span>
                                                                        @else
                                                                        <span class="badge bg-light">ESTADO DESCONOCIDO</span>
                                                                        @endif
                                                                    </span>
                                                                </span>
                                                                <span class="mb-2 text-xs">COMPONENTES:
                                                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                                                        @php
                                                                        $componentesDelEquipo = $componentes->where('equipo_id', $equipo->id);
                                                                        @endphp

                                                                        @if ($componentesDelEquipo->isEmpty())
                                                                        "SIN COMPONENTES REGISTRADOS"
                                                                        <hr>
                                                                        @else
                                                                        <table class="table">
                                                                            <tbody>
                                                                                @foreach ($componentesDelEquipo as $componente)
                                                                                <tr>
                                                                                    <td class="text-start">
                                                                                        {{$componente->nombre_componente}} <br>
                                                                                        {{$componente->descripcion}}
                                                                                    </td>
                                                                                    <td class="text-end">
                                                                                        @can('update-componentes')
                                                                                        <a class="btn btn-link text-dark px-3 mb-0" href="" data-bs-toggle="modal" data-bs-target="#updateComponente-{{ $componente->id }}">
                                                                                            <i class="fas fa-pencil-alt text-dark" aria-hidden="true"></i>
                                                                                        </a>
                                                                                        @endcan
                                                                                        @can('delete-componentes')
                                                                                        <form action="{{ route('componentes.destroy', ['componente' => $componente->id]) }}" method="POST" style="display: inline;">
                                                                                            @method('DELETE')
                                                                                            @csrf
                                                                                            <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0" onclick="return confirm('¿Estás seguro de que deseas eliminar este componente?')">
                                                                                                <i class="far fa-trash-alt"></i>
                                                                                            </button>
                                                                                        </form>
                                                                                        @endcan
                                                                                    </td>

                                                                                </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        @endif
                                                                    </span>
                                                                </span>
                                                            </div>
                                                            @can('create-componentes')
                                                            <a class="btn btn-white" data-bs-toggle="modal" data-bs-target="#createComponente-{{$equipo -> id}}">
                                                                <i class="fas fa-laptop-code text-primary me-2" aria-hidden="true"></i>REGISTRAR COMPONENTES
                                                            </a>
                                                            @endcan

                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--- Fin-modal-componentes-->
                    @endforeach

                    @foreach ($equipos as $equipo)
                    <!-- createComponentes modal -->
                    <div class="modal fade" id="createComponente-{{$equipo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7" id="exampleModalLabel">{{$equipo -> nombre_equipo}} - {{$equipo -> marca}} {{$equipo -> modelo}}</h6>
                                </div>
                                <div class="modal-body">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <form id="" action="{{route('componentes.store')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="equipo_id" value="{{$equipo->id}}">
                                                <div class="form-group row mb-sm-0">
                                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                                        <div class="row">
                                                            <div class="col">
                                                                <!--<label for="componentes">{{ session('equipo') ? session('equipo')->nombre_equipo : '' }}
                                                                    {{ session('equipo') ? session('equipo')->marca : '' }} {{ session('equipo') ? session('equipo')->modelo : '' }}</label>-->
                                                            </div>
                                                            <div class="col text-end">
                                                                <button type="button" class="btn" id="agregarComponente"><i class="fas fa-laptop-code text-success me-2" aria-hidden="true"></i>AGREGAR COMPONENTE</button>
                                                            </div>
                                                        </div>

                                                        <table class="table" id="tabla-componentes" class="table align-items-center mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-77">Nombre del componente</th>
                                                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-77">Descripcion</th>
                                                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-77">Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="cuerpo-componentes">
                                                                <tr>

                                                                </tr>
                                                                <!-- Aquí se agregarán los componentes dinámicamente -->
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>

                                                <div class="form-group row mb-sm-0">
                                                    <div class="col text-end">
                                                        <hr>
                                                        <button type="submit" class="btn"><i class="fa fa-save text-primary me-2"></i>GUARDAR COMPONENTES</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- fin createComponentes modal -->
                    @endforeach

                    @foreach ($componentes as $componente)
                    <!--  UpdateComponentes modal -->
                    <div class="modal fade" id="updateComponente-{{$componente->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7" id="exampleModalLabel"> EDITAR COMPONENTES: {{$componente -> equipos -> nombre_equipo ?? ''}} {{$componente -> equipos -> marca ?? ''}} {{$componente -> equipos -> modelo ?? ''}}</h6>
                                </div>
                                <div class="modal-body">
                                    <form class="form-control" action="{{route('componentes.update', $componente -> id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row mb-sm-0">
                                            <input hidden class="form-control" type="text" name="equipo_id" id="equipo_id" value="{{$componente -> equipo_id}}">
                                            <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                                <label for="nombre_componente"> NOMBRE DEL COMPONENTE</label>
                                                <input type="text" class="form-control" name="nombre_componente" id="nombre_componente" title="Solo alfanumericos" placeholder="INGRESE COMPONENTE" value="{{$componente -> nombre_componente}}" required>
                                            </div>
                                            <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                                <label for="descripcion">DESCRIPCIÓN</label>
                                                <input type="text" class="form-control" id="descripcion" name="descripcion" title="Solo alfanumericos" placeholder="INGRESE DESCRIPCIÓN" value="{{$componente -> descripcion}}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-sm-0">
                                            <div class="form-group col-sm-2 mb-3 mb-sm-3">
                                                <hr>
                                                <a class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#componentesModal-{{$componente -> equipo_id}}" href=""><i class="fas fa-reply me-2" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="form-group col-sm-5 mb-3 mb-sm-3">
                                                <hr>
                                                <button type="reset" class="btn btn-secondary w-100"><span class="btn-inner--icon"><i class="fas fa-undo me-2"></i></span>DESHACER</button>
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
                    <!-- fin UpdateComponentes modal -->
                    @endforeach

                    @foreach ($equipos as $equipo)
                    <div class="modal fade" id="historialModal-{{$equipo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <ul class="list-group">
                                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="d-flex flex-column">
                                                                <h6 class="mb-3 text-sm">
                                                                    {{$equipo->nombre_equipo ?? 'ERROR'}}
                                                                    {{$equipo->marca ?? ''}}
                                                                    {{$equipo->modelo ?? ''}}
                                                                </h6>
                                                                <span class="mb-2 text-xs">HISTORIAL DE PRESTAMOS:
                                                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                                                        @php
                                                                        $historial_prestamos = $prestamos->where('equipo_id', $equipo->id);
                                                                        @endphp

                                                                        @if ($historial_prestamos->isEmpty())
                                                                        "SIN PRESTAMOS REGISTRADOS"
                                                                        <hr>
                                                                        @else
                                                                        <table class="table">
                                                                            <tbody>
                                                                                @foreach ($historial_prestamos as $prestamo)
                                                                                <tr>
                                                                                    <td class="text-start">
                                                                                        COD. PRESTAMO :{{$prestamo->cod_prestamo}} <br>
                                                                                        DATE_PRESTAMO: {{$prestamo -> fecha_prestamo}} <br>
                                                                                        DATE_DEVOLUCION: {{$prestamo ->fecha_devolucion}} <br>
                                                                                        ESTADO_PRESTAMO:
                                                                                        @if ($prestamo->estado == 0)
                                                                                        <span class="badge bg-success">PRESTADO</span>
                                                                                        @else
                                                                                        <span class="badge bg-warning">DEVUELTO</span>
                                                                                        @endif
                                                                                        <br>******************************************************
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
                        </div>
                    </div>
                    @endforeach
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
    var table = document.getElementById("tabla-equipos").tBodies[0];

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
<script src="{{asset ('assets/js/inputs-validations-componentes.js')}}"></script>

@endpush