const metodoPago = document.getElementById('metodoPago');
const datosTarjeta = document.getElementById('datosTarjeta');

if(metodoPago){
    metodoPago.addEventListener('change', ()=>{
        if(metodoPago.value === 'tarjeta'){
            datosTarjeta.style.display = 'block';
        }else{
            datosTarjeta.style.display = 'none';
        }
    });
}