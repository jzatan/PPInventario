<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Roles y permisos')

@push('css')

@endpush

@section('header-nav', 'Roles y permisos')
@section('header', 'Roles y permisos')
@section('content')
<!--Contenido-->
<div class="container-fluid py-4">

    <div class="row">
        <!-- Seccion tabla areas -->
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col justify-content-start">
                            <div class="input-group mb-4">
                            </div>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <a class="btn btn-white" href="{{route('roles.create')}}"><i class="fa-solid fa-user-gear text-primary me-2" aria-hidden="true"></i>REGISTRAR ROL</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">ROL</th>
                                    <th class="text-center text-uppercase text-primary text-xs font-weight-bolder opacity-7">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>
                                        <h6 class="text-center text-sm mb-0">{{$role -> name}}</h6>
                                    </td>
                                    <td>
                                        <div class="ms-auto text-center">
                                            <a title="EDITAR" class="btn btn-link text-dark px-3 mb-0" href="{{route('roles.edit', ['role'=>$role])}}"><i class="fas fa-pencil-alt text-dark" aria-hidden="true"></i></a>
                                            <a title="ELIMINAR" class="btn btn-link text-danger text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#deleteRole-{{$role -> id}}"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @foreach ($roles as $rol)
                    <!--- Warning delete modal -->
                    <div class="modal fade" id="deleteRole-{{$role -> id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Advertencia</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ¿Seguro que deseas eliminar el rol?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="text-white btn bg-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{route('roles.destroy',['role'=>$role->id])}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="text-white btn bg-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--- updateAreas modal -->
                    <div class="modal fade" id="updateRol-{{$role -> id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar rol</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
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
@endpush