<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','prueba-plantilla')

@push('css')

@endpush

@section('content')
<!--Contenido-->


<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Agregar nuevo usuario</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Datos personales</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Area</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">credenciales</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class=" d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$usuario->nombres ?? ''}} {{$usuario->apellidos}}</h6>
                                                <p class="text-xs text-secondary mb-0">Documento de identidad: {{$usuario->dni}}</p>
                                                <p class="text-xs text-secondary mb-0">Celular: {{$usuario->telefono}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-center text-xs text-secondary mb-0">{{$usuario->areas->nombre_area}}</p>
                                    </td>
                                    <td>
                                        <p class="text-center text-xs font-weight-bold mb-0">User: {{$usuario->usuario}}</p>
                                        <p class="text-center text-xs text-secondary mb-0">Password: {{$usuario->contraseña}}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if ($usuario->estado==1)
                                        <span class="fw-bolder p-1 rounded bg-success text-white d-flex justify-content-center align-items-center" style="height: 35px; width: 70px;">Activo</span>
                                        @else
                                        <span class="fw-bolder p-1 rounded bg-danger text-black d-flex justify-content-center align-items-center" style="height: 35px; width: 70px;">Inactivo</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <form action="">
                                                <button type="button" class="d-flex btn btn-danger fw-bolder p-1 rounded bg-info text-black d-flex justify-content-center align-items-center" style="height: 35px; width: 45px; margin-bottom: 0px" title="Control de pagos"><i class="fas fa-pen"></i></button>
                                            </form>

                                            <form action="" method="post">
                                                <!--<button type="button" class="d-flex btn btn-danger " title="Control de pagos"><i class="fas fa-trash"></i></button>-->
                                                <button type="button" class="d-flex btn btn-danger fw-bolder p-1 rounded bg-danger text-black d-flex justify-content-center align-items-center" style="height: 35px; width: 45px; margin-bottom: 0px" title="Eliminar usuario" data-bs-toggle="modal" data-bs-target="#deleteeModal"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    <!--- Warning delete -->
                                    <div class="modal fade" id="deleteeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Advertencia</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Seguro que deseas eliminar al usuario?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                                    <form action="{{route('usuarios.destroy',['usuario'=>$usuario->id])}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn bg-gradient-danger">Delete</button>
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
                                                        <h3 class="font-weight-bolder text-info text-gradient">Registrar usuario</h3>
                                                        <p class="mb-0">Ingrese la información solicitada en cada campo</p>
                                                    </div>
                                                    <div class="card-body">
                                                        <form id="" action="{{route('usuarios.store')}}" method="post">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="area_id">Area:</label>
                                                                <!-- Llamamos a las areas en estado 1 = activos-->
                                                                <select class="form-control" id="area_id" name="area_id">
                                                                    @foreach ($areas as $item)
                                                                    <option value="{{$item->id}}">{{$item->nombre_area}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nombres"> Nombres:</label>
                                                                <input type="text" class="form-control" name="nombres" id="nombres" title="Solo alfanumericos" placeholder="nombres de usuario" oninput="soloLetrasNumeros(this)" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="apellidos"> Apellidos:</label>
                                                                <input type="text" class="form-control" id="apellidos" name="apellidos" title="Formato Fecha" placeholder="Ingresar la apellidos" required>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="form-group col-sm-6 mb-3 mb-sm-0">
                                                                    <label for="dni"> Documento de identidad:</label>
                                                                    <input type="text" class="form-control" id="dni" name="dni" title="Formato Fecha" placeholder="Ingresar dni" oninput="soloLetras(this)" required>
                                                                </div>
                                                                <div class="form-group col-sm-6 mb-3 mb-sm-0">
                                                                    <label for="telefono"> Telefono:</label>
                                                                    <input type="text" class="form-control" id="telefono" name="telefono" title="Ingrese telefono" placeholder="Ingrese telefono" required>
                                                                </div>

                                                            </div>

                                                            <div class="form-group row">


                                                            <div class="form-group row">
    <div class="col-sm-6">
        <label for="usuario">Usuario:</label>
        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Crear usuario" required>
    </div>
    <div class="col-sm-6">
        <label for="contraseña">Contraseña:</label>
        <input type="text" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" required>
        <div id="contraseña-error" class="alert alert-danger mt-2" style="display:none; color:white;">
            <strong>¡Atención!</strong> Solo se permiten 8 caracteres.
        </div>
    </div>
</div>

<script>
document.getElementById('contraseña').addEventListener('input', function() {
    document.getElementById('contraseña-error').style.display = this.value.length > 8 ? 'block' : 'none';
});
</script>


                                                            <div>
                                                                <button type="submit" class="btn btn-primary-personal btn-eventos btn-block">Guardar</button>
                                                            </div>

                                                            <!---<a href="index.html" class="btn btn-primary btn-ciclos btn-block">
                                            Login
                                        </a>-->
                                                            <hr>

                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>

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

@endpush