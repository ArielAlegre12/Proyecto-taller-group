//exportar pal main
export function initCantidad(){
    const btnCantidad = document.querySelectorAll('.cantidad button');

    btnCantidad.forEach(btn=>{
        btn.addEventListener('click', ()=>{
            const cambio = btn.textContent === '+' ? 1 : -1;
            cambiarCantidad(btn, cambio);
        });
    });
}

//fncion para cambiar la cantidad 
function cambiarCantidad(boton, cambio){
    const contenedor = boton.parentElement;
    const numero  = contenedor.querySelector('.numero');

    let valor = parseInt(numero.textContent);

    valor += cambio;
    if(valor < 1) valor = 1;

    numero.textContent = valor;
}