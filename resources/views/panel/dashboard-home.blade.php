<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','prueba-plantilla')

@push('css')

@endpush

@section('header-nav', 'DASHBOARD')
@section('header', 'DASHBOARD')
@section('content')
<!--Contenido-->
<div class="container-fluid py-4">
    <div class="container text-center">
        <div class="row">
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">DIS. DE ENTRADA</p>
                                    <h5 class="font-weight-bolder">
                                        {{$act_entrada}} REGISTRO(S)
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">+ {{$act_entrada_diario}}</span>
                                        registros hoy
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="fa-solid fa-keyboard text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">DIS. DE PROCESAMIENTO</p>
                                    <h5 class="font-weight-bolder">
                                        {{$act_procesamiento}} REGISTRO(S)
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">+ {{$act_procesamiento_diario}}</span>
                                        registros hoy
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="fa-solid fa-computer text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">DISPOSITIVOS DE SALIDA</p>
                                    <h5 class="font-weight-bolder">
                                        {{$act_salida}} REGISTRO(S)
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">+ {{$act_salida_diario}}</span>
                                        registros hoy
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-success text-center rounded-circle">
                                    <i class="fa-solid fa-print text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-7 mt-4">
                <div class="card h-100 mb-4">
                    <div class="card-header pb-0 px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-0 justify-content-start">MANT. CORRECTIVOS</h6>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end align-items-center">
                                <i class="far fa-calendar-alt me-2"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">ESTA SEMANA</h6>
                        <ul class="list-group">
                            @foreach ($ultimos_mant as $mantenimiento)
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    @if ($mantenimiento->estado == 1)
                                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-down"></i></button>
                                    @else
                                    <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                                    @endif
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">{{$mantenimiento->equipos->nombre_equipo ?? ''}} {{$mantenimiento->equipos->marca ?? ''}} {{$mantenimiento->equipos->modelo ?? ''}}</h6>
                                        <span class="text-xs">{{$mantenimiento->mantenimiento_detalle->fecha_envio ?? ''}}, at {{$mantenimiento->mantenimiento_detalle->fecha_retorno ?? ''}}</span>
                                        <span class="text-xs">{{$mantenimiento->mantenimiento_detalle->diagnostico ?? 'SIN DIAGNOSTICO'}}</span>
                                    </div>
                                </div>
                                @if ($mantenimiento->estado == 1)
                                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                    OPERATIVA
                                </div>
                                @else
                                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                    INOPERATIVA
                                </div> 
                                @endif

                            </li>
                            @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-5 mt-4">
                <div class="card h-100 mb-4">
                    <div class="card-header pb-0 px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-0 justify-content-start">PRESTAMOS</h6>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end align-items-center">
                                <i class="far fa-calendar-alt me-2"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Esta semana</h6>
                        <ul class="list-group">
                            @foreach ($ultimos_prestamos as $prestamos)
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                @if ($prestamos->estado == 1)
                                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-down"></i></button>
                                    @else
                                    <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                                    @endif
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">{{$prestamos->cod_prestamo}}</h6>
                                        <span class="text-xs">{{$prestamos->equipos->nombre_equipo ?? ''}} {{$prestamos->equipos->marca ?? ''}} {{$prestamos->equipos->modelo ?? ''}}</span>
                                        <span class="text-xs">{{$prestamos->fecha_prestamo}}, at {{$prestamos->fecha_devolucion}}</span>
                                    </div>
                                </div>
                                @if ($prestamos->estado == 0)
                                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                    PRESTADO
                                </div>
                                @else
                                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                    DEVUELTO
                                </div> 
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('js')

@endpush