function addNewCategory() {
    document.getElementById('formTitle').textContent = 'Ajouter une Catégorie';
    document.getElementById('categoryModal').style.display = 'block';
    document.getElementById('categoryTitle').value = '';
    document.getElementById('categoryDescription').value = '';
}

function editCategory(categoryTitle) {
    document.getElementById('formTitle').textContent = 'Modifier la Catégorie: ' + categoryTitle;
    document.getElementById('categoryModal').style.display = 'block';
    document.getElementById('categoryTitle').value = categoryTitle;
    document.getElementById('categoryDescription').value = 'Description existante ici';
}

function saveCategory() {
    const title = document.getElementById('categoryTitle').value;
    const description = document.getElementById('categoryDescription').value;
    alert(`Catégorie enregistrée : ${title}`);
    document.getElementById('categoryModal').style.display = 'none';
}

function cancelEdit() {
    document.getElementById('edit').style.display = 'none';
}

function closeModal() {
    document.getElementById('categoryModal').style.display = 'none';
}

function deleteCategory(categoryTitle) {
    if (confirm(`Êtes-vous sûr de vouloir supprimer la catégorie : ${categoryTitle} ?`)) {
        alert(`Catégorie supprimée : ${categoryTitle}`);
    }
}
function showDeleteCategoryModal() {
    document.getElementById('deleteCategoryModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('categoryModal').style.display = 'none';
    document.getElementById('deleteCategoryModal').style.display = 'none';
    document.getElementById('edit').style.display = 'none';
}


function showeditCategory() {
    document.getElementById('edit').style.display = 'block';
        
}

function validateEditCategoryForm() {
    const title = document.getElementById('titre').value;
    const description = document.getElementById('description').value;
    console.log(title);
    console.log(description);
    if (title.trim() === '' || description.trim() === '') {
        alert('Veuillez remplir tous les champs.');
        return false;
    }
    if (/^[^0-9]*$/.test(title)) {
        return true;
    } else {
        alert('Le titre ne doit pas contenir de chiffres.');
        return false;
    }
}


document.getElementById('editCategoryForm').onsubmit = validateEditCategoryForm;

function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('hidden');
    document.querySelector('.content').classList.toggle('shifted');
    document.querySelector('.toggle-btn').classList.toggle('shifted');
    document.querySelector('.toggle-btn').innerHTML = document.querySelector('.sidebar').classList.contains('hidden') ? '&#9654;' : '&#9664;';
}

document.querySelector('.toggle-btn').addEventListener('click', toggleSidebar);