//.js para exportar 
export function initFiltros() {
    //defino variables
    const filtrosAnimal = document.querySelectorAll("[data-filtro-animal]");
    const filtrosTipo = document.querySelectorAll("button[data-tipo]");
    const productos = document.querySelectorAll(".card-producto");
    const mensajeVacio = document.getElementById("mensaje-vacio");
    let animalActivo = "todos";
    let tipoActivo = "todos";

    //función que permite filtrar las categorias recorriendo el array de catalogo
    function filtrar() {
        let visibles = 0;

        productos.forEach(prod => {
            const animal = prod.dataset.animal;
            const tipo = prod.dataset.tipo;

            const coincideAnimal = animalActivo === "todos" || animal === animalActivo;
            const coincideTipo = tipoActivo === "todos" || tipo === tipoActivo;

            if (coincideAnimal && coincideTipo) {
                prod.classList.remove("oculto");
                visibles++;
            } else {
                prod.classList.add("oculto");
            }
        });
        //control del msj
        if (visibles === 0) {
            let texto = "No hay productos";

            if (animalActivo !== "todos" && tipoActivo !== "todos") {
                texto += ` para ${animalActivo} en ${tipoActivo}`;
            } else if (animalActivo !== "todos") {
                texto += ` para ${animalActivo}`;
            } else if (tipoActivo !== "todos") {
                texto += ` de ${tipoActivo}`;
            }

            texto = texto.charAt(0).toUpperCase() + texto.slice(1);

            mensajeVacio.innerText = texto;
            mensajeVacio.style.display = "block";
        } else {
            mensajeVacio.style.display = "none";
        }
    }

    //evento de filtrado de categoria en los clickeos

    //filtrar animal
    filtrosAnimal.forEach(btn => {
        btn.addEventListener("click", () => {
            animalActivo = btn.dataset.filtroAnimal;
            
            filtrosAnimal.forEach(b => {
                b.classList.remove("activo");
                b.setAttribute("aria-pressed", "false");
            });

            btn.classList.add("activo");
            btn.setAttribute("aria-pressed", "true");

            filtrar();
        });
    });

    //filtrar tipo
    filtrosTipo.forEach(btn => {
        btn.addEventListener("click", () => {
            tipoActivo = btn.dataset.tipo;

            document.querySelectorAll("button[data-tipo]").forEach(b => {
                b.classList.remove("activo");
                b.setAttribute("aria-pressed", "false");
            });
            btn.classList.add("activo");
            btn.setAttribute("aria-pressed", "true");

            filtrar();
        })
    });

    //leer los parámetros de la URL al cargar
    const params = new URLSearchParams(window.location.search);

    const animalParam = params.get("animal");
    const tipoParam = params.get("tipo");

    

    if(animalParam){
        animalActivo = animalParam;

        //activar visualmente el botón correcto
        filtrosAnimal.forEach(btn=>{
            if(btn.dataset.filtroAnimal === animalParam){
                btn.classList.add("activo");
                btn.setAttribute("aria-pressed", "true");
            }else{
                btn.classList.remove("activo");
                btn.setAttribute("aria-pressed", "false");
            }
        });
    }

    if(tipoParam){
        tipoActivo =  tipoParam;

        filtrosTipo.forEach(btn=>{
            if(btn.dataset.tipo === tipoParam){
                btn.classList.add("activo");
                btn.setAttribute("aria-pressed", "true");
            }else{
                btn.classList.remove("activo");
                btn.setAttribute("aria-pressed", "false");
            }
        });
    }

    //ejecuta el filtrado inicial
    filtrar();
}