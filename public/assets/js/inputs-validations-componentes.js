document.getElementById('agregarComponente').addEventListener('click', function() {
    const tbody = document.getElementById('cuerpo-componentes');
    const fila = document.createElement('tr');

    fila.innerHTML = `
    <td class="align-middle text-center"><input type="text" name="componentes[nombre_componente][]" class="form-control" required></td>
    <td class="align-middle text-center"><input type="text" name="componentes[descripcion][]" class="form-control" ></td>
    <td class="align-middle text-center text-sm"><button type="button" class="btn btn-danger" onclick="eliminarFila(this)"><i class="far fa-trash-alt me-2" aria-hidden="true"></i>ELIMINAR</button></td>
    
`;

    tbody.appendChild(fila);
});

function eliminarFila(boton) {
    const fila = boton.parentNode.parentNode;
    fila.parentNode.removeChild(fila);
}




