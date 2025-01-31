document.addEventListener("DOMContentLoaded", () => {
    let currentUserIndex = 0;
    let currentReservationIndex = 0;

    function updateSlide() {
        const userContainers = document.querySelectorAll('.user-container');
        const reservationCards = document.querySelectorAll('.reservation-card');
        
        if (userContainers.length === 0) {
            console.error("Brak użytkowników do wyświetlenia!");
            return;
        }

        userContainers.forEach((userContainer, index) => {
            if (index === currentUserIndex) {
                userContainer.classList.remove('hidden');
            } else {
                userContainer.classList.add('hidden');
            }
        });

        reservationCards.forEach((card, index) => {
            if (index === currentReservationIndex) {
                card.classList.add('active');
            } else {
                card.classList.remove('active');
            }
        });
    }

    function nextUser() {
        const userContainers = document.querySelectorAll('.user-container');
        if (currentUserIndex < userContainers.length - 1) {
            currentUserIndex++;
            currentReservationIndex = 0;
            updateSlide();
        } else {
            console.log("Jesteś na ostatnim użytkowniku.");
        }
    }

    function prevUser() {
        if (currentUserIndex > 0) {
            currentUserIndex--;
            currentReservationIndex = 0;
            updateSlide();
        } else {
            console.log("Jesteś na pierwszym użytkowniku.");
        }
    }

    function nextReservation() {
        const reservationCards = document.querySelectorAll('.reservation-card');
        const userContainers = document.querySelectorAll('.user-container');
        
        if (currentReservationIndex < reservationCards.length - 1) {
            currentReservationIndex++;
            updateSlide();
        } else if (currentReservationIndex === reservationCards.length - 1 && currentUserIndex < userContainers.length - 1) {
            currentUserIndex++;
            currentReservationIndex = 0;
            updateSlide();
        } else {
            console.log("Jesteś na ostatniej rezerwacji i ostatnim użytkowniku.");
        }
    }

    function prevReservation() {
        if (currentReservationIndex > 0) {
            currentReservationIndex--;
            updateSlide();
        } else if (currentReservationIndex === 0 && currentUserIndex > 0) {
            currentUserIndex--;
            currentReservationIndex = document.querySelectorAll('.reservation-card').length - 1;
            updateSlide();
        } else {
            console.log("Jesteś na pierwszej rezerwacji i pierwszym użytkowniku.");
        }
    }

    document.querySelector('.arrow.left').addEventListener('click', () => {
        if (currentReservationIndex > 0) {
            prevReservation();
        } else {
            prevUser();
        }
    });

    document.querySelector('.arrow.right').addEventListener('click', () => {
        if (currentReservationIndex < document.querySelectorAll('.reservation-card').length - 1) {
            nextReservation();
        } else {
            nextUser();
        }
    });

    updateSlide();
});
