document.addEventListener('DOMContentLoaded', (event) => {
    function updateRating(starElement, inputId) {
        const value = starElement.getAttribute('data-value');
        const ratingInput = document.getElementById(inputId);
        ratingInput.value = value;

        const stars = starElement.parentElement.querySelectorAll('.star');
        stars.forEach(s => {
            s.classList.remove('highlight');
        });

        for (let i = 0; i < value; i++) {
            stars[i].classList.add('highlight');
        }
    }

    const ratings = ['communication', 'response_time', 'problem_solving', 'understanding'];
    ratings.forEach(rating => {
        const stars = document.querySelectorAll(`#${rating}-rating .star`);
        stars.forEach(star => {
            star.addEventListener('click', function() {
                updateRating(this, rating);
            });
        });
    });
});
