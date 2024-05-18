'use strict';

function ver(descripcion) {
    Swal.fire({
        html: `<p>${descripcion}</p>`,
        cancelButtonText: "Cerrar",
        showCancelButton: true,
        showConfirmButton: false,
        
      });
}