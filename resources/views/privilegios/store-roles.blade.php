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
        <!-- Seccion registro areas -->
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body mb-4">
                    <h1 class="text-center text-uppercase text-primary text-lg font-weight-bolder mb-4">REGISTRAR ROL</h1>
                    <form id="form-roles" action="{{route('roles.store')}}" method="post">
                        @csrf
                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                            <label for="name"> NOMBRE DEL ROL</label>
                            <input type="text" class="form-control" name="name" id="name" title="Solo alfanumericos" placeholder="NOMBRE ROL" oninput="" required>
                        </div>
                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                            <label for="permisos"> PERMISOS PARA EL ROL</label>
                            @foreach ($permisos as $item)
                            <div class="form-check">
                                <input id="{{$item->id}}" class="form-check-input" type="checkbox" name="permission[]" value="{{$item->id}}">
                                <label for="{{$item->id}}" class="form-check-label">{{$item -> name}}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-2 mb-3 mb-sm-3">
                                <hr>
                                <a class="btn btn-primary w-100" href="{{route ('roles.index')}}"><i class="fas fa-reply me-2" aria-hidden="true"></i></a>
                            </div>
                            <div class="form-group col-sm-10 mb-3 mb-sm-3">
                                <hr>

                                <button type="submit" class="btn btn-white w-100"><span class="btn-inner--icon"><i class="fa fa-save text-primary me-2"></i></span>REGISTRAR</button>
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
@endpush