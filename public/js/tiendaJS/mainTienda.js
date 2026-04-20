import { initFiltros } from "./clasificarProductos.js";
import { initCantidad } from "./incrementoProductos.js";

document.addEventListener("DOMContentLoaded", ()=>{
    initFiltros();
    initCantidad();
    initCarrito();
})