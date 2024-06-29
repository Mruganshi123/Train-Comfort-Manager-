document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('edit-profile-form');
    const messageDiv = document.getElementById('message');

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        clearErrorMessages();
        const isValid = validateForm();
        if (isValid) {
            messageDiv.textContent = 'Profile updated successfully!';
            messageDiv.classList.add('success');
            messageDiv.classList.remove('error');
            
            // Display alert box
            alert('Profile updated successfully!');
        } else {
            messageDiv.textContent = 'Please correct the errors and try again.';
            messageDiv.classList.add('error');
            messageDiv.classList.remove('success');
        }
    });

    function validateForm() {
        let valid = true;
        const inputs = form.querySelectorAll('input');
        inputs.forEach(input => {
            if (!input.value.trim()) {
                valid = false;
                showErrorMessage(input, `${input.previousElementSibling.textContent} is required.`);
            } else {
                input.classList.remove('invalid');
            }
        });

        const email = document.getElementById('email');
        if (!validateEmail(email.value)) {
            valid = false;
            showErrorMessage(email, 'Please enter a valid email address.');
        } else {
            email.classList.remove('invalid');
        }

        const phone = document.getElementById('phone');
        if (!validatePhone(phone.value)) {
            valid = false;
            showErrorMessage(phone, 'Please enter a valid 10-digit phone number.');
        } else {
            phone.classList.remove('invalid');
        }

        return valid;
    }

    function validateEmail(email) {
        const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return re.test(String(email).toLowerCase());
    }

    function validatePhone(phone) {
        const re = /^\d{10}$/;
        return re.test(String(phone));
    }

    function showErrorMessage(input, message) {
        input.classList.add('invalid');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = message;
        input.parentNode.insertBefore(errorDiv, input.nextSibling);
    }

    function clearErrorMessages() {
        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(error => error.remove());
    }

    // Restrict input to digits only
    const phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '');
    });

});
