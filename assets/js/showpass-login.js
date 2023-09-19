function addTogglePasswordListener(togglePassword, password) {
  togglePassword.addEventListener('click', function (e) {

    // Toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    // Toggle the eye icon
    const eyeIcon = togglePassword.querySelector('i');
    eyeIcon.classList.toggle('bxs-hide');
    eyeIcon.classList.toggle('bxs-show');
  });
}

// Usage
addTogglePasswordListener(document.querySelector('#togglePassword'), document.querySelector('#password'));
