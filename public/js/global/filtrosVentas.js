document.addEventListener('DOMContentLoaded', ()=>{
    const inputDesde = document.querySelector('input[name="desde"]');
    const inputHasta = document.querySelector('input[name="hasta"]');

    if(inputDesde && inputHasta){
        inputDesde.addEventListener('change', ()=>{
            inputHasta.min = inputDesde.value;

            //si hasta quedó menor, lo limpia
            if(inputHasta.value < inputDesde.value){
                inputHasta.value = '';
            }
        });
    }
});