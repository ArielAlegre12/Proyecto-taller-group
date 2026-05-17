const btnEditar = document.getElementById("btnEditar");
const btnCancelar = document.getElementById("btnCancelar");
const botonesGuardar = document.getElementById("botonesGuardar");

const campos = document.querySelectorAll(".campo-editable");

if(btnEditar){
    btnEditar.addEventListener("click", () => {
        campos.forEach(campo => {
            campo.disabled = false;
    });

    botonesGuardar.classList.remove("d-none");
    btnEditar.classList.add("d-none");
});

}

if(btnCancelar){
    btnCancelar.addEventListener("click", () => {
        campos.forEach(campo => {
            campo.disabled = true;
        });

        botonesGuardar.classList.add("d-none");
        btnEditar.classList.remove("d-none");
    });
}

document.addEventListener("DOMContentLoaded", () =>  {
    const elementos = document.querySelectorAll(".animar");
    
    if(elementos.length === 0) return;

    if(!("IntersectionObserver" in window)) {
        elementos.forEach(el => el.classList.add("d-none"));

        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry =>{
            if(entry.isIntersecting){
                entry.target.classList.add("visible");
            }
        });
    }, {
        threshold: 0
    });

    elementos.forEach(el => {
        observer.observe(el);

        if(isInViewport(el)) {
            el.classList.add("visible");
        }
    });
});

function isInViewport(element) {
    const rect = element.getBoundingClientRect();

    return(rect.top >= 0 && rect.left >= 0 && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && rect.right <= (window.innerWidth || document.documentElement.clientWidth));
}