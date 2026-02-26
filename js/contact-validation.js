document.addEventListener('DOMContentLoaded', function () {

    const form = document.querySelector('.contact-section form');
    if (!form) return;

    const nameField = form.querySelector('#name');
    const emailField = form.querySelector('#email');
    const messageField = form.querySelector('#message');
    const submitBtn = form.querySelector('button[type="submit"]');

    function removeError(field) {
        field.classList.remove('input-error');

        const error = field.parentElement.querySelector('.field-error');
        if (error) error.remove();
    }

    function showError(field, message) {
        removeError(field);

        field.classList.add('input-error');

        const error = document.createElement('div');
        error.className = 'field-error';
        error.textContent = message;

        field.parentElement.appendChild(error);
    }

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    form.addEventListener('submit', function (e) {

        let hasError = false;
        let firstErrorField = null;

        removeError(nameField);
        removeError(emailField);
        removeError(messageField);

        if (!nameField.value.trim()) {
            showError(nameField, 'Please enter your name.');
            hasError = true;
            firstErrorField = firstErrorField || nameField;
        }

        if (!emailField.value.trim()) {
            showError(emailField, 'Please enter your email.');
            hasError = true;
            firstErrorField = firstErrorField || emailField;
        } else if (!isValidEmail(emailField.value.trim())) {
            showError(emailField, 'Please enter a valid email.');
            hasError = true;
            firstErrorField = firstErrorField || emailField;
        }

        if (!messageField.value.trim()) {
            showError(messageField, 'Please enter a message.');
            hasError = true;
            firstErrorField = firstErrorField || messageField;
        }

        if (hasError) {
            e.preventDefault();

            // Scrolla till första fel
            firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });

            // Fokusera första fel
            firstErrorField.focus();

            return;
        }

        // Disable-knapp
        submitBtn.disabled = true;
        submitBtn.classList.add('is-loading');
        submitBtn.textContent = 'Sending...';
    });
});

// Auto-hide success message
document.addEventListener('DOMContentLoaded', function () {

    const successMessage = document.querySelector('.contact-success');
    if (!successMessage) return;

    setTimeout(() => {
        successMessage.style.transition = 'opacity 0.4s ease';
        successMessage.style.opacity = '0';

        setTimeout(() => {
            successMessage.remove();
        }, 400);

    }, 4000); // 4 sekunder
});
