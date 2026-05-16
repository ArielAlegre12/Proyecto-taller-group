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
    const cardProducto = boton.closest('.card-producto');
    const stock = parseInt(cardProducto.dataset.stock);

    let valor = parseInt(numero.textContent);

    valor += cambio;
    
    //minimo
    if(valor < 1){
        valor = 1;
    }

    //máximo = stock
    if(valor > stock){
        valor = stock;

        alert('No hay más stock disponibles');
    }

    numero.textContent = valor;
}