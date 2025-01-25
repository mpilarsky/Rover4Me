document.addEventListener("DOMContentLoaded", () => {
    let currentIndex = 0;

    function updateSlide() {
        const cards = document.querySelectorAll('.reservation-card');
        if (cards.length === 0) {
            console.error("Brak kafelków do wyświetlenia!");
            return;
        }

        cards.forEach((card, index) => {
            if (index === currentIndex) {
                card.classList.add('active');
            } else {
                card.classList.remove('active');
            }
        });
    }

    function nextSlide() {
        const cards = document.querySelectorAll('.reservation-card');
        if (currentIndex < cards.length - 1) {
            currentIndex++;
            updateSlide();
        } else {
            console.log("Jesteś na ostatnim kafelku.");
        }
    }

    function prevSlide() {
        if (currentIndex > 0) {
            currentIndex--;
            updateSlide();
        } else {
            console.log("Jesteś na pierwszym kafelku.");
        }
    }

    document.querySelector('.arrow.left').addEventListener('click', prevSlide);
    document.querySelector('.arrow.right').addEventListener('click', nextSlide);

    updateSlide();
});
