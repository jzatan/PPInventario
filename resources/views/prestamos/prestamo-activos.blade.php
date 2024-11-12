<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Préstamos')

@push('css')

@endpush

@section('header-nav', 'Prestación de activos informaticos')
@section('header', 'Prestación de activos informaticos')
@section('content')
<!--Contenido-->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <!--<div class="row">
                        <div class="col d-flex justify-content-end">
                            <a href=""><button class="form-control">CONTROL DE PRESTAMOS</button></a>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <a class="btn btn-white" id="exportar-pdf"><i class="fas fa-toggle-on  text-danger me-2" aria-hidden="true"></i>PDF</a>
                        </div>
                    </div>-->
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-2">
                        <table id="tabla-equipos" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">COD. REGISTRO</th>
                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">ACTIVO INFORMATICO</th>
                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">MARCA</th>
                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">MODELO</th>
                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">COLOR</th>
                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">estado</th>
                                    <th class="text-center text-uppercase text-dark text-xs font-weight-bolder opacity-7">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipos as $equipo)
                                <tr>
                                    <td>
                                        <div class="ms-auto text-center">
                                            <a class="btn btn-link text-dark px-3 mb-0" href="" title="Detalles del activo informatico" data-bs-toggle="modal" data-bs-target="#componentesModal-{{$equipo->id}}">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="text-center text-sm mb-0">{{$equipo -> cod_registro}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center text-sm mb-0">{{$equipo -> nombre_equipo ?? ''}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="ms-auto text-center text-sm mb-0"> {{$equipo -> marca ?? ''}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="ms-auto text-center text-sm mb-0"> {{$equipo -> modelo ?? ''}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="ms-auto text-center text-sm mb-0">{{$equipo -> color ?? ''}}</h6>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if ($equipo->estado_prestamo == 1)
                                        <span class="badge bg-success d-flex justify-content-center align-items-center">DISPONIBLE</span>
                                        @else
                                        <span class="badge bg-danger d-flex justify-content-center align-items-center">NO DISPONIBLE</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="ms-auto text-center">
                                            <a
                                                title="Registrar prestamo"
                                                class="btn btn-link text-dark px-3 mb-0 {{ $equipo->estado_prestamo != 1 ? 'disabled' : '' }}"
                                                href="{{ $equipo->estado_prestamo == 1 ? route('prestamos.create', ['equipo' => $equipo->id]) : '#' }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @foreach ($equipos as $equipo)
                    <!--- modal-componentes -->
                    <div class="modal fade" id="componentesModal-{{$equipo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
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
                                                        <span class="mb-2 text-xs">CATEGORIA:
                                                            <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                                                {{$equipo->categorias->nombre_categoria}}
                                                            </span>
                                                        </span>
                                                        <span class="mb-2 text-xs">REGISTRO:
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
                                                        <span class="mb-2 text-xs">COMPONENTES:
                                                            <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                                                @php
                                                                $componentesDelEquipo = $componentes->where('equipo_id', $equipo->id);
                                                                @endphp

                                                                @if ($componentesDelEquipo->isEmpty())
                                                                "SIN COMPONENTES REGISTRADOS"
                                                                <hr>
                                                                @else
                                                                @foreach ($componentesDelEquipo as $componente)
                                                                <br>
                                                                <span class="mb-2 text-xs">{{$componente->nombre_componente}}:
                                                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                                                        {{$componente->descripcion}}
                                                                    </span>
                                                                </span>

                                                                @endforeach
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
                    <!--- Fin-modal-componentes-->
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush