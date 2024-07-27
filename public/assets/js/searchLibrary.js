document.addEventListener('DOMContentLoaded', (event) => {
    const searchInput = document.getElementById('searchBookInput');
    const books = document.querySelectorAll('.book-1');

    searchInput.addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();

        books.forEach(book => {
            const titleElement = book.querySelector('p');
            const titleText = titleElement.textContent.toLowerCase();

            if (titleText.includes(searchValue) || searchValue === '') {
                book.classList.remove('hidden');
            } else {
                book.classList.add('hidden');
            }
        });
    });
});
