<!--LLamas a las normativas de la plantilla template-->
@extends('template')

@section('title','Registrar equipos')

@push('css')

@endpush

@section('header-nav', 'Registrar equipos')
@section('header', 'Registrar equipos')
@section('content')
<!--Contenido-->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form id="formEquipos" action="{{route('equipos.store')}}" method="post">
                        @csrf
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-6 mb-3 mb-sm-3">
                                <label for="categoria_id">CATEGORIA</label>
                                <!-- Llamamos a las areas en estado 1 = activos-->
                                <select class="form-control text-center" id="categoria_id" name="categoria_id">
                                    @foreach ($categorias as $item)
                                    <option value="{{$item->id}}">{{$item->nombre_categoria}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6 mb-3 mb-sm-3">
                                <label for="usuario_id">REGISTRADO POR </label>
                                <input type="text" class="form-control text-center" title="solo números" value="{{auth()->user()->usuarios->nombres ?? ''}} {{auth()->user()->usuarios->apellidos ?? ''}}" disabled>
                                <input hidden type="text" id="usuario_id" name="usuario_id" value="{{auth()->user()->usuario_id ?? ''}}">
                            </div>
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <label for="area_id">DESTINO</label>
                                <!-- Llamamos a las areas en estado 1 = activos-->
                                <select class="form-control" id="area_id" name="area_id">
                                    @foreach ($areas as $item)
                                    <option class="text-center" value="{{$item->id}}">{{$item->nombre_area ?? ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="cod_registro"> CODIGO DE REGISTRO</label>
                                <input type="text" class="form-control text-center" id="cod_registro" name="cod_registro" title="solo números" placeholder="INGRESE COD. REGISTRO" required oninput="solo_numeros(this)">
                                <small id="codregistroFeedback" class="text-danger"></small>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="ord_compra"> ORDEN DE COMPRA</label>
                                <input type="text" class="form-control text-center" id="ord_compra" name="ord_compra" title="solo letras" placeholder="ORDEN DE COMPRA" oninput="orden_compra(this)">
                            </div>
                        </div>

                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-3 mb-3 mb-sm-3">
                                <label for="nombre_equipo"> NOMBRE DE EQUIPO</label>
                                <input type="text" class="form-control text-center" name="nombre_equipo" id="nombre_equipo" title="Solo alfanumericos" placeholder="NOMBRE EQUIPO" oninput="nombres_equipo(this)" required>
                            </div>
                            <div class="form-group col-sm-3 mb-3 mb-sm-3">
                                <label for="marca"> MARCA</label>
                                <input type="text" class="form-control text-center" id="marca" name="marca" title="Solo alfanumericos" placeholder="MARCA" required oninput="marca_equipo(this)">
                            </div>
                            <div class="form-group col-sm-3 mb-3 mb-sm-3">
                                <label for="modelo"> MODELO</label>
                                <input type="text" class="form-control text-center" id="modelo" name="modelo" title="Solo alfanumericos" placeholder="MODELO" oninput="modelo_equipo(this)" required>
                            </div>
                            <div class="form-group col-sm-3 mb-3 mb-sm-0">
                                <label for="color">COLOR DEL EQUIPO</label>
                                <input type="text" class="form-control text-center" name="color" id="color" title="Solo letras" placeholder="COLOR" oninput="color_equipo(this)" required>
                            </div>
                            <!--<div class="form-group col-sm-3 mb-3 mb-sm-0">
                                <label for="nro_serie">NÚMERO DE SERIE</label>
                                <input type="text" class="form-control" name="nro_serie" id="nro_serie" title="Solo alfanumericos" placeholder="INGRESE NRO. SERIE" oninput="validateNROSERIE()" required>
                            </div>-->
                        </div>
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <label for="nro_serie">NÚMERO DE SERIE</label>
                                <input type="text" class="form-control text-center" name="nro_serie" id="nro_serie" title="Solo alfanumericos" placeholder="NRO. SERIE" oninput="numero_serie(this)" required>
                            </div>
                            <div class="form-group col-sm-4 mb-3 mb-sm-3">
                                <label for="fecha_adquision">FECHA DE ADQUISION</label>
                                <input type="date" class="form-control text-center" name="fecha_adquision" id="fecha_adquision" title="formato dd/mm/yy" required>
                            </div>
                            <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                <label for="estado">ESTADO</label>
                                <select name="estado" id="estado" class="form-control text-center text-bold">
                                    <option disabled value="" class="ms-auto text-center text-xs text-secondary mb-0">― SELECCIONAR ―</option>
                                    <option value="1" class="text-center">OPERATIVA</option>
                                    <option value="2" class="text-center">REGULAR</option>
                                    <option value="3" class="text-center">INOPERATIVA</option>
                                    <option hidden value="4" class="text-center">EN MANTENIMIENTO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 mb-3 mb-sm-3">
                            <label for="observacion">OBSERVACIONES</label>
                            <textarea class="form-control" name="observacion" id="observacion" title="Solo alfanumericos" placeholder="DETALLAR OBSERVACIONES" oninput="observaciones(this)"></textarea>
                        </div>
                        <div class="form-group row mb-sm-0">
                            <div class="form-group col-sm-2 mb-3 mb-sm-3">
                                <hr>
                                <a class="btn btn-primary w-100" href="{{route ('activosregistrados')}}"><i class="fas fa-reply me-2" aria-hidden="true"></i>REGRESAR</a>
                            </div>
                            <div class="form-group col-sm-5 mb-3 mb-sm-3">
                                <hr>
                                <button type="submit" class="btn w-100" name="action" value="register_and_redirect" id="btnAgregarComponentes"><span class="btn-inner--icon"><i class="fas fa-laptop-code text-primary me-2"></i></span> AGREGAR COMPONENTES</button>
                            </div>
                            <div class="form-group col-sm-5 mb-3 mb-sm-3">
                                <hr>
                                <button type="submit" class="btn w-100" name="action" value="register"><span class="btn-inner--icon"><i class="fa fa-save text-primary me-2"></i></span>GUARDAR ACTIVO INFORMATICO</button>
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
<script src="{{asset ('assets/js/validacion-campos-imputs.js')}}"></script>

<script>
    /* 06. Script que me permite validar fechas*/

    // Obtener la fecha actual en formato YYYY-MM-DD
    const today = new Date().toISOString().split("T")[0];
    // Establecer el atributo max al input de fecha
    document.getElementById("fecha_adquision").setAttribute("max", today);
</script>
<script>
    /* 07. Script que me permite validar el boton de agregar componentes, depediendo de la categoria*/

    document.addEventListener('DOMContentLoaded', function() {
        const categoriaSelect = document.getElementById('categoria_id');
        const btnAgregarComponentes = document.getElementById('btnAgregarComponentes');

        // Función que habilita o deshabilita el botón según la categoría seleccionada
        function toggleButton() {
            const selectedValue = parseInt(categoriaSelect.value);
            if (selectedValue === 1 || selectedValue === 3) {
                btnAgregarComponentes.disabled = true;
            } else {
                btnAgregarComponentes.disabled = false;
            }
        }

        // Llamada inicial para asegurar el estado correcto al cargar la página
        toggleButton();

        // Evento de cambio en el select
        categoriaSelect.addEventListener('change', toggleButton);
    });
</script>
<script>
    $(document).ready(function() {
        // Detectar cambios en el campo de entrada
        $('#cod_registro').on('input', function() {
            let cod_registro = $(this).val(); // Obtener el valor del input
            let feedback = $('#codregistroFeedback'); // Mensaje de feedback

            if (cod_registro) { // Si el campo no está vacío
                $.ajax({
                    url: "{{ route('verificarcodigoregistro') }}", // Ruta para la verificación
                    method: "POST", // Método HTTP
                    data: {
                        cod_registro: cod_registro, // Enviar cod_registro
                        _token: "{{ csrf_token() }}" // Token CSRF
                    },
                    success: function(response) {
                        if (response.exists) {
                            feedback.text('El cod. registro ya está registrado.').addClass('text-danger');
                        } else {
                            feedback.text('').removeClass('text-danger');
                        }
                    },
                    error: function() {
                        feedback.text('Error al verificar el cod. registro.').addClass('text-danger');
                    }
                });
            } else {
                feedback.text(''); // Si está vacío, limpia el mensaje
            }
        });
    });
</script>




@endpush