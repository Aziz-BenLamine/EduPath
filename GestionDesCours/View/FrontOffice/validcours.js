document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editCourseForm');

    form.addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });

    function validateForm() {
        const title = document.getElementById('courseTitle').value.trim();
        const description = document.getElementById('courseDescription').value.trim();
        const level = document.getElementById('courseLevel').value;
        const price = document.getElementById('coursePrice').value.trim();

        if (title === '') {
            alert('Le titre du cours est requis.');
            return false;
        }

        if (/\d/.test(title)) {
            alert('Le titre du cours ne doit pas contenir de chiffres.');
            return false;
        }

        if (description === '') {
            alert('La description du cours est requise.');
            return false;
        }

        if (level === '') {
            alert('Le niveau du cours est requis.');
            return false;
        }

        if (price === '' || isNaN(price) || parseFloat(price) <= 0) {
            alert('Le prix du cours doit être un nombre positif.');
            return false;
        }

        return true;
    }

    document.getElementById("editCourseForm").onsubmit = validateForm;
});