const metodoPago = document.getElementById('metodoPago');
const datosTarjeta = document.getElementById('datosTarjeta');

const numeroTarjeta =  document.querySelector('[name="numero_tarjeta"]');
const titular = document.querySelector('[name="titular"]');
const vencimiento = document.querySelector('[name="vencimiento"]');
const cvv = document.querySelector('[name="cvv"]');

const inputVencimiento = document.querySelector('[name="vencimiento"]');
if(inputVencimiento){
    inputVencimiento.addEventListener('input', ()=>{
        let valor = inputVencimiento.value.replace(/\D/g, '');

        //limitar a 4 núm
        valor = valor.slice(0,4);
        //validar me
        if(valor.length >= 2){
            let mes = parseInt(valor.slice(0,2));
            if(mes > 12){
                valor = '12' + valor.slice(2);
            }
            if(mes < 1){
                valor = '01' + valor.slice(2);
            }
        }

        //agregar /
        if(valor.length >= 3){
            valor = valor.slice(0,2) + '/' + valor.slice(2,4);
        }
        inputVencimiento.value = valor;
    });
}


//verificar metodo de pago
if(metodoPago){
    function toggleTarjeta(){
        if(metodoPago.value === 'tarjeta'){
            datosTarjeta.style.display = 'block';

            numeroTarjeta.required = true;
            titular.required = true;
            vencimiento.required = true;
            cvv.required = true;
        }else{
            datosTarjeta.style.display = 'none';

            numeroTarjeta.required = false;
            titular.required =  false;
            vencimiento.required = false;
            cvv.required = false;
        }
    }

    metodoPago.addEventListener('change', toggleTarjeta);

    //ejecutar al cargar
    toggleTarjeta();
}