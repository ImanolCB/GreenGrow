"use strict";

/**
 * Función para mostrar u ocultar el texto de la contraseña
 * @param {*} inputId
 */
function togglePasswordVisibile(inputId) {
  var input = document.getElementById(inputId);
  if (input.type === "password") {
    input.type = "text";
  } else {
    input.type = "password";
  }
}

function keyPressPasswordValidacion() {
    var input = document.getElementById("passwordRegistro");
    var input2 = document.getElementById("passwordRegistroRep");
    var mayuscula = /[A-Z]/;
    var simbolo = /[!@#$%^&*()\-_=+[{\]}\\|;:'",<.>/?]/;

    if (!mayuscula.test(input.value) || !simbolo.test(input.value) || input.value.length < 8) {
        input.style.color = "red";
    } else {
        input.style.color = "green";
    }

    if (input.value !== input2.value || input.value === '') { // Corrección en esta línea
        document.getElementById("submit").disabled = true;
    } else {
        document.getElementById("submit").disabled = false;
    }
}

