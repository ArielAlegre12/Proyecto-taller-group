import { initCarrito } from "./carrito.js";
import { limpiarCarrito } from "./carrito.js";

document.addEventListener("DOMContentLoaded", () => {
    initCarrito();

    document.querySelectorAll('.form-logout').forEach(form => {
        form.addEventListener('submit', () => {
            limpiarCarrito();
        });
    });
});

