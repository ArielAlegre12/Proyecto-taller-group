const metodoPago = document.getElementById('metodoPago');
const datosTarjeta = document.getElementById('datosTarjeta');

const metodoEntrega = document.getElementById("metodoEntrega");
const direccionContainer = document.getElementById("direccionContainer");

const costoEnvio = document.getElementById("costoEnvio");
const totalFinal = document.getElementById("totalFinal");
const checkoutData = document.getElementById("checkoutData");
const subtotal = parseFloat(checkoutData.dataset.total);

const numeroTarjeta = document.querySelector('[name="numero_tarjeta"]');
const titular = document.querySelector('[name="titular"]');
const vencimiento = document.querySelector('[name="vencimiento"]');
const cvv = document.querySelector('[name="cvv"]');

const inputVencimiento = document.querySelector('[name="vencimiento"]');

const tipoTarjeta = document.getElementById("tipoTarjeta");

//checkout fecha vencimiento
if (inputVencimiento) {
    inputVencimiento.addEventListener('input', () => {
        let valor = inputVencimiento.value.replace(/\D/g, '');

        //limitar a 4 núm
        valor = valor.slice(0, 4);
        //validar mes
        if (valor.length >= 2) {
            let mes = parseInt(valor.slice(0, 2));
            if (mes > 12) {
                valor = '12' + valor.slice(2);
            }
            if (mes < 1) {
                valor = '01' + valor.slice(2);
            }
        }

        //agregar /
        if (valor.length >= 3) {
            valor = valor.slice(0, 2) + '/' + valor.slice(2, 4);
        }
        inputVencimiento.value = valor;
    });
}

//checkout núm de tarjeta
if (numeroTarjeta) {
    numeroTarjeta.addEventListener('input', () => {
        let valor = numeroTarjeta.value.replace(/\D/g, '');

        //máximo 16 digitos
        valor = valor.slice(0, 16);

        //detectar tipo
        if (valor.startsWith('4')) {
            tipoTarjeta.innerHTML = `
                <i class="bi bi-credit-card-2-front-fill text-primary"></i>
                Visa
            `;
        }else if(/^5[1-5]/.test(valor)){
            tipoTarjeta.innerHTML = `
                <i class="bi bi-credit-card-2-front-fill text-danger"></i>
                Mastercard
            `;
        }else if(valor.length > 0){
            tipoTarjeta.innerHTML = `
                <i class="bi bi-credit-card"></i>
                Tarjeta no reconocida
            `;
        }else{
            tipoTarjeta.innerHTML = '';
        }

        //agregar espacios cada 4
        valor = valor.replace(/(.{4})/g, '$1 ').trim();

        numeroTarjeta.value = valor;
    });
}

//checkout de cvv
if (cvv) {
    cvv.addEventListener('input', () => {
        let valor = cvv.value.replace(/\D/g, '');

        //máximo 4
        valor = valor.slice(0, 4);

        cvv.value = valor;
    });
}

//verificar metodo de pago
if (metodoPago) {
    function toggleTarjeta() {
        if (metodoPago.value === 'tarjeta') {
            datosTarjeta.style.display = 'block';

            numeroTarjeta.required = true;
            titular.required = true;
            vencimiento.required = true;
            cvv.required = true;
        } else {
            datosTarjeta.style.display = 'none';

            numeroTarjeta.required = false;
            titular.required = false;
            vencimiento.required = false;
            cvv.required = false;
        }
    }

    metodoPago.addEventListener('change', toggleTarjeta);

    //ejecutar al cargar
    toggleTarjeta();
}

metodoEntrega.addEventListener("change", () => {
    let envio = 0;

    //mostrar dirección
    if (
        metodoEntrega.value === "domicilio" ||
        metodoEntrega.value === "express"
    ) {
        direccionContainer.classList.remove("d-none");
    } else {
        direccionContainer.classList.add("d-none");
    }

    //costos
    if (metodoEntrega.value === "domicilio") {
        envio = 2500;
    }

    if (metodoEntrega.value === "express") {
        envio = 5000;
    }

    costoEnvio.textContent = `$${envio.toLocaleString()}`;

    totalFinal.textContent =
        `$${(subtotal + envio).toLocaleString()}`;
});
