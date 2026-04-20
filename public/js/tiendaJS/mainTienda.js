import { initFiltros } from "./clasificarProductos.js";
import { initCantidad } from "./incrementoProductos.js";
import { initCarrito } from "./carrito.js";

document.addEventListener("DOMContentLoaded", ()=>{
    initFiltros();
    initCantidad();
    initCarrito();
})