$(document).ready(function() {
    $('.practice-link').on('click', function(e) {
        e.preventDefault();
        var practiceId = $(this).data('id');
        $.ajax({
            url: '/explore/lawyers',
            type: 'GET',
            data: { practice_id: practiceId },
            success: function(data) {
                $('#lawyer-list').empty();
                $.each(data.lawyers, function(index, lawyer) {
                    var lawyerHtml = '<div class="profile-card col-lg-3 col-md-6 col-sm-12">' +
                                     '<a href="/lawyer/' + lawyer.lawyer_encoded_id + '/show"> <img src="' + lawyer.profile_url + '" alt="Profile" /> </a>' +
                                     '<p>' + lawyer.name + '</p>' +
                                     '</div>';
                    $('#lawyer-list').append(lawyerHtml);
                });
            }
        });
    });
});

const data = [
  { name: "John Doe", profession: "Tax Lawyer" },
  { name: "Jane Smith", profession: "Corporate Lawyer" },
  { name: "Jim Brown", profession: "Tax Lawyer" },
];

document
  .getElementById("search-input")
  .addEventListener("input", function (event) {
    const query = event.target.value.toLowerCase();
    const results = data.filter(
      (item) =>
        item.name.toLowerCase().includes(query) ||
        item.profession.toLowerCase().includes(query)
    );
    displayResults(results);
  });

function displayResults(results) {
  const resultsList = document.getElementById("results-list");
  resultsList.innerHTML = ""; // تفريغ قائمة النتائج
  results.forEach((result) => {
    const listItem = document.createElement("li");
    listItem.textContent = `${result.name} - ${result.profession}`;
    resultsList.appendChild(listItem);
  });
}
