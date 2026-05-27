import { mostrarToast } from "../global/toast.js";
export function initCarrito() {

    function obtenerCarrito() {
        return JSON.parse(localStorage.getItem("carrito")) || [];
    }

    function guardarCarrito(carrito) {
        localStorage.setItem("carrito", JSON.stringify(carrito));
        actualizarContador();
        sincronizarCarrito(carrito);
    }

    async function sincronizarCarrito(carrito){
        try{
            await fetch('/guardar-carrito-usuario', {
                method: 'POST',
                headers: {
                    'Content-Type': 'apliacition/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .content
                },
                body: JSON.stringify({carrito})
            });
        }catch(error){
            console.error(error);
        }
    }

    function actualizarContador() {
        const carrito = obtenerCarrito();
        const total = carrito.reduce((acc, p) => acc + p.cantidad, 0);

        document.querySelectorAll(".contador-carrito").forEach(el => {
            el.textContent = total;
        });
    }

    function renderCarrito() {
        const contenedor = document.getElementById("carrito-contenido");
        const totalContainer = document.getElementById("carrito-total");
        const btnCheckout = document.getElementById("btn-checkout");
        const btnVaciar = document.getElementById("btn-vaciar-carrito");

        if (!contenedor) return;

        const carrito = obtenerCarrito();

        if (carrito.length === 0) {
            contenedor.innerHTML = ` <p class="text-muted">Tu carrito está vacío</p>`;
            if (totalContainer) totalContainer.innerHTML = "";
            btnCheckout.classList.add("disabled");
            btnCheckout.style.pointerEvents = "none";
            btnVaciar.classList.add("disabled");
            btnVaciar.style.pointerEvents = "none";
            return;
        }

        contenedor.innerHTML = "";

        let total = 0;

        btnCheckout.classList.remove("disabled");
        btnCheckout.style.pointerEvents = "auto";
        btnVaciar.classList.remove("disabled");
        btnVaciar.style.pointerEvents = "auto";
        carrito.forEach(prod => {
            const subtotal = prod.precio * prod.cantidad;
            total += subtotal;

            contenedor.innerHTML += `
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center">
                        <img src="/storage/${prod.imagen}" width="50" class="me-2">
                        <div>
                        
                            <p class="mb-0">${prod.nombre}</p>

                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-sm btn-outline-secondary btn-restar" data-id="${prod.id}">-</button>
                                <span>${prod.cantidad}</span>
                                <button class="btn btn-sm btn-outline-secondary btn-sumar" data-id="${prod.id}">+</button>
                            </div>

                            <small>$${subtotal.toLocaleString()}</small>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-danger btn-eliminar" data-id="${prod.id}">X</button>
                </div>
            `;
        });
        //total general
        if (totalContainer) {
            totalContainer.innerHTML = `
                <hr>
                <h5>Total: $${total.toLocaleString()}</h5>
            `;
        }
    }

    function cambiarCantidad(id, delta) {
        let carrito = obtenerCarrito();

        const producto = carrito.find(p => p.id == id);

        if (!producto) return;

        if (delta > 0 && producto.cantidad >= producto.stock) {
            mostrarToast("No hay más stock disponible", "error");
            return;
        }

        producto.cantidad += delta;

        if (producto.cantidad <= 0) {
            carrito = carrito.filter(p => p.id != id);
        }

        guardarCarrito(carrito);
        renderCarrito();
    }

    //agregar producto
    document.addEventListener("click", e => {
        if (e.target.classList.contains("btn-agregar")) {

            const card = e.target.closest(".card-producto");

            const producto = {
                id: card.dataset.id,
                nombre: card.dataset.nombre,
                precio: parseFloat(card.dataset.precio),
                imagen: card.dataset.imagen,
                stock: parseInt(card.dataset.stock),
                cantidad: parseInt(card.querySelector(".numero").textContent)
            };

            let carrito = obtenerCarrito();

            const existe = carrito.find(p => p.id == producto.id);

            if (existe) {
                //cantidad total que quedaría
                const nuevaCantidad = existe.cantidad + producto.cantidad;

                //si supera el stock
                if (nuevaCantidad > producto.stock) {
                    mostrarToast("No hay suficiente stock disponible", "error");
                    return;
                }

                existe.cantidad = nuevaCantidad;

            } else {
                //si intenta agregar más del stock
                if (producto.cantidad > producto.stock) {
                    mostrarToast("No hay suficiente stock disponible", "error");
                    return;
                }

                carrito.push(producto);
            }

            guardarCarrito(carrito);
            renderCarrito();
            mostrarToast("Producto agregado al carrito");
        }
    });

    //eliminar producto(delegador o admin)
    document.addEventListener("click", e => {
        if (e.target.matches(".btn-danger[data-id]")) {
            const id = e.target.dataset.id;

            let carrito = obtenerCarrito();
            carrito = carrito.filter(p => p.id != id);

            guardarCarrito(carrito);
            renderCarrito();
        }
    });

    //cambiar cantidad de productos en el menú del carrito.
    document.addEventListener("click", e => {
        if (e.target.matches(".btn-sumar")) {
            cambiarCantidad(e.target.dataset.id, 1);
        }

        if (e.target.matches(".btn-restar")) {
            cambiarCantidad(e.target.dataset.id, -1);
        }
    })

    //vaciar carrito(para todos)
    window.vaciarCarrito = function () {
        localStorage.setItem("carrito", JSON.stringify([]));

        document.querySelectorAll(".contador-carrito").forEach(el => {
            el.textContent = "0";
        });

        renderCarrito();
    };

    //sincronizar entre pestañas
    window.addEventListener("storage", () => {
        actualizarContador();
        renderCarrito();
    })

    window.irCheckout = async function () {
        const carrito = obtenerCarrito();
        console.log('Carrito enviado:', carrito);

        try {
            const response = await fetch('/guardar-carrito', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ carrito: carrito })
            });

            const data = await response.json();

            console.log('Respuesta servidor:', data);

            if (data.success) {
                window.location.href = '/compra';
            }
        } catch (error) {
            console.error(error);
        }
    }

    //inicializar
    if(window.carritoUsuario){
        localStorage.setItem(
            "carrito",
            JSON.stringify(window.carritoUsuario)
        );
    }
    actualizarContador();
    renderCarrito();


}

export function limpiarCarrito() {
    window.vaciarCarrito();
}


