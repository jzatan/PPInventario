/* 01. Script que me permite descargar los datos de una tabla en XLSX*/
document
    .getElementById("exportar-excel")
    .addEventListener("click", function () {
        // Obtener los datos de la tabla
        var tabla = document.getElementById("tabla-equipos-oculta");

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
        XLSX.utils.book_append_sheet(wb, ws, "Equipos");

        // Exportar a archivo Excel
        XLSX.writeFile(wb, "equipos_informaticos.xlsx");
    });

/* 02. Script que me permite descargar los datos de una tabla en PDF*/
document.getElementById("exportar-pdf").addEventListener("click", function () {
    // Obtener los datos de la tabla
    var tabla = document.getElementById("tabla-equipos-oculta");

    // Crear un array para almacenar las cabeceras
    var cabeceras = [];
    // Tomamos las cabeceras de la tabla, excepto la columna de "Acciones"
    var headers = tabla.rows[0].cells;
    for (var i = 0; i < headers.length - 1; i++) {
        // Nota el "-1" para omitir la última columna
        cabeceras.push(headers[i].innerText.trim());
    }

    // Crear un array para almacenar los datos de las filas
    var data = [];

    // Recorrer las filas de la tabla
    for (var i = 1, row; (row = tabla.rows[i]); i++) {
        var fila = [];
        // Recorrer las celdas de cada fila (omitimos la última columna "Acciones")
        for (var j = 0; j < row.cells.length - 1; j++) {
            fila.push(row.cells[j].innerText.trim());
        }
        data.push(fila); // Guardar la fila en los datos
    }

    // Crear un nuevo documento PDF en orientación horizontal
    var { jsPDF } = window.jspdf;
    var doc = new jsPDF({
        orientation: "landscape",
    });

    // Generar tabla con jsPDF-AutoTable
    doc.autoTable({
        head: [cabeceras], // Cabeceras de la tabla
        body: data, // Datos de la tabla
        theme: "grid", // Estilo de tabla
    });

    // Guardar el PDF
    doc.save("equipos_informaticos.pdf");
});

/* 03. Script que me permite calcular el tiempo en años, meses y dias con los valores de una tabla (td)*/
document.addEventListener("DOMContentLoaded", function () {
    // Obtiene todos los elementos con la clase 'fecha_adquision'
    const fechasAdquisicion = document.querySelectorAll(".fecha_adquision");

    fechasAdquisicion.forEach((elementoFecha) => {
        // Obtiene la fecha de adquisición de cada elemento
        const fechaAdquisicionTexto = elementoFecha.textContent;
        const fechaAdquisicion = new Date(fechaAdquisicionTexto);

        // Obtiene la fecha actual
        const fechaActual = new Date();

        // Verifica si la fecha de adquisición es futura
        if (fechaAdquisicion > fechaActual) {
            elementoFecha.parentElement.nextElementSibling.querySelector(
                ".resultado"
            ).textContent = "ERROR DE CÁLCULO";
            return;
        }

        // Calcula la diferencia en años, meses y días
        let años = fechaActual.getFullYear() - fechaAdquisicion.getFullYear();
        let meses = fechaActual.getMonth() - fechaAdquisicion.getMonth();
        let dias = fechaActual.getDate() - fechaAdquisicion.getDate();

        // Ajusta los valores si el día actual es menor que el día de adquisición
        if (dias < 0) {
            meses -= 1;
            const ultimoDiaMesAnterior = new Date(
                fechaActual.getFullYear(),
                fechaActual.getMonth(),
                0
            ).getDate();
            dias += ultimoDiaMesAnterior;
        }

        // Ajusta los valores si el mes actual es menor que el mes de adquisición
        if (meses < 0) {
            años -= 1;
            meses += 12;
        }

        // Formatea el resultado en años, meses y días
        let resultadoTexto = "";
        if (años > 0) resultadoTexto += `${años} año${años > 1 ? "s" : ""} `;
        if (meses > 0)
            resultadoTexto += `${meses} mes${meses > 1 ? "es" : ""} `;
        resultadoTexto += `${dias} día${dias > 1 ? "s" : ""}`;

        // Muestra el resultado en el td correspondiente
        elementoFecha.parentElement.nextElementSibling.querySelector(
            ".resultado"
        ).textContent = resultadoTexto;
    });
});

/* 04. Script que me permite buscar en la tabla equipos*/
var busqueda = document.getElementById("buscar");
var table = document.getElementById("tabla-equipos").tBodies[0];

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

/* 05. Script que me permite descargar pdf*/

document.addEventListener("DOMContentLoaded", function () {
    // Seleccionar todos los botones con la clase 'btn-pdf'
    const botonesPdf = document.querySelectorAll(".btn-pdf");

    // Agregar un listener a cada botón
    botonesPdf.forEach((boton) => {
        boton.addEventListener("click", function (event) {
            event.preventDefault(); // Evitar el comportamiento predeterminado del enlace

            // Obtener la fila asociada al botón
            const fila = boton.closest("tr");
            if (!fila) return;

            // Extraer los datos de la fila
            const datos = [
                `COD. PRESTAMO: ${fila.cells[1].innerText}`,
                `ACTIVO INFORMATICO: ${fila.cells[2].innerText}`,
                `PRESTAMISTA: ${fila.cells[3].innerText}`,
                `PRESTADOR: ${fila.cells[4].innerText}`,
                `FECHA DE PRESTAMO: ${fila.cells[5].innerText}`,
                `FECHA DE DEVOLUCION: ${fila.cells[6].innerText}`,
                `OBSERVACIONES: ${fila.cells[7].innerText}`,
                `ESTADO: ${fila.cells[8].innerText}`,
            ];

            // Crear el PDF
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Agregar título
            doc.setFontSize(16);
            doc.text("REPORTE DE PRESTAMO - ", 20, 20);

            // Configurar márgenes y ancho máximo
            const marginX = 20; // Margen izquierdo
            const maxWidth = 160; // Ancho máximo para el texto
            let y = 40; // Coordenada Y inicial (ajustada para dejar espacio suficiente debajo del título)

            // Agregar los datos al PDF con alineación y separación adecuada
            doc.setFontSize(12); // Tamaño de letra
            datos.forEach((linea) => {
                const partes = linea.split(":"); // Dividir el texto en "Etiqueta" y "Valor"
                const etiqueta = partes[0] + ":"; // Parte antes de ":"
                const valor = partes.slice(1).join(":").trim(); // Parte después de ":"

                // Escribir la etiqueta
                doc.text(etiqueta, marginX, y);

                // Escribir el valor con ajuste de líneas largas
                const lineasAjustadas = doc.splitTextToSize(
                    valor,
                    maxWidth - 50
                ); // Ajuste de líneas largas
                doc.text(lineasAjustadas, marginX + 60, y); // Sangría para el valor

                // Incrementar Y según el número de líneas ajustadas
                y += lineasAjustadas.length * 7; // Altura dinámica según las líneas usadas
                y += 2; // Espaciado adicional para separar cada campo
            });

            // Descargar el PDF
            doc.save(`reporte_prestamo_${fila.rowIndex}.pdf`);
        });
    });
});

