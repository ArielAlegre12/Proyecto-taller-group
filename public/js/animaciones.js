document.addEventListener("DOMContentLoaded", () => {

    const elementos = document.querySelectorAll('.animar');

    if (elementos.length === 0) return; // evita errores si no hay elementos

    if (!("IntersectionObserver" in window)) {
        // fallback por si el navegador no soporta
        elementos.forEach(el => el.classList.add('visible'));
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.2
    });

    elementos.forEach(el => observer.observe(el));

});