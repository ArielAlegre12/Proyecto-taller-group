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
        threshold: 0 // permite que la visualización se active con cualquier vista
    });

    elementos.forEach(el => {
        observer.observe(el);
        //verificar si ya está visible al cargar
        if (isInViewport(el)) {
            el.classList.add('visible');
        }
    });

});

//función para verificar si un elemento está en el viewport
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}