document.addEventListener('DOMContentLoaded', () => {
    //restaurar scroll
    const scrollPos = sessionStorage.getItem('scrollPos');

    if (scrollPos) {
        window.scrollTo({
            top: parseInt(scrollPos),
            behavior: 'instant'
        });

        sessionStorage.removeItem('scrollPos');
    }

    //formularios
    document.querySelectorAll('.preserve-scroll')
        .forEach(form =>{
            form.addEventListener('submit', ()=>{
                sessionStorage.setItem('scrollPos',  window.scrollY);
            });
    });
    
    //links
    document.querySelectorAll('.preserve-link')
        .forEach(link =>{
            link.addEventListener('click', ()=>{
                sessionStorage.setItem('scrollPos', window.scrollY);
            });
    });
});