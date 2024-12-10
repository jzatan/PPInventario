// 01. script para realizar una busqueda dentro de la tabla empleados (usuarios)
var busqueda = document.getElementById("buscar");
var table = document.getElementById("tabla-empleados").tBodies[0];

buscaTabla = function () {
    texto = busqueda.value.toLowerCase();
    var r = 0;
    while ((row = table.rows[r++])) {
        if (row.innerText.toLowerCase().indexOf(texto) !== -1)
            row.style.display = null;
        else row.style.display = "none";
    }
};
busqueda.addEventListener("keyup", buscaTabla);


/* 02. Script que me permite descargar los datos de una tabla en XLSX*/
document
    .getElementById("exportar-excel")
    .addEventListener("click", function () {
        // Obtener los datos de la tabla
        var tabla = document.getElementById("tabla-empleados");

        // Crear un array para almacenar las filas filtradas
        var data = [];

        // Recorrer las filas de la tabla
        for (var i = 0, row; (row = tabla.rows[i]); i++) {
            // Crear un array temporal para almacenar las celdas de cada fila
            var fila = [];

            // Recorrer las celdas de cada fila (omitimos la última columna de "Acciones")
            for (var j = 0; j < row.cells.length - 1; j++) {
                // Nota el "-1" para omitir la última columna
                fila.push(row.cells[j].innerText.trim()); // Agregar texto de las celdas
            }

            // Agregar la fila filtrada al array de datos
            data.push(fila);
        }

        // Crear una hoja de cálculo con los datos filtrados
        var ws = XLSX.utils.aoa_to_sheet(data);

        // Crear un libro de trabajo
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "EMPLEADOS");

        // Exportar a archivo Excel
        XLSX.writeFile(wb, "reporte-personal-registrado.xlsx");
    });
