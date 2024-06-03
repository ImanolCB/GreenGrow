'use strict'

document.addEventListener("DOMContentLoaded", function() {
    const chUsuario = document.getElementById('chUsuario')
    const chTransaccion = document.getElementById('chTransaccion')
    const divUsuario = document.getElementById('tablaUsuario')
    const divTransaccion = document.getElementById('tablaTransaccion')
    const lbUsuario = document.getElementById('lbUsuario')
    const lbTransaccion = document.getElementById('lbTransaccion')

    chUsuario.addEventListener('change', (e) => {
        if (e.target.checked) {
            divUsuario.removeAttribute('hidden');
            lbUsuario.textContent = 'No ver usuarios';
        } else {
            divUsuario.setAttribute('hidden', 'true');
            lbUsuario.textContent = 'Ver usuarios';
        }
    });

    chTransaccion.addEventListener('change', (e) => {
        if (e.target.checked) {
            divTransaccion.removeAttribute('hidden');
            lbTransaccion.textContent = 'No ver transacciones';
        } else {
            divTransaccion.setAttribute('hidden', 'true');
            lbTransaccion.textContent = 'Ver transacciones';
        }
    });
})






