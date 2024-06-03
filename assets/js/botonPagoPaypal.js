'use strict';
document.addEventListener("DOMContentLoaded", function() {
        var divPayPal = document.getElementById('paypal-button-container');
        var inputs = [
            document.getElementById('firstName'),
            document.getElementById('lastName'),
            document.getElementById('email'),
            document.getElementById('address'),
            document.getElementById('address2')
        ];

        function checkInputs() {
            var allFilled = inputs.every(input => input.value.trim() !== '');
            if (allFilled) {
                divPayPal.removeAttribute('hidden');
            } else {
                divPayPal.setAttribute('hidden', true);
            }
        }

        inputs.forEach(input => input.addEventListener('input', checkInputs));
        checkInputs();
    });