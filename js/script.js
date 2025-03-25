// Funkcja do płynnego przewijania do góry
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
}

// Opcjonalnie: pokazuj / ukrywaj przycisk w zależności od scrolla
window.addEventListener("scroll", function() {
    const scrollButton = document.getElementById("scrollButton");
    if (window.scrollY > 300) {
        scrollButton.classList.remove("hidden");
    } else {
        scrollButton.classList.add("hidden");
    }
});



document.addEventListener('DOMContentLoaded', () => {
    const containers = document.querySelectorAll('.hidden');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show'); // Dodajemy klasę, aby wywołać animację
                observer.unobserve(entry.target); // Przestajemy obserwować element, aby animacja działała tylko raz
            }
        });
    }, {
        threshold: 0.1 // Procent widoczności elementu, który wyzwala pojawienie się
    });

    containers.forEach(container => {
        observer.observe(container);
    });
});

/* Funkcja animująca licznik od start do end w ciągu duration ms */
function animateValue(element, start, end, duration) {
    let startTime = null;

    function animation(currentTime) {
        if (startTime === null) {
            startTime = currentTime;
        }
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const currentValue = Math.floor(start + (end - start) * progress);

        // Separator tysięcy (lokalizacja PL)
        element.textContent = currentValue.toLocaleString("pl-PL");

        if (progress < 1) {
            requestAnimationFrame(animation);
        }
    }

    requestAnimationFrame(animation);
}

document.addEventListener("DOMContentLoaded", () => {
    const countElement = document.getElementById("smartphoneCount");
    const mainSection = document.querySelector(".count");
    let hasAnimated = false;  // flaga, by licznik nie uruchomił się wielokrotnie

    // Tworzymy Intersection Observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            // Jeżeli sekcja jest w polu widzenia i animacja nie była jeszcze uruchomiona
            if (entry.isIntersecting && !hasAnimated) {
                animateValue(countElement, 0, 4500000000, 2000);
                hasAnimated = true;
                // Odpinamy obserwację, aby animacja była jednokrotna
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.2 // musi być widoczne min. 20% sekcji, żeby wystartować
    });

    // Rozpoczynamy obserwację sekcji .count
    observer.observe(mainSection);
});



document.addEventListener("DOMContentLoaded", () => {
    const wrapper = document.querySelector(".tools-slider-wrapper");
    const leftBtn = document.querySelector(".slider-btn-left");
    const rightBtn = document.querySelector(".slider-btn-right");
    const slides = document.querySelectorAll(".tool-card");
    let currentIndex = 0;
    const totalSlides = slides.length;

    // Obsługa kliknięcia lewej strzałki
    leftBtn.addEventListener("click", () => {
        // Zmniejszamy index (przesuwamy wstecz), ale nie pozwalamy spaść poniżej 0
        currentIndex = Math.max(currentIndex - 1 + totalSlides) % totalSlides;
        updateSlider();
    });

    // Obsługa kliknięcia prawej strzałki
    rightBtn.addEventListener("click", () => {
        // Zwiększamy index, nie przekraczamy totalSlides - 1
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlider();
    });

    function updateSlider() {
        // Każda karta ma szerokość 100%, więc przesuwamy wrapper o (currentIndex * -100%)
        wrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
    }
});


