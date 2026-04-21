let isLogin = true;

document.addEventListener("DOMContentLoaded", () => {
    
    const btnLogin = document.getElementById("btnLogin");
    const btnRegister = document.getElementById("btnRegister");
    const grupoNombre = document.getElementById("grupoNombre");
    const grupoConfirm = document.getElementById("grupoConfirm");
    const submitBtn = document.getElementById("submitBtn");
    const togglePass = document.getElementById("togglePass");

    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");
    const form = document.getElementById("formulario");

    btnLogin.onclick = () => {
    isLogin = true;

    ocultarConAnimaciones(grupoNombre);
    ocultarConAnimaciones(grupoConfirm);

    submitBtn.textContent = "Iniciar Sesion";

    btnRegister.classList.remove("active");
    btnLogin.classList.add("active");
};

btnRegister.onclick = () => {
    isLogin = false;

    mostrarConAnimaciones(grupoNombre);
    mostrarConAnimaciones(grupoConfirm);

    submitBtn.textContent = "Crear Cuenta";

    btnRegister.classList.add("active");
    btnLogin.classList.remove("active");
};

    togglePass.onclick = () => {
        const tipo = password.type === "password" ? "text" : "password";

        password.type = tipo;

        if(confirmPassword){
            confirmPassword.type = tipo;
        }
    };

    form.onsubmit = (e) => {
        e.preventDefault();
    }

    function mostrarConAnimaciones(el){
        el.classList.remove("d-none");

        setTimeout(() => {
            el.classList.add("show");
        }, 10);
    }

    function ocultarConAnimaciones(el){
        el.classList.remove("show");

        setTimeout(() => {
            el.classList.add("d-none");
        }, 300);
    }
});