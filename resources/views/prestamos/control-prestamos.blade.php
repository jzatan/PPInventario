<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Préstamos')

@push('css')

@endpush

@section('header-nav', 'Control de prestamos')
@section('header', 'Control de prestamos')
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

                <div class="card-body pt-4 p-3">
                    @foreach ($prestamos as $prestamo)
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-3 text-sm">COD. PRESTAMO: {{$prestamo->cod_prestamo ?? 'ERROR'}}</h6>
                                <span class="mb-2 text-xs">ACTIVO INFORMATICO:
                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                        {{$prestamo -> equipos -> nombre_equipo ?? ''}} {{$prestamo -> equipos -> marca ?? ''}} {{$prestamo -> equipos -> modelo ?? ''}}
                                    </span>
                                </span>
                                <span class="mb-2 text-xs">PRESTARIO:
                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                        {{$prestamo -> usuario_prestario -> nombres ?? ''}} {{$prestamo -> usuario_prestario -> apellidos ?? ''}} - {{$prestamo -> usuario_prestario  -> areas -> nombre_area ?? ''}}
                                    </span>
                                </span>
                                <span class="mb-2 text-xs">PRESTADOR:
                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                        {{$prestamo -> usuario_prestador_area -> nombre_area ?? ''}}
                                    </span>
                                </span>
                                <span class="mb-2 text-xs">FECHA PRESTAMO:
                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                        {{$prestamo -> fecha_prestamo ?? ''}}
                                    </span>
                                </span>
                                <span class="mb-2 text-xs">FECHA DEVOLUCION:
                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                        {{$prestamo -> fecha_prestamo ?? ''}}
                                    </span>
                                </span>
                                <span class="mb-2 text-xs">ESTADO:
                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                        @if ($prestamo->estado == 0)
                                        <span class="badge  w-40 bg-success">PRESTADO</span>
                                        @else
                                        <span class="badge bg-light">DEVUELTO</span>
                                        @endif
                                    </span>
                                </span>
                                <span class="mb-2 text-xs">OBSERVACIONES:
                                    <span class="text-dark ms-sm-2 font-weight-bold text-uppercase">
                                        {{$prestamo -> observaciones ?? ''}}
                                    </span>
                                </span>
                            </div>
                            <div class="ms-auto text-end">
                                <a class="btn btn-link text-info text-gradient px-3 mb-0 btn-devolucion" data-id="{{$prestamo -> id}}" data-equipo-id="{{$prestamo -> equipos -> id}}" href="javascript:;"><i class="fas fa-sliders-h me-2"></i>Devolucion</a>
                                <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                            </div>
                        </li>
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-devolucion').click(function() {
            const prestamoId = $(this).data('id');
            const equipoId = $(this).data('equipo-id');

            if (confirm('¿Estás seguro de realizar la devolución?')) {
                $.ajax({
                    url: '/prestamos/devolucion',
                    method: 'POST',
                    data: {
                        prestamo_id: prestamoId,
                        equipo_id: equipoId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Devolución realizada exitosamente');
                            location.reload();
                        } else {
                            alert('Error al procesar la devolución');
                        }
                    },
                    error: function() {
                        alert('Error en la solicitud');
                    }
                });
            }
        });
    });
</script>

@endpush