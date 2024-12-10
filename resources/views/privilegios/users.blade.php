<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Usuarios')

@push('css')
<!-- Script que nos permitira descargar en excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
@endpush

@section('header-nav', 'Usuarios')
@section('header', 'Usuarios')
@section('content')
<!--Contenido-->
<div class="container-fluid py-4">

    <div class="row">
        <!-- Seccion registro areas -->
        <div class="col-4">
            <div class="card mb-4">

                <div class="card-body mb-4">
                    <h1 class="text-center text-uppercase text-primary text-lg font-weight-bolder mb-4">REGISTRAR USUARIO</h1>
                    <form id="form-users" action="{{route('users.store')}}" method="post">
                        @csrf
                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                            <input type="hidden" name="area_id" id="area_id_hidden">
                        </div>
                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                            <label for="usuario_id">EMPLEADO</label>
                            <!-- Llamamos a las áreas en estado 1 = activos-->
                            <select class="form-control" id="usuario_id" name="usuario_id" onchange="updateHiddenInput()">
                                @foreach ($usuarios as $item)
                                <option class="text-center" data-area-id="{{$item->area_id}}" value="{{$item->id}}">{{$item->nombres ?? ''}} {{$item->apellidos ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                            <label hidden for="name">NOMBRE DEL USUARIO</label>
                            <input hidden type="text" class="form-control" name="name" id="name" title="Solo alfanumericos" placeholder="Ingrese el nombre del area" value="" oninput="" required>
                        </div>
                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                            <label for="email"> CORREO</label>
                            <input type="email" class="form-control text-center" name="email" id="email" title="Solo alfanumericos" placeholder="example@.com" oninput="correo_electronico(this)" required>
                            <small id="emailFeedback" class="text-danger"></small>
                        </div>
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                <label for="password"> CONTRASEÑA</label>
                                <input type="text" class="form-control text-center" name="password" id="password" title="Solo alfanumericos" placeholder="********" oninput="contraseña_correos(this)" required>
                            </div>
                        </div>
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                <label for="role"> ASIGNAR ROL</label>
                                <select name="role" class="form-control" id="role">
                                    <option value="" class="text-center" disabled selected>- SELECCIONE ROL - </option>
                                    @foreach ($roles as $item)
                                    <option value="{{$item->name}}" class="text-center" @selected(old('role')==$item->name)>{{$item->name}}</option>
                                    @endforeach
                                </select>
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
                    <div class="row">
                        <div class="col justify-content-start">
                            <div class="input-group mb-4">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input id="buscar" type="text" class="form-control" placeholder="Search" data-search="true">
                            </div>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <a class="btn btn-white" id="exportar-excel"><i class="fa fa-solid fa-file-excel text-success me-2" aria-hidden="true"></i>EXCEL</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="tabla-usuarios">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">USUARIO</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">ROL</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">Estado</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <h6 class="text-center text-sm mb-0">{{$user -> name}}</h6>
                                        <p class="text-center text-xs text-secondary mb-0">{{$user -> areas -> nombre_area}}</p>
                                        <p class="text-center text-xs text-secondary mb-0">{{$user -> email}}</p>
                                    </td>
                                    <td>
                                        <!--<h6 class="text-center text-sm mb-0">{{$user -> email}}</h6>-->
                                        <h6 class="text-center text-sm mb-0">{{$user->getRoleNames()->first()}}</h6>
                                    </td>
                                    <td>
                                        @if ($user->estado == 1)
                                        <span class="badge bg-success d-flex justify-content-center align-items-center">ACTIVO</span>
                                        @else
                                        <span class="badge bg-danger d-flex justify-content-center align-items-center">INACTIVO</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="ms-auto text-center">
                                            <a title="EDITAR" class="btn btn-link text-dark px-3 mb-0" data-bs-toggle="modal" data-bs-target="#updateUser-{{$user-> id}}"><i class="fas fa-pencil-alt text-dark" aria-hidden="true"></i></a>
                                            <!--<a title="ELIMINAR" class="btn btn-link text-danger text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#deleteUser-{{$user -> id}}"><i class="far fa-trash-alt"></i></a>-->
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Tabla exportable de users -->
                    <table hidden id="tabla-usuarios-oculta">
                        <thead>
                            <th>NOMBRES</th>
                            <th>AREA</th>
                            <th>CORREO</th>
                            <th>ROL</th>
                            <th>ESTADO</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>
                                    {{$user -> name}}
                                </td>
                                <td>
                                    {{$user -> areas -> nombre_area}}
                                </td>
                                <td>
                                    {{$user -> email}}
                                </td>
                                <td>
                                    {{$user->getRoleNames()->first()}}
                                </td>
                                <td>
                                    @if ($user->estado == 1)
                                    <span class="badge bg-success d-flex justify-content-center align-items-center">ACTIVO</span>
                                    @else
                                    <span class="badge bg-danger d-flex justify-content-center align-items-center">INACTIVO</span>
                                    @endif
                                </td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                    @foreach ($users as $user)

                    <!--- update users modal -->
                    <div class="modal fade" id="updateUser-{{$user -> id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-control" action="{{ route('users.update', $user->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                            <!-- Campo oculto para el área -->
                                            <input type="hidden" name="area_id" id="area_id_hidden">
                                        </div>
                                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                            <label for="usuario_id">EMPLEADO</label>
                                            <select class="form-control" id="usuario_id" name="usuario_id" onchange="updateHiddenInputs()">
                                                @foreach ($usuarios as $item)
                                                <option class="text-center" value="{{ $item->id }}"
                                                    data-area-id="{{ $item->area_id ?? '' }}"
                                                    {{ $user->usuario_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nombres ?? '' }} {{ $item->apellidos ?? '' }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                            <label hidden for="name">NOMBRE DEL USUARIO</label>
                                            <input hidden type="text" class="form-control" name="name" id="name" title="Solo alfanumericos" placeholder="Ingrese el nombre del área" value="" required>
                                        </div>
                                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                            <label for="email">CORREO</label>
                                            <input type="email" class="form-control text-center" name="email" id="email" title="Solo alfanumericos" placeholder="example@.com" value="{{ $user->email ?? '' }}" oninput="correo_electronico(this)" required>
                                        </div>
                                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                            <label for="role">ASIGNACIÓN DE ROL</label>
                                            <select name="role" id="role" class="form-select">
                                                @foreach ($roles as $item)
                                                <option class="text-center" value="{{ $item->name }}" @selected(in_array($item->name, $user->roles->pluck('name')->toArray()))>
                                                    {{ $item->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 pl-1">
                                            <div class="form-group">
                                                <label for="estado">ESTADO</label>
                                                <select class="form-control text-center" id="estado" name="estado" required>
                                                    <option value="1" {{ $user->estado == 1 ? 'selected' : '' }}>Activo</option>
                                                    <option value="0" {{ $user->estado == 0 ? 'selected' : '' }}>Inactivo</option>
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
<script src="{{asset ('assets/js/usuarios-scripts.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    /* 04. Funcion que me permite validar en tiempo real, si existe el correo 
    en la base de datos*/
    $(document).ready(function() {
        // Detectar cambios en el campo de entrada
        $('#email').on('input', function() {
            let email = $(this).val(); // Obtener el valor del input
            let feedback = $('#emailFeedback'); // Mensaje de feedback

            if (email) { // Si el campo no está vacío
                $.ajax({
                    url: "{{ route('verificaremail') }}", // Ruta para la verificación
                    method: "POST", // Método HTTP
                    data: {
                        email: email,
                        _token: "{{ csrf_token() }}" // Token CSRF
                    },
                    success: function(response) {
                        if (response.exists) {
                            feedback.text('El correo electrónico ya está registrado.');
                        } else {
                            feedback.text('');
                        }
                    },
                    error: function() {
                        feedback.text('Error al verificar el correo electrónico.');
                    }
                });
            } else {
                feedback.text(''); // Si está vacío, limpia el mensaje
            }
        });
    });
</script>

@endpush