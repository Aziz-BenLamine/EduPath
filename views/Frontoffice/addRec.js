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
        validateNom();
        validateEmail();
        validateDate();
        validateSujet();
        validateDescript();
        validateTel();

        const errors = document.querySelectorAll('.error-message');
        let formIsValid = true;

        errors.forEach(function(error) {
            if (error.innerText !== 'Correct') {
                formIsValid = false;
            }
        });

        if (!formIsValid) {
            alert('La formulaire est vide ou Veuillez corriger les erreurs dans le formulaire.');
            event.preventDefault();
        }
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
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailPattern.test(email)) {
            showError(message, 'Veuillez entrer une adresse email valide.');
        } else {
            showSuccess(message, 'Correct');
        }
    }

    function validateDate() {
        const date = document.getElementById('date_c').value;
        const message = document.getElementById('date-error');
        const today = new Date().toISOString().split('T')[0];

        if (date !== today) {
            showError(message, 'La date doit être la date courante.');
        } else {
            showSuccess(message, 'Correct');
        }
    }

    function validateSujet() {
        const sujet = document.getElementById('sujet').value;
        const message = document.getElementById('sujet-error');

        if (sujet.length < 3) {
            showError(message, 'Le sujet doit contenir au moins 3 caractères.');
        } else {
            showSuccess(message, 'Correct');
        }
    }

    function validateDescript() {
        const descript = document.getElementById('descript').value;
        const message = document.getElementById('descript-error');

        if (descript.length < 10) {
            showError(message, 'La description doit contenir au moins 10 caractères.');
        } else {
            showSuccess(message, 'Correct');
        }
    }

    function validateTel() {
        const tel = document.getElementById('tel').value;
        const message = document.getElementById('tel-error');
        const telPattern = /^[0-9]{8}$/;

        if (!telPattern.test(tel)) {
            showError(message, 'Le numéro de téléphone doit contenir 8 chiffres.');
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