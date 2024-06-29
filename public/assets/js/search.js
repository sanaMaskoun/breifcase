//Filtering lawyers
$(document).ready(function() {
    let selectedPracticeId = null;
    let selectedLanguageId = null;

    $('.practice-link').on('click', function(e) {
        e.preventDefault();
        var practiceId = $(this).data('id');

        if (selectedPracticeId === practiceId) {
            selectedPracticeId = null;
        } else {
            selectedPracticeId = practiceId;
        }

        fetchLawyers();
    });

    $('.language-link').on('click', function(e) {
        e.preventDefault();
        var languageId = $(this).data('id');

        if (selectedLanguageId === languageId) {
            selectedLanguageId = null;
        } else {
            selectedLanguageId = languageId;
        }

        fetchLawyers();
    });

    function fetchLawyers() {
        $.ajax({
            url: '/explore/lawyers',
            type: 'GET',
            data: { practice_id: selectedPracticeId, language_id: selectedLanguageId },
            success: function(data) {
                $('#lawyer-list').empty();
                if (data.lawyers.length > 0) {
                    $.each(data.lawyers, function(index, lawyer) {
                        var lawyerHtml = '<div class="profile-card col-lg-3 col-md-6 col-sm-12">' +
                                         '<a class="link-in-explore-page" href="/lawyer/' + lawyer.lawyer_encoded_id + '/show"> <img src="' + lawyer.profile_url + '" alt="Profile" /> ' +
                                         '<p class="name-in-explore-page">' + lawyer.name + '</p> </a>' +
                                         '</div>';
                        $('#lawyer-list').append(lawyerHtml);
                    });
                } else {
                    $('#lawyer-list').append('<p>No lawyers found.</p>');
                }
            }
        });
    }
});

//Filtering translation companies
$(document).ready(function() {
    let selectedLanguageIds = [];
    $('.language-filter').on('click', function(e) {
        e.preventDefault();
        var languageId = $(this).data('id');
        if (selectedLanguageIds.includes(languageId)) {
            selectedLanguageIds = selectedLanguageIds.filter(id => id !== languageId);
        } else {
            selectedLanguageIds.push(languageId);
        }

        fetchCompanies();
    });

    function fetchCompanies() {
        $.ajax({
            url: '/explore/translation-companies',
            type: 'GET',
            data: { languages: selectedLanguageIds },
            success: function(data) {
                $('#company-list').empty();
                if (data.translation_companies.length > 0) {
                    $.each(data.translation_companies, function(index, company) {
                        var companyHtml = '<div class="col-lg-3 col-md-6 col-sm-12">' +
                                          '<div class="profile-card_1">' +
                                          '<a class="link-in-explore-page" href="/translation-company/' + company.company_encoded_id + '/show"> <img src="' + company.profile_url + '" alt="Profile" /> ' +
                                         '<p class="name-in-explore-page">' + company.name + '</p> </a>' +
                                         '</div>'
                                         '</div>'
                                         ;
                        $('#company-list').append(companyHtml);
                    });
                } else {
                    $('#company-list').append('<p>No companies found.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
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
