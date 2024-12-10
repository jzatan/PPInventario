<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Areas de trabajo')

@push('css')

@endpush

@section('header-nav', 'Areas de trabajo')
@section('header', 'Areas de trabajo')
@section('content')
<!--Contenido-->

<div class="container-fluid py-4">

    <div class="row">
        <!-- Seccion registro areas -->
        <div class="col-4">
            <div class="card mb-4">
                <div class="card-body mb-4">
                    <h1 class="text-center text-uppercase text-primary text-lg font-weight-bolder mb-4">REGISTRAR AREA</h1>
                    <form id="form-areas" action="{{route('areas.store')}}" method="post">
                        @csrf
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                <label for="nombre_area">NOMBRE AREA</label>
                                <input type="text" class="form-control" name="nombre_area" id="nombre_area" title="Solo alfanumericos" placeholder="Ingrese el nombre del area" oninput="nombre_areas(this)" required>
                            </div>
                        </div>
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                <label for="ubicacion"> UBICACION</label>
                                <textarea class="form-control" rows="4" name="ubicacion" id="ubicacion" title="Solo alfanumericos" placeholder="Detallar ubicación del area" oninput="nombre_areas(this)"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                <hr>
                                <button type="submit" class="btn btn-primary w-100"><span class="btn-inner--icon"><i class="fa fa-save text-white me-2"></i></span>REGISTRAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Seccion tabla areas -->
        <div class="col-8">
            <div class="card mb-4">
                <div class="card-header pb-0">
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">AREA DE TRABAJO</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">Estado</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($areas as $area)
                                <tr>
                                    <td>
                                        <h6 class="text-center text-sm mb-0">{{$area -> nombre_area}}</h6>
                                        <p class="text-center text-xs text-secondary mb-0">{{$area->ubicacion}}</p>
                                    </td>
                                    <td>
                                        @if ($area->estado == 1)
                                        <span class="badge bg-success d-flex justify-content-center align-items-center">ACTIVO</span>
                                        @else
                                        <span class="badge bg-danger d-flex justify-content-center align-items-center">INACTIVO</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="ms-auto text-center">
                                            <a title="EDITAR" class="btn btn-link text-dark px-3 mb-0" data-bs-toggle="modal" data-bs-target="#updateArea-{{$area -> id}}"><i class="fas fa-pencil-alt text-dark" aria-hidden="true"></i></a>
                                            <!--<a title="ELIMINAR" class="btn btn-link text-danger text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#deleteArea-{{$area -> id}}"><i class="far fa-trash-alt"></i></a>-->
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @foreach ($areas as $area)
                    <!--- Warning delete modal -->
                    <!--<div class="modal fade" id="deleteArea-{{$area -> id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Advertencia</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ¿Seguro que deseas eliminar el area de trabajo?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="text-white btn bg-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{route('areas.destroy',['area'=>$area->id])}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="text-white btn bg-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>-->

                    <!--- updateAreas modal -->
                    <div class="modal fade" id="updateArea-{{$area -> id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar area</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-control" action="{{route('areas.update', $area -> id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row mb-sm-0">
                                            <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                                <label for="nombre_area">NOMBRE DEL AREA</label>
                                                <input type="text" class="form-control" name="nombre_area" id="nombre_area" title="Solo alfanumericos" placeholder="Ingrese el nombre del area"  value="{{$area -> nombre_area}}" oninput="nombre_areas(this)" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-sm-0">
                                            <label for="ubicacion">UBICACIÓN</label>
                                            <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                                <textarea class="form-control" rows="4" name="ubicacion" id="ubicacion" title="Solo alfanumericos" placeholder="Detallar ubicación del area" oninput="nombre_areas(this)">{{$area -> ubicacion}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 pl-1">
                                            <div class="form-group">
                                                <label for="estado">ESTADO</label>
                                                <select class="form-control" id="estado" name="estado" required>
                                                    @if ($area->estado == 1)
                                                    <option value="1" selected class="text-center">Activo</option>
                                                    <option value="0" class="text-center">Inactivo</option>
                                                    @else
                                                    <option value="0" selected class="text-center">Inactivo</option>
                                                    <option value="1" class="text-center">Activo</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-sm-0">
                                            <div class="form-group col-sm-2 mb-3 mb-sm-3">
                                                <hr>
                                                <button type="reset" class="btn btn-secondary w-100"><span class="btn-inner--icon"><i class="fas fa-undo me-2"></i></span></button>
                                            </div>
                                            <div class="form-group col-sm-10 mb-3 mb-sm-3">
                                                <hr>
                                                <button type="submit" class="btn btn-primary w-100"><span class="btn-inner--icon"><i class="fa fa-save text-white me-2"></i></span>CONFIRMAR</button>
                                            </div>
                                        </div>
                                    </form>
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
<script src="{{asset ('assets/js/validacion-campos-imputs.js')}}"></script>
@endpush