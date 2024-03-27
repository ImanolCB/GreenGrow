"use strict";

function mostrarOcultar() {
  const btnSideBar = document.querySelector("#btnSideBar");
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
  const rango = document.querySelector("#precio");
  const precioMostrado = document.querySelector("#precioMostrado");

  rango.addEventListener("input", (e) => {
    precioMostrado.textContent = rango.value;
  });
}
