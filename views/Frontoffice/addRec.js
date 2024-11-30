document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('nom').addEventListener('keyup', function() {
        validateNom();
    });

    document.getElementById('email').addEventListener('keyup', function() {
        validateEmail();
    });

    document.getElementById('date_c').addEventListener('change', function() {
        validateDate();
    });

    document.getElementById('sujet').addEventListener('keyup', function() {
        validateSujet();
    });

    document.getElementById('descript').addEventListener('keyup', function() {
        validateDescript();
    });

    document.getElementById('tel').addEventListener('keyup', function() {
        validateTel();
    });

    document.getElementById('reclamationForm').addEventListener('submit', function(event) {
        const nom = document.getElementById('nom').value;
        const email = document.getElementById('email').value;
        const date = document.getElementById('date_c').value;
        const sujet = document.getElementById('sujet').value;
        const descript = document.getElementById('descript').value;
        const tel = document.getElementById('tel').value;

        if (!nom && !email && !date && !sujet && !descript && !tel) {
            alert('Tous les champs sont vides.');
            event.preventDefault();
            return;
        }

        validateDate();
    });

    function validateNom() {
        const nom = document.getElementById('nom').value;
        const message = document.getElementById('nom-error');

        if (nom.length < 3 || !/^[a-zA-Z\s]+$/.test(nom)) {
            showError(message, 'Le nom doit contenir au moins 3 caractères et uniquement des lettres et des espaces.');
        } else {
            showSuccess(message, 'Correct');
        }
    }

    function validateEmail() {
        const email = document.getElementById('email').value;
        const message = document.getElementById('email-error');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(email)) {
            showError(message, 'Veuillez entrer une adresse email valide.');
        } else {
            showSuccess(message, 'Correct');
        }
    }

    function validateDate() {
        const date = document.getElementById('date_c').value;
        const today = new Date().toISOString().split('T')[0];
        let valid = true;

        if (date !== today) {
            alert('La date doit être la date courante.');
            valid = false;
        }

        if (!valid) {
            event.preventDefault();
        }
    }

    function validateSujet() {
        const sujet = document.getElementById('sujet').value;
        const message = document.getElementById('sujet-error');

        if (sujet.length < 3 || !/^[a-zA-Z\s]+$/.test(sujet)) {
            showError(message, 'Le sujet doit contenir au moins 3 caractères et uniquement des lettres et des espaces.');
        } else {
            showSuccess(message, 'Correct');
        }
    }

    function validateDescript() {
        const descript = document.getElementById('descript').value;
        const message = document.getElementById('descript-error');

        if (descript.trim() === '') {
            showError(message, 'Le message ne doit pas être vide.');
        } else {
            showSuccess(message, 'Correct');
        }
    }

    function validateTel() {
        const tel = document.getElementById('tel').value;
        const message = document.getElementById('tel-error');
        const telRegex = /^\d{8}$/;

        if (!telRegex.test(tel)) {
            showError(message, 'Le numéro de téléphone doit contenir exactement 8 chiffres.');
        } else {
            showSuccess(message, 'Correct');
        }
    }

    function showError(element, message) {
        element.innerText = message;
        element.style.color = 'red';
    }

    function showSuccess(element, message) {
        element.innerText = message;
        element.style.color = 'green';
    }
});