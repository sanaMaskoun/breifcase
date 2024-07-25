document.getElementById('statusSearch').addEventListener('input', function() {
    const searchValue = this.value.toLowerCase();
    const users = document.querySelectorAll('.user-card');

    users.forEach(user => {
        const nameElement = user.querySelector('.user-name');
        const nameText = nameElement.textContent.toLowerCase();

        if (nameText.includes(searchValue) || searchValue === '') {
            user.style.display = 'block';
        } else {
            user.style.display = 'none';
        }
    });
});

