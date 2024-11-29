<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Usuarios')

@push('css')

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
                    
                            <!-- Llamamos a las areas en estado 1 = activos
                            <select class="form-control" id="area_id" name="area_id">
                                @foreach ($areas as $item)
                                <option class="text-center" value="{{$item->id}}">{{$item->nombre_area ?? ''}}</option>
                                @endforeach
                            </select>-->
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
                            <input type="email" class="form-control" name="email" id="email" title="Solo alfanumericos" placeholder="example@.com" oninput="" required>
                        </div>
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                <label for="password"> CONTRASEÑA</label>
                                <input type="text" class="form-control" name="password" id="password" title="Solo alfanumericos" placeholder="example@.com" oninput="" required>
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
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
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
                                            <a title="ELIMINAR" class="btn btn-link text-danger text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#deleteUser-{{$user -> id}}"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @foreach ($users as $user)
                    <!--- Warning delete modal -->
                    <div class="modal fade" id="deleteUser-{{$user -> id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Advertencia</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ¿Seguro que deseas eliminar el usuario?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="text-white btn bg-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{route('users.destroy',['user'=>$user->id])}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="text-white btn bg-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--- update usuarios modal -->
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
                                    <form class="form-control" action="{{route('users.update', $user -> id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                            <label for="area_id">AREA</label>
                                            <!-- Llamamos a las areas en estado 1 = activos-->
                                            <select class="form-control" id="area_id" name="area_id">
                                                @foreach ($areas as $item)
                                                <option class="text-center" value="{{$item->id}}" {{ $user->area_id == $item->id ? 'selected' : '' }}>{{$item->nombre_area}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                            <label for="usuario_id">EMPLEADO</label>
                                            <!-- Llamamos a las áreas en estado 1 = activos-->
                                            <select class="form-control" id="usuario_id" name="usuario_id" onchange="updateHiddenInputs()">
                                                @foreach ($usuarios as $item)
                                                <option class="text-center" value="{{$item->id}}" {{ $user->usuario_id == $item->id ? 'selected' : '' }}>{{$item->nombres ?? ''}} {{$item->apellidos ?? ''}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                            <label hidden for="name">NOMBRE DEL USUARIO</label>
                                            <input hidden type="text" class="form-control" name="name" id="name" title="Solo alfanumericos" placeholder="Ingrese el nombre del area" value="" oninput="" required>
                                        </div>
                                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                            <label for="email"> CORREO</label>
                                            <input type="email" class="form-control text-center" name="email" id="email" title="Solo alfanumericos" placeholder="example@.com" oninput="" value="{{$user -> email ?? ''}}" required>
                                        </div>




                                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                        <label for="role"> ASIGNACIÓN DE ROL</label>
                                            <select name="role" id="role" class="form-select">
                                                @foreach ($roles as $item)
                                                @if (in_array($item->name, $user->roles->pluck('name')->toArray()))
                                                <option selected class="text-center" value="{{$item->name}}" @selected(old('role')==$item->name)>{{$item->name}}</option>
                                                @else
                                                <option class="text-center" value="{{$item->name}}" @selected(old('role')==$item->name)>{{$item->name}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <!---<div class="form-group row mb-sm-0">
                                            <div class="form-group col-sm-12 mb-3 mb-sm-3">
                                                <label for="password"> CONTRASEÑA</label>
                                                <input type="text" class="form-control text-center" name="password" id="password" title="Solo alfanumericos" placeholder="example@.com" oninput="" value="{{$user->password ?? ''}}" required>
                                            </div>
                                        </div>-->
                                        <div class="col-md-12 pl-1">
                                            <div class="form-group">
                                                <label for="estado">ESTADO</label>
                                                <select class="form-control" id="estado" name="estado" required>
                                                    @if ($user->estado == 1)
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
<script>
   function updateHiddenInput() {
    // Obtén el select y los inputs ocultos
    const selectElement = document.getElementById('usuario_id');
    const hiddenInputName = document.getElementById('name');
    const hiddenInputArea = document.getElementById('area_id_hidden');

    // Obtén el texto seleccionado del select
    const selectedText = selectElement.options[selectElement.selectedIndex].text;

    // Obtén el área (data-area-id)
    const areaId = selectElement.options[selectElement.selectedIndex].getAttribute('data-area-id');

    // Asigna los valores al input oculto
    hiddenInputName.value = selectedText;
    hiddenInputArea.value = areaId;
}

// Ejecuta la función al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    updateHiddenInput();
});

</script>
<script>
    // Función para actualizar el input oculto dentro del modal
    function updateHiddenInputs(modalId) {
        const modal = document.getElementById(modalId);
        const selectElement = modal.querySelector('#usuario_id');
        const hiddenInput = modal.querySelector('#name');

        // Obtén el texto seleccionado del select
        const selectedText = selectElement.options[selectElement.selectedIndex].text;

        // Asigna el texto seleccionado al input oculto
        hiddenInput.value = selectedText;
    }

    // Configuración al cargar el modal
    document.addEventListener('DOMContentLoaded', () => {
        // Escucha el evento cuando se abre cualquier modal
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('show.bs.modal', () => {
                // Obtén el ID del modal actual
                const modalId = modal.getAttribute('id');

                // Inicializa los valores
                updateHiddenInputs(modalId);
            });

            // Configura el cambio del select para reflejar en el input oculto
            const selectElement = modal.querySelector('#usuario_id');
            if (selectElement) {
                selectElement.addEventListener('change', () => {
                    updateHiddenInputs(modal.getAttribute('id'));
                });
            }
        });
    });
</script>
@endpush