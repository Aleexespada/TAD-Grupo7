function showPassword(e, inputId) {
    if (e.target.classList.contains('fa-eye-slash')) {
        e.target.classList.remove('fa-eye-slash');
        e.target.classList.add('fa-eye');
    } else {
        e.target.classList.remove('fa-eye');
        e.target.classList.add('fa-eye-slash');
    }
    var change = document.getElementById(inputId);
    if (change.type == 'password') {
        change.type = 'text';
    } else {
        change.type = 'password';
    }
}