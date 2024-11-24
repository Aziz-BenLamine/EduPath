document.addEventListener("DOMContentLoaded", function() {
    const statut = document.getElementById('statut').value;
    const submitBtn = document.getElementById('submitBtn');

    if (statut === 'traité') {
        submitBtn.disabled = true;
    }
});

function validateName() {
    const name = document.getElementById('name_a').value;
    const message = document.getElementById('name-error');

    if (name.length < 3 || !/^[a-zA-Z\s]+$/.test(name)) {
        showError(message, 'Le nom doit contenir au moins 3 caractères et uniquement des lettres et des espaces.');
    } else {
        showSuccess(message, 'Correct');
    }
}

function validateDate() {
    const date = document.getElementById('date_r').value;
    const message = document.getElementById('date-error');
    const today = new Date().toISOString().split('T')[0];

    if (date !== today) {
        showError(message, 'La date doit être la date courante.');
    } else {
        showSuccess(message, 'Correct');
    }
}

function validateForm() {
    const name = document.getElementById('name_a').value;
    const date = document.getElementById('date_r').value;
    const contenu = document.getElementById('contenu').value;
    const today = new Date().toISOString().split('T')[0];
    let valid = true;

    if (name.length < 3 || !/^[a-zA-Z\s]+$/.test(name)) {
        alert('Le nom doit contenir au moins 3 caractères et uniquement des lettres et des espaces.');
        valid = false;
    }

    if (date !== today) {
        alert('La date doit être la date courante.');
        valid = false;
    }

    if (contenu.trim() === '') {
        alert('Le message ne doit pas être vide.');
        valid = false;
    }

    if (!valid) {
        event.preventDefault();
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