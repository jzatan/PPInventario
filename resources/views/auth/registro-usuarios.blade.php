<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Empleados')

@push('css')
<!-- Script que nos permitira descargar en excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
@endpush

@section('header-nav', 'Empleados')
@section('header', 'Empleados')

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
                            <a class="btn btn-white" id="exportar-excel"><i class="fa fa-solid fa-file-excel text-success me-2" aria-hidden="true"></i>EXCEL</a>
                            <a class="btn btn-white" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fas fa-user-plus text-primary me-2" aria-hidden="true"></i>REGISTRAR EMPLEADO</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table table-responsive align-items-center mb-0" id="tabla-empleados">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">DATOS PERSONALES</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">AREA</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">DNI</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">TELEFONO</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">CORREO</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">ESTADO</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>
                                        <h6 class="ms-auto text-center text-sm mb-0">{{$usuario->nombres ?? ''}} <br> {{$usuario->apellidos ?? ''}}</h6>

                                    </td>
                                    <td>
                                        <h6 class="ms-auto text-center text-sm mb-0">{{$usuario->areas->nombre_area}} </h6>
                                    </td>
                                    <td>
                                        <h6 class="ms-auto text-center text-sm mb-0">{{$usuario->dni}} </h6>
                                    </td>
                                    <td>
                                        <h6 class="ms-auto text-center text-sm mb-0"> {{$usuario->telefono}}</h6>
                                    </td>
                                    <td>
                                        <h6 class="ms-auto text-center text-sm mb-0">{{$usuario->correo}} </h6>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if ($usuario->estado == 1)
                                        <span class="badge bg-success d-flex justify-content-center align-items-center">ACTIVO</span>
                                        @else
                                        <span class="badge bg-danger d-flex justify-content-center align-items-center">INACTIVO</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="ms-auto text-center">
                                            <a title="EDITAR" class="btn btn-link text-dark px-3 mb-0" href="{{route ('usuarios.edit', ['usuario' => $usuario])}}"><i class="fas fa-pencil-alt text-dark" aria-hidden="true"></i></a>
                                            <a title="ELIMINAR" class="btn btn-link text-danger text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#deleteeModal-{{$usuario -> id}}"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                    <!--- Warning delete -->
                                    <div class="modal fade" id="deleteeModal-{{$usuario -> id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Advertencia</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Seguro que deseas eliminar al empleado?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="text-white btn bg-secondary" data-bs-dismiss="modal">Close</button>
                                                    <form action="{{route('usuarios.destroy',['usuario'=>$usuario->id])}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="text-white btn bg-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--- fin Warning delete -->

                                    @endforeach
                                    <!--- Create user -->
                                    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body p-0">
                                                    <div class="card-header pb-0 text-left">
                                                        <h3 class="font-weight-bolder text-info text-gradient">Registrar empleado</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form id="" action="{{route('usuarios.store')}}" method="post">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="area_id">ÁREA DE TRABAJO</label>
                                                                <!-- Llamamos a las areas en estado 1 = activos-->
                                                                <select class="form-control" id="area_id" name="area_id">
                                                                    @foreach ($areas as $item)
                                                                    <option value="{{$item->id}}">{{$item->nombre_area}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nombres"> NOMBRES DEL EMPLEADO</label>
                                                                <input type="text" class="form-control" name="nombres" id="nombres" title="Solo alfanumericos" placeholder="Ingrese nombres" oninput="validateNombres(this)" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="apellidos"> APELLIDOS DEL EMPLEADO</label>
                                                                <input type="text" class="form-control" id="apellidos" name="apellidos" title="Formato Fecha" placeholder="Ingrese apellidos" oninput="validateApellidos()" required>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="form-group col-sm-12 mb-3 mb-sm-0">
                                                                    <label for="correo">CORREO ELECTRONICO</label>
                                                                    <input type="email" class="form-control" id="correo" name="correo" placeholder="example@gmail.com" required oninput="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="form-group col-sm-6 mb-3 mb-sm-0">
                                                                    <label for="dni">DOCUMENTO DE IDENTIDAD (DNI)</label>
                                                                    <input type="text" class="form-control" id="dni" name="dni" placeholder="#######" required maxlength="8" pattern="\d{8}" oninput="validateDNI()">
                                                                    <div id="dni-error" class="invalid-feedback">
                                                                        El DNI debe tener 8 dígitos numéricos.
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-6 mb-3 mb-sm-0">
                                                                    <label for="telefono">TELÉFONO</label>
                                                                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="999-999-999" required maxlength="9" pattern="\d{9}" oninput="validateTelefono()">
                                                                    <div id="telefono-error" class="invalid-feedback">
                                                                        El teléfono debe tener 8 dígitos numéricos.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="d-flex flex-column justify-content-end">
                                                                <button type="submit" class="btn btn-primary btn-eventos btn-block">Registrar</button><br>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--- fin Create user -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    var busqueda = document.getElementById('buscar');
    var table = document.getElementById("tabla-empleados").tBodies[0];

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
<script src="{{asset ('assets/js/imputs-validations.js')}}"></script>

@endpush