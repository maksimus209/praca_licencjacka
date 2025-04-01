document.addEventListener("DOMContentLoaded", function () {
    const allBrands = document.getElementById("allBrands");
    const chosenList = document.getElementById("chosenList");
    const compareBtn = document.getElementById("compareBtn");

    const inputs = [
        document.getElementById("brand1"),
        document.getElementById("brand2"),
        document.getElementById("brand3"),
        document.getElementById("brand4")
    ];

    function updateButtonState() {
        const selected = chosenList.querySelectorAll(".chosen-item");
        // Aktywny dopiero, gdy wybrano >= 2
        compareBtn.disabled = selected.length < 2;

        // Ustaw wartości w hidden inputach
        selected.forEach((el, idx) => {
            inputs[idx].value = el.dataset.id || "";
        });

        // Wyczyść pozostałe inputy (gdy < 4 wybranych)
        for (let i = selected.length; i < 4; i++) {
            inputs[i].value = "";
        }
    }

    // Dodawanie producenta do listy wybranych
    allBrands.addEventListener("click", function (e) {
        if (e.target.classList.contains("add-btn")) {
            const brandItem = e.target.parentElement;
            if (chosenList.children.length >= 4) return;

            // Klonujemy element i przerabiamy go na "chosen-item"
            const clone = brandItem.cloneNode(true);
            const id = clone.dataset.id;
            const name = brandItem.textContent.trim().replace("+", "");

            clone.className = "chosen-item";
            clone.dataset.id = id;
            clone.innerHTML = `${name} <button class="remove-btn">×</button>`;
            chosenList.appendChild(clone);

            // Ukryj oryginalny element w górnej liście
            brandItem.style.display = "none";
            updateButtonState();
        }
    });

    // Usuwanie producenta z wybranych
    chosenList.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-btn")) {
            const brandItem = e.target.parentElement;
            const id = brandItem.dataset.id;
            // Przywracamy go w "allBrands"
            const allOption = allBrands.querySelector(`.brand-option[data-id='${id}']`);
            if (allOption) allOption.style.display = "inline-block";
            brandItem.remove();
            updateButtonState();
        }
    });
});
