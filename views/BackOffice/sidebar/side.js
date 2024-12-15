document.querySelector('.toggle-btn').addEventListener('click', () => {
    document.querySelector('.sidebar').classList.toggle('hidden');
    document.querySelector('.content').classList.toggle('shifted');
    document.querySelector('.toggle-btn').classList.toggle('shifted');
    document.querySelector('.toggle-btn').innerHTML = document.querySelector('.sidebar').classList.contains('hidden') ? '&#9654;' : '&#9664;';
    document.querySelector('.toggle-btn').addEventListener('click', function () {
        const sidebar = document.querySelector('.sidebar');
        const content = document.querySelector('.content');
        const toggleBtn = document.querySelector('.toggle-btn');
    
        if (sidebar.style.marginLeft === '-250px') {
            // Show the sidebar
            sidebar.style.marginLeft = '0';
            content.style.marginLeft = '250px';
            toggleBtn.style.left = '250px';
        } else {
            // Hide the sidebar
            sidebar.style.marginLeft = '-250px';
            content.style.marginLeft = '0';
            toggleBtn.style.left = '0';
        }
    });
    
});