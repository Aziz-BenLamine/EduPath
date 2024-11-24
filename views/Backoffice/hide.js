/*document.addEventListener("DOMContentLoaded", function() {
    const hideButtons = document.querySelectorAll('.btn-hide');

    hideButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const row = this.closest('tr');
            const id = row.dataset.id;

            // Envoyer une requête AJAX pour mettre à jour is_visible dans la base de données
            fetch(`hide.php?id=${id}`, {
                method: 'GET'
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                if (data.trim() === 'success') {
                    // Masquer la ligne dans la table
                    row.style.display = 'none';
                } else {
                    console.error('Erreur lors de la mise à jour de la réclamation');
                }
            })
            .catch(error => console.error('Erreur:', error));
        });
    });
});*/