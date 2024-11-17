document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const nom = document.getElementById('nom');
    const email = document.getElementById('email');
    const sujet = document.getElementById('sujet');
    const tel = document.getElementById('tel');
    const date_c = document.getElementById('date_c');

    form.addEventListener('submit', function(event) {
        let valid = true;

        // Validation du nom
        const nomRegex = /^[a-zA-Z\s]+$/;
        if (!nomRegex.test(nom.value)) {
            alert('Le nom ne doit contenir que des lettres et des espaces.');
            valid = false;
        }

        // Validation de l'email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value)) {
            alert('Veuillez entrer une adresse email valide.');
            valid = false;
        }

        // Validation du sujet
        const sujetRegex = /^[a-zA-Z\s]+$/;
        if (!sujetRegex.test(sujet.value)) {
            alert('Le sujet ne doit contenir que des lettres et des espaces.');
            valid = false;
        }

        // Validation du numéro de téléphone
        const telRegex = /^\d{8}$/;
        if (!telRegex.test(tel.value)) {
            alert('Le numéro de téléphone doit contenir exactement 8 chiffres.');
            valid = false;
        }

        // Validation de la date
        const today = new Date().toISOString().split('T')[0];
        if (date_c.value !== today) {
            alert('La date doit être la date courante.');
            valid = false;
        }

        if (!valid) {
            event.preventDefault();
        }
    });
     // Confirmation de suppression
     const deleteButtons = document.querySelectorAll('.btn-danger');
     deleteButtons.forEach(function(button) {
         button.addEventListener('click', function(event) {
             if (!confirm('Êtes-vous sûr de vouloir supprimer cette réclamation ?')) {
                 event.preventDefault();
             }
         });
     });
});