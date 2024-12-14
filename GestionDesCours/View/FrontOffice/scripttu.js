function addNewCourse() {
    document.getElementById('formTitle').textContent = 'Ajouter un Cours';
    document.getElementById('courseForm').style.display = 'block';
}

function editCourse(courseTitle) {
    document.getElementById('formTitle').textContent = 'Modifier le Cours: ' + courseTitle;
    document.getElementById('courseForm').style.display = 'block';
    document.getElementById('courseTitle').value = courseTitle;
    document.getElementById('courseDescription').value = 'Description du cours ici';
    document.getElementById('courseLevel').value = 'Débutant';
    document.getElementById('coursePrice').value = 'Gratuit';
}

function saveCourse() {
    const title = document.getElementById('courseTitle').value;
    const description = document.getElementById('courseDescription').value;
    const level = document.getElementById('courseLevel').value;
    const price = document.getElementById('coursePrice').value;
    alert(`Cours enregistré : ${title}`);
    document.getElementById('courseForm').style.display = 'none';
}

function cancelAdd() {
    document.getElementById('courseForm').style.display = 'none';
}
function cancelDelete() {
    document.getElementById('deleteCourseForm').style.display = 'none';
}
function cancelEdit() {
    document.getElementById('editCourseForm').style.display = 'none';
}

function showDeleteCourseModal() {
    document.getElementById('deleteCourseForm').style.display = 'block';

}

function showEditCourse() {
    document.getElementById('editCourseForm').style.display = 'block';

}