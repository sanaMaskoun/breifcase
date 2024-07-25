document.getElementById('companySearch').addEventListener('input', function() {
    const searchValue = this.value.toLowerCase();
    const companies = document.querySelectorAll('.company-card');

    companies.forEach(company => {
        const nameElement = company.querySelector('.company-name');
        const statusElement = company.querySelector('.company-status');
        const nameText = nameElement.textContent.toLowerCase();
        const statusText = statusElement.textContent.toLowerCase();

        if (nameText.includes(searchValue) || statusText.includes(searchValue) || searchValue === '') {
            company.style.display = 'block';
        } else {
            company.style.display = 'none';
        }
    });
});
