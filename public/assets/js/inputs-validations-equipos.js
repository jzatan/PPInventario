function addValidationClasses(input, isValid) {
    if (isValid) {
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");
    } else {
        input.classList.remove("is-valid");
        input.classList.add("is-invalid");
    }
}

async function validateCODREGISTRO() {
    const cod_registroInput = document.getElementById("cod_registro");
    const isValid = /^[0-9\s-]+$/.test(cod_registroInput.value);
    if (isValid){
        try{
            const response = await fetch(`/verificar-codregistro?cod_registro=${cod_registroInput.value}`);
            const data = await response.json();

            if (data.exists) {
                addValidationClasses(cod_registroInput,false);
                displayMessage("COD REGISTRO ya registrado",false);
                return false;
            } else {
                addValidationClasses(cod_registroInput, true);
                displayMessage("COD REGISTRO disponible",true);
                return true;
            }
        } catch (error){
            console.error("Error al verificar el COD REGISTRO:", error);
            return false;
        }
    } else {
        addValidationClasses(cod_registroInput, false);
        displayMessage("Formato COD REGISTRO de equipo invalido",false);
        return false;
    }
}

function displayMessage(message, isValid) {
    const messageElement = document.getElementById("codregistroMessage");
    messageElement.textContent = message;
    messageElement.style.color = isValid ? "green" : "red";
}

function validateNOMEQUIPOS() {
    const nomequiposInput = document.getElementById("nombre_equipo");
     // Verifica si el valor contiene solo letras, espacios y Ñ/ñ
    const isValid = /^[a-zA-Z-0-9\sÑñ]+$/.test(nomequiposInput.value);
     // Aplica las clases de validación (visual)
    addValidationClasses(nomequiposInput, isValid);
    return isValid; // Devuelve el estado de validación
}

function validateMarca() {
    const marcaInput = document.getElementById("marca");
     // Verifica si el valor contiene solo letras, espacios y Ñ/ñ
    const isValid = /^[a-zA-Z-0-9\sÑñ]+$/.test(marcaInput.value);
     // Aplica las clases de validación (visual)
    addValidationClasses(marcaInput, isValid);
    return isValid; // Devuelve el estado de validación
}

function validateModelo() {
    const modeloInput = document.getElementById("modelo");
     // Verifica si el valor contiene solo letras, espacios y Ñ/ñ
    const isValid = /^[a-zA-Z-0-9\sÑñ]+$/.test(modeloInput.value);
     // Aplica las clases de validación (visual)
    addValidationClasses(modeloInput, isValid);
    return isValid; // Devuelve el estado de validación
}

function validateNROSERIE() {
    const nroserieInput = document.getElementById("nro_serie");
     // Verifica si el valor contiene solo letras, espacios y Ñ/ñ
    const isValid = /^[a-zA-Z-0-9\sÑñ]+$/.test(nroserieInput.value);
     // Aplica las clases de validación (visual)
    addValidationClasses(nroserieInput, isValid);
    return isValid; // Devuelve el estado de validación
}

document.getElementById("formEquipos").addEventListener("submit", async function (event) {
    event.preventDefault(); // Prevenir el envío inmediato

    // Llamadas a las funciones de validación
    const validEquipos = validateNOMEQUIPOS();
    const validMarca = validateMarca();
    const validModelo = validateModelo();
    const validNSerie = validateNROSERIE();
    const validCRegistro = await validateCODREGISTRO(); // Validación asíncrona corregida

    // Enviar el formulario solo si todas las validaciones son verdaderas
    if (validEquipos && validMarca && validModelo && validNSerie && validCRegistro) {
        // Marcar cuál botón fue presionado
        const clickedButton = document.querySelector("button[type=submit][clicked=true]");

        // Si hay un botón presionado, establecer su valor en un campo oculto
        if (clickedButton) {
            const actionInput = document.createElement("input");
            actionInput.type = "hidden";
            actionInput.name = "action";
            actionInput.value = clickedButton.value; // El valor del botón
            this.appendChild(actionInput); // Agregar el input oculto al formulario
        }

        this.submit(); // Enviar el formulario al backend
    }
});

// Agregar un evento para marcar qué botón fue presionado
document.querySelectorAll("button[type=submit]").forEach(button => {
    button.addEventListener("click", function() {
        // Remover el atributo 'clicked' de todos los botones antes de agregarlo al actual
        document.querySelectorAll("button[type=submit]").forEach(b => b.removeAttribute("clicked"));
        this.setAttribute("clicked", "true"); // Marcar este botón como el que fue presionado
    });
});
