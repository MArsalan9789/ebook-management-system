document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('container');
    if (!container) return;

    window.toggle = function () {
        container.classList.toggle('sign-in');
        container.classList.toggle('sign-up');
    };

    // Default = Sign In
    container.classList.add('sign-in');
});
