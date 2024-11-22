function addValidationClasses(input, isValid) {
    if (isValid) {
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");
    } else {
        input.classList.remove("is-valid");
        input.classList.add("is-invalid");
    }
}

/*Funcion que  nos permite colocar solo letras y espacios, hacemos el llamado de esta funcion con
    oninput="soloLetrasNumeros(this)" */

function validateNombres() {
    const nombresInput = document.getElementById("nombres");
    const isValid = /^[a-zA-Z\sÑñ]+$/.test(nombresInput.value);
    addValidationClasses(nombresInput, isValid);
    return isValid; // Devuelve el estado de validación
}

function validateApellidos() {
    const apellidosInput = document.getElementById("apellidos");
     // Verifica si el valor contiene solo letras, espacios y Ñ/ñ
    const isValid = /^[a-zA-Z\sÑñ]+$/.test(apellidosInput.value);
     // Aplica las clases de validación (visual)
    addValidationClasses(apellidosInput, isValid);
    return isValid; // Devuelve el estado de validación
}

function validateDNI() {
    const dniInput = document.getElementById("dni");
    const isValid = dniInput.value.length === 8 && /^\d{8}$/.test(dniInput.value);
    addValidationClasses(dniInput, isValid);
    return isValid; // Devuelve el estado de validación
}


function validateTelefono() {
    const telefonoInput = document.getElementById("telefono");
    const isValid = telefonoInput.value.length === 9 && /^\d{9}$/.test(telefonoInput.value);
    addValidationClasses(telefonoInput, isValid);
    return isValid; // Devuelve el estado de validación
}

function validatePassword() {
    const passwordInput = document.getElementById("contraseña");
    const isValid = passwordInput.value.length === 8;
    addValidationClasses(passwordInput, isValid);
    return isValid; // Devuelve el estado de validación
}

async function validateUsuario() {
    const usuarioInput = document.getElementById("usuario");
    const isValid = /^[a-zA-Z0-9\s.-@]+$/.test(usuarioInput.value);

    if (isValid) {
        // Llamada al servidor para verificar si el usuario ya existe
        try {
            const response = await fetch(`/verificar-usuario?usuario=${usuarioInput.value}`);
            const data = await response.json();

            if (data.exists) {
                // Si el usuario ya está registrado, marca como inválido
                addValidationClasses(usuarioInput, false);
                displayMessage("Nombre de usuario ya registrado", false);
                return false; // Usuario inválido
            } else {
                // Si no está registrado, marca como válido
                addValidationClasses(usuarioInput, true);
                displayMessage("Nombre de usuario disponible", true);
                return true; // Usuario válido
            }
        } catch (error) {
            console.error("Error al verificar el nombre de usuario:", error);
            return false; // Considerar inválido en caso de error
        }
    } else {
        // Si el formato es inválido, marca como inválido directamente
        addValidationClasses(usuarioInput, false);
        displayMessage("Formato de nombre de usuario inválido", false);
        return false; // Usuario inválido
    }
}

function displayMessage(message, isValid) {
    const messageElement = document.getElementById("usuarioMessage");
    messageElement.textContent = message;
    messageElement.style.color = isValid ? "green" : "red";
}



/* Script que me permite descargar los datos de una tabla en XLSX*/
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


