function filterCourses() {
    const filter = document.getElementById('categoryFilter').value;
    const courses = document.querySelectorAll('.course');
    courses.forEach(course => {
        if (filter === 'all' || course.getAttribute('data-category') === filter) {
            course.style.display = 'block';
        } else {
            course.style.display = 'none';
        }
    });
}