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
