//Filtering lawyers
document.getElementById('lawyerSearch').addEventListener('input', function() {
    const searchValue = this.value.toLowerCase();
    const lawyers = document.querySelectorAll('.lawyer-card');

    lawyers.forEach(lawyer => {
        const nameElement = lawyer.querySelector('.lawyer-name');
        const nameText = nameElement.textContent.toLowerCase();

        if (nameText.includes(searchValue) || searchValue === '') {
            lawyer.style.display = 'block';
        } else {
            lawyer.style.display = 'none';
        }
    });
});




// const data = [
//   { name: "John Doe", profession: "Tax Lawyer" },
//   { name: "Jane Smith", profession: "Corporate Lawyer" },
//   { name: "Jim Brown", profession: "Tax Lawyer" },
// ];

// document
//   .getElementById("search-input")
//   .addEventListener("input", function (event) {
//     const query = event.target.value.toLowerCase();
//     const results = data.filter(
//       (item) =>
//         item.name.toLowerCase().includes(query) ||
//         item.profession.toLowerCase().includes(query)
//     );
//     displayResults(results);
//   });

// function displayResults(results) {
//   const resultsList = document.getElementById("results-list");
//   resultsList.innerHTML = ""; // تفريغ قائمة النتائج
//   results.forEach((result) => {
//     const listItem = document.createElement("li");
//     listItem.textContent = `${result.name} - ${result.profession}`;
//     resultsList.appendChild(listItem);
//   });
// }
