function validateForm() {
    
    const question = document.getElementById('question').value.trim();
    const typeq = document.getElementById('typeq').value.trim();

    if (!question || question.length < 5) {
        alert("L'énoncé doit contenir au moins 5 caractères.");
        return false;
    }

    if (!typeq) {
        alert("Veuillez sélectionner un type de question.");
        return false;
    }

    return true;
}