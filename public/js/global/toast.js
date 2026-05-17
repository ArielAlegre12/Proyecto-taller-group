export function mostrarToast(mensaje, tipo = "success"){
    const toast = document.getElementById("toast-global");

    toast.textContent=mensaje;

    //reseteo de clases
    toast.classList.remove("toast-success");
    toast.classList.remove("toast-error");

    //eligimos el tipo de msj
    if(tipo === "error"){
        toast.classList.add("toast-error");
    }else{
        toast.classList.add("toast-success");
    }

    toast.classList.add("show");

    setTimeout(() => {
        toast.classList.remove("show");
    }, 3000);
}