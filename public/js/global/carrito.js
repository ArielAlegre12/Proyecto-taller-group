import { mostrarToast } from "./toast.js";

export function initCarrito(){
    //función para obtener el carrito
    async function obtenerCarrito() {
        try{
            const response = await fetch('/carrito', {
                headers: {
                    'Accept': 'application/json'
                }
            });

            if(!response.ok){
                console.error('Error obteniendo carrito:', response.status);
                return [];
            }

            return await response.json();
        }catch(error){
            console.error(error);
            return [];
        }
    }
    //actualizar el contador del carrito
    async function actualizarContador(){
        const carrito = await obtenerCarrito();

        const total = carrito.reduce((acc, item) =>  {
            return acc + item.cantidad;
        }, 0);

        document.querySelectorAll(".contador-carrito").forEach(el=>{
            el.textContent = total;
        });
    }

    //renderizar carrito
    async function renderCarrito() {
        const contenedor = document.getElementById("carrito-contenido");
        const totalContainer = document.getElementById("carrito-total");
        const btnCheckout = document.getElementById("btn-checkout");
        const btnVaciar = document.getElementById("btn-vaciar-carrito");

        if(!contenedor) return;

        const carrito = await obtenerCarrito();

        if(carrito.length === 0){
            contenedor.innerHTML = `
                <p class="text-muted">Tu carrito está vacío</p>
            `;

            totalContainer.innerHTML = "";

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

        carrito.forEach(item => {
            const producto = item.producto;
            const subtotal = producto.precio * item.cantidad;
            total += subtotal;

            contenedor.innerHTML += `
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center">
                        <img src="/storage/${producto.imagen}" width="50" class="me-2">
                        <div>
                            <p class="mb-0">${producto.nombre}</p>
                            <div class="d-flex align-items-center gap-2">
                                <button class ="btn btn-sm btn-outline-secondary btn-restar" data-id="${producto.id}">
                                -
                                </button>

                                <span>${item.cantidad}</span>

                                <button class="btn btn-sm btn-outline-secondary btn-sumar" data-id="${producto.id}">
                                    +
                                </button>
                            </div>
                            
                            <small>$${subtotal.toLocaleString()}</small>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-danger btn-eliminar" data-id="${producto.id}">
                        x
                    </button>
                </div>
            `;
        });

        totalContainer.innerHTML = `
            <hr>
            <h5>Total: $${total.toLocaleString()}</h5>
        `;
    }

    async function agregarProducto(productoId, cantidad){
        await fetch('/carrito/agregar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .content
            },
            body: JSON.stringify({
                producto_id: productoId,
                cantidad: cantidad
            })
        });
        await actualizarContador();
        await renderCarrito();
    }

    async function eliminarProducto(productoId) {
        await fetch('/carrito/eliminar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .content
            },
            body: JSON.stringify({
                producto_id: productoId
            })
        });
        mostrarToast("Producto eliminado")
        await actualizarContador();
        await renderCarrito();
    }

    async function vaciarCarrito() {
        await fetch('/carrito/vaciar', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .content
            }
        });
        await actualizarContador();
        await renderCarrito();
    }

    //agregar producto
    document.addEventListener("click", async e =>{
        if(e.target.classList.contains("btn-agregar")){
            const card = e.target.closest(".card-producto");
            const productoId = card.dataset.id;
            const cantidad = parseInt(
                card.querySelector(".numero").textContent
            );
            await agregarProducto(productoId, cantidad);

            mostrarToast("Producto agregado al carrito");
        }
    })

    //eliminar producto
    document.addEventListener("click", async e =>{
        if(e.target.matches(".btn-eliminar")){
            const productoId = e.target.dataset.id;
            await eliminarProducto(productoId);
        }
    });

    document.addEventListener("click", async e =>{
        if(e.target.matches(".btn-sumar")){
            const productoId = e.target.dataset.id;
            const carrito = await obtenerCarrito();
            const item =  carrito.find(i => i.producto.id == productoId);

            if(item && item.cantidad >= item.producto.stock){
                mostrarToast("No hay más stock disponible", "error");
                return;
            }

            if(item){
                await fetch('/carrito/cantidad', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            .content
                    },
                    body: JSON.stringify({
                        producto_id: productoId,
                        cantidad: item.cantidad + 1
                    })
                });
                await actualizarContador();
                await renderCarrito();
            }
        }
        if(e.target.matches(".btn-restar")){
            const productoId = e.target.dataset.id;
            const carrito = await obtenerCarrito();
            const item = carrito.find(i => i.producto.id == productoId);
            if(item){
                if(item.cantidad <= 1){
                    await eliminarProducto(productoId);
                    return;
                }
                await fetch('/carrito/cantidad', {
                    method: 'POST',
                    headers:{
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            .content
                    },
                    body: JSON.stringify({
                        producto_id: productoId,
                        cantidad: item.cantidad -1
                    })
                });
                await actualizarContador();
                await renderCarrito();
            }
        }
    })

    //vaciar carrito
    window.vaciarCarrito = async function(){
        await vaciarCarrito();
        mostrarToast("Carrito vaciado");
    }

    window.irCheckout = function(){
        window.location.href = '/compra';
    }

    actualizarContador();
    renderCarrito();
}
