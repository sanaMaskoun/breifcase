//filtering status document
document.getElementById('statusSearch').addEventListener('input', function () {
    const searchValue = this.value.toLowerCase();
    const cases = document.querySelectorAll('.document-item');

    cases.forEach(caseItem => {
        const statusElement = caseItem.querySelector('.status-consultation');
        const statusText = statusElement.textContent.toLowerCase();

        if (statusText.includes(searchValue)) {
            caseItem.style.display = 'block';
        } else {
            caseItem.style.display = 'none';
        }
        if (searchValue === '') {
            caseItem.style.display = 'block';
        }
    });
});
