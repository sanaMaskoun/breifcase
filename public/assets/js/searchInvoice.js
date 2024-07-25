    document.getElementById('statusSearch').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const bills = document.querySelectorAll('.bill-card');

        bills.forEach(bill => {
            const statusElement = bill.querySelector('.status-bills');
            const statusText = statusElement.textContent.toLowerCase();

            if (statusText.includes(searchValue) || searchValue === '') {
                bill.style.display = 'block';
            } else {
                bill.style.display = 'none';
            }
        });
    });
