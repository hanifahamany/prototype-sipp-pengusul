document.querySelectorAll('[data-password-toggle]').forEach((toggle) => {
    const passwordId = toggle.getAttribute('aria-controls');
    const passwordInput = passwordId ? document.getElementById(passwordId) : null;

    if (!(passwordInput instanceof HTMLInputElement)) {
        return;
    }

    const hiddenIcon = toggle.querySelector('[data-password-hidden-icon]');
    const visibleIcon = toggle.querySelector('[data-password-visible-icon]');

    toggle.addEventListener('click', () => {
        const isPasswordVisible = passwordInput.type === 'password';

        passwordInput.type = isPasswordVisible ? 'text' : 'password';
        toggle.setAttribute('aria-label', isPasswordVisible ? 'Sembunyikan password' : 'Tampilkan password');
        toggle.setAttribute('aria-pressed', String(isPasswordVisible));
        hiddenIcon?.classList.toggle('hidden', isPasswordVisible);
        visibleIcon?.classList.toggle('hidden', !isPasswordVisible);
    });
});
