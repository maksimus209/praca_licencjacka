// Pobieranie przycisku
const scrollToTopBtn = document.getElementById('scrollToTopBtn');

// Funkcja do wyświetlania/ukrywania przycisku
window.onscroll = function() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        scrollToTopBtn.style.display = "block"; // Pokazujemy przycisk, gdy przewinięto w dół
    } else {
        scrollToTopBtn.style.display = "none"; // Ukrywamy przycisk, gdy jesteśmy na górze strony
    }
};

// Funkcja do przewijania na górę po kliknięciu
scrollToTopBtn.onclick = function() {
    window.scrollTo({ top: 0, behavior: 'smooth' }); // Płynne przewijanie do góry
};


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


