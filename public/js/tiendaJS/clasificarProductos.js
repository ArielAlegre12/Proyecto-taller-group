//.js para exportar 
export function initFiltros() {
    //defino variables
    const filtrosAnimal = document.querySelectorAll("[data-filtro-animal]");
    const filtrosTipo = document.querySelectorAll("button[data-tipo]");
    let animalActivo = "todos";
    let tipoActivo = "todos";

    //evento de filtrado de categoria en los clickeos

    //filtrar animal
    filtrosAnimal.forEach(btn => {
        btn.addEventListener("click", () =>{
            const animal = btn.dataset.filtroAnimal;
            const params = new URLSearchParams(window.location.search);

            //guardar tipo actual
            if(tipoActivo !== "todos"){
                params.set("tipo", tipoActivo);
            }

            //manejo animal
            if(animal  === "todos"){
                params.delete("animal");
            }else{
                params.set("animal", animal);
            }

            //redirigir
            window.location.href = `/tienda?${params.toString()}`;
        });
    });

    //filtrar tipo
    filtrosTipo.forEach(btn => {
        btn.addEventListener("click", () => {
            const tipo = btn.dataset.tipo;
            const params = new URLSearchParams(window.location.search);

            //guardar animal actual
            if(animalActivo !== "todos"){
                params.set("animal", animalActivo);
            }

            //manejo tipo
            if(tipo === "todos"){
                params.delete("tipo")
            }else{
                params.set("tipo", tipo);
            }

            //redirigir
            window.location.href = `/tienda?${params.toString()}`;
        });
    });
}