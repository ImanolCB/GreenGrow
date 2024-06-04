"use strict";

// document.addEventListener("DOMContentLoaded", function () {
  function mostrarOcultar() {
    const btnSideBar = document.getElementById('btnSideBar');
    const sidebar = document.querySelector(".sidebar");
    if (sidebar.style.display === "none") {
      sidebar.style.display = "flex";
      btnSideBar.textContent = "<";
    } else {
      sidebar.style.display = "none";
      btnSideBar.textContent = ">";
    }
  }

  function rangoFiltro() {
    const rango = document.getElementById('precio');
    const precioMostrado = document.getElementById('precioMostrado');

    rango.addEventListener("input", (e) => {
      precioMostrado.textContent = rango.value;
    });
  }
// })
