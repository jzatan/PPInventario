<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Registrar componentes')

@push('css')

@endpush

@section('header-nav', 'Registrar componentes')
@section('header', 'Registrar componentes')
@section('content')
<!--Contenido-->

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form id="" action="{{route('componentes.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="equipo_id" value="{{ session('equipo') ? session('equipo')->id : '' }}">

                        <div class="form-group row mb-sm-0">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <div class="row">
                                    <div class="col">
                                        <label for="componentes">{{ session('equipo') ? session('equipo')->nombre_equipo : '' }}
                                            {{ session('equipo') ? session('equipo')->marca : '' }} {{ session('equipo') ? session('equipo')->modelo : '' }}</label>
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

@endsection

@push('js')
<script src="{{asset ('assets/js/inputs-validations-componentes.js')}}"></script>

@endpush