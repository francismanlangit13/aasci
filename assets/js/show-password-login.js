const passwordInput = document.querySelector('.form-control[type="password"]');
const passwordToggle = document.querySelector('.password-toggle');

passwordToggle.addEventListener('click', () => {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggle.innerHTML = '<i class="fa fa-eye-slash"></i> Hide';
    } else {
        passwordInput.type = 'password';
        passwordToggle.innerHTML = '<i class="fa fa-eye"></i> Show';
    }
});