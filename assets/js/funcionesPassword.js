"use strict";

/**
 * Función para mostrar u ocultar el texto de la contraseña
 * @param {*} inputId
 */
document.addEventListener("DOMContentLoaded", function() {
function togglePasswordVisibile(inputId) {
  var input = document.getElementById(inputId);
  if (input.type === "password") {
    input.type = "text";
  } else {
    input.type = "password";
  }
}

function keyPressPasswordValidacion(inputId) {
    var input = document.getElementById(inputId);
    var mayuscula = /[A-Z]/;
    var simbolo = /[!@#$%^&*()\-_=+[{\]}\\|;:'",<.>/?]/;

    if (!mayuscula.test(input.value) || !simbolo.test(input.value) || input.value.length < 8) {
        input.style.color = "red";
    } else {
        input.style.color = "green";
    }

}
})
