    document.getElementById('clientSearch').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const clients = document.querySelectorAll('.client-card');

        clients.forEach(client => {
            const nameElement = client.querySelector('.client-name');
            const statusElement = client.querySelector('.client-status');
            const nameText = nameElement.textContent.toLowerCase();
            const statusText = statusElement.textContent.toLowerCase();

            if (nameText.includes(searchValue) || statusText.includes(searchValue) || searchValue === '') {
                client.style.display = 'block';
            } else {
                client.style.display = 'none';
            }
        });
    });
