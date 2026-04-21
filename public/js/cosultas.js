document.addEventListener("DOMContentLoaded", function () {
    const tipoAnimal = document.getElementById("tipoAnimal");
    const domestico = document.getElementById("domesticoFields");
    const campo = document.getElementById("campoFields");

    tipoAnimal.addEventListener("change", function () {
        if (this.value === "campo") {
            domestico.classList.add("d-none");
            campo.classList.remove("d-none");
        } else {
            domestico.classList.remove("d-none");
            campo.classList.add("d-none");
        }
    });
});