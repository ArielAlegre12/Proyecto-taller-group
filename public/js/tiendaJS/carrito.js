export function initCarrito(){

    function obtenerCarrito(){
        return JSON.parse(localStorage.getItem("carrito")) || [];
    }

    function guardarCarrito(carrito){
        localStorage.setItem("carrito", JSON.stringify(carrito));
        actualizarContador();
    }

    function actualizarContador(){
        const carrito = obtenerCarrito();
        const total = carrito.reduce((acc, p) => acc + p.cantidad, 0);

        document.querySelectorAll(".contador-carrito").forEach(el=>{
            el.textContent = total;
        });
    }

    function renderCarrito(){
        const contenedor = document.getElementById("carrito-contenido");
        if(!contenedor) return;

        const carrito = obtenerCarrito();

        if(carrito.length === 0){
            contenedor.innerHTML = ` <p class="text-muted">Tu carrito está vacío</p>`;
            return;
        }

        contenedor.innerHTML="";

        carrito.forEach(prod=>{
            contenedor.innerHTML += `
                <div class="d-flex align-items-center mb-3">
                    <img src="${prod.imagen}" width="50" class="me-2">
                        <div class="flex-grow-1">
                            <p class="mb-0">${prod.nombre}</p>
                            <small>Cant: ${prod.cantidad}</small>
                        </div>
                        <button class="btn btn-sm btn-danger" data-id="${prod.id}">X</button>
                </div>
            `;
        });
    }

    //agregar producto
    document.addEventListener("click", e=>{
        if(e.target.classList.contains("btn-agregar")){

            const card = e.target.closest(".card-producto");

            const producto = {
                id: card.dataset.id,
                nombre: card.dataset.nombre,
                precio: parseFloat(card.dataset.precio),
                imagen: card.dataset.imagen,
                cantidad: parseInt(card.querySelector(".numero").textContent)
            };

            let carrito =  obtenerCarrito();

            const existe = carrito.find(p=> p.id == producto.id);

            if(existe){
                existe.cantidad += producto.cantidad;
            }else{
                carrito.push(producto);
            }

            guardarCarrito(carrito);
            renderCarrito();
        }
    });

    //eliminar producto(delegador o admin)
    document.addEventListener("click", e=>{
        if(e.target.matches(".btn-danger[data-id]")){
            const id = e.target.dataset.id;

            let carrito = obtenerCarrito();
            carrito = carrito.filter(p=>p.id != id);

            guardarCarrito(carrito);
            renderCarrito();
        }
    });

    //vaciar carrito(para todos)
    window.vaciarCarrito = function(){
        localStorage.removeItem("carrito");
        renderCarrito();
        actualizarContador();
    };

    //inicializar
    actualizarContador();
    renderCarrito();
}