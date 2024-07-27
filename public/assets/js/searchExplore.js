$(document).ready(function() {
    let selectedPracticeIds = [];
    let selectedLanguageIds = [];

    $('.practice-link').on('click', function(e) {
        e.preventDefault();
        var practiceId = $(this).data('id');

        // Toggle selection
        if (selectedPracticeIds.includes(practiceId)) {
            selectedPracticeIds = selectedPracticeIds.filter(id => id !== practiceId);
        } else {
            selectedPracticeIds.push(practiceId);
        }

        fetchLawyers();
    });

    $('.language-link').on('click', function(e) {
        e.preventDefault();
        var languageId = $(this).data('id');

        // Toggle selection
        if (selectedLanguageIds.includes(languageId)) {
            selectedLanguageIds = selectedLanguageIds.filter(id => id !== languageId);
        } else {
            selectedLanguageIds.push(languageId);
        }

        fetchLawyers();
    });

    function fetchLawyers() {
        $.ajax({
            url: '/explore/lawyers',
            type: 'GET',
            data: {
                practices: selectedPracticeIds,
                languages: selectedLanguageIds
            },
            success: function(data) {
                $('#lawyer-list').empty();
                if (data.lawyers.length > 0) {
                    $.each(data.lawyers, function(index, lawyer) {
                        var lawyerHtml = '<div class="profile-card col-lg-3 col-md-6 col-sm-12">' +
                                         '<a class="link-in-explore-page" href="/lawyer/' + lawyer.encoded_id + '">' +
                                         '<img src="' + lawyer.profile_url + '" alt="Profile" />' +
                                         '<p class="name-in-explore-page">' + lawyer.name + '</p>' +
                                         '</a></div>';
                        $('#lawyer-list').append(lawyerHtml);
                    });
                } else {
                    $('#lawyer-list').append('<p>No lawyers found.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
});








$(document).ready(function() {
    let selectedLanguageIds = []; // قائمة بمعرفات اللغات المختارة

    $('.language-filter').on('change', function() {
        selectedLanguageIds = []; // إعادة تعيين قائمة اللغات المختارة

        $('.language-filter:checked').each(function() {
            selectedLanguageIds.push($(this).data('id'));
        });

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
                        var companyHtml = '<div class="profile-card col-lg-3 col-md-6 col-sm-12">' +
                                         '<img src="' + company.profile_url + '" alt="Profile" />' +
                                         '<p>' + company.name + '</p>' +
                                         '</div>';
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
