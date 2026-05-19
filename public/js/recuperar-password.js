document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('passwordForm');

    if(form){
        form.addEventListener('submit', (e) => {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirmPassword');
            const error = document.getElementById('passwordError');

            if(password.value !== confirmPassword.value){
                e.preventDefault();

                error.classList.remove('d-none');

                confirmPassword.classList.add('is-invalid');
            }else{
                error.classList.add('d-none');

                confirmPassword.classList.remove('is-invalid')
            }
        });
    }
});