document.addEventListener("DOMContentLoaded", () => {
    const brandDropdown = document.getElementById("brandDropdown");
    const brandListItems = brandDropdown.querySelectorAll("li");

    const chosenList = document.getElementById("chosenList");
    const compareBtn = document.getElementById("compareBtn");
    const brandInputs = ["brand1","brand2","brand3"];

    let chosenCount = 0;

    // Domyślnie pokazujemy brandDropdown (lub z przyciskiem "Wybierz markę")
    brandDropdown.style.display = "block";

    // Kiedy klikamy w li, dodajemy do chosenList (o ile <3)
    brandListItems.forEach(li => {
        li.addEventListener("click", () => {
            if (chosenCount < 3) {
                // 1) Dodaj do chosenList (HTML)
                const brandName = li.textContent;
                const brandID = li.dataset.id;

                // Tworzymy element w chosenList
                const div = document.createElement("div");
                div.classList.add("chosen-item");
                div.textContent = brandName;

                // Ewentualnie przycisk do usunięcia (X)
                const removeBtn = document.createElement("button");
                removeBtn.textContent = "X";
                removeBtn.style.marginLeft = "10px";
                removeBtn.addEventListener("click", () => {
                    // usuwamy z chosenList
                    chosenList.removeChild(div);
                    // usuwamy z hidden input
                    removeBrand(brandID);
                    // pokazujemy li ponownie
                    li.style.display = "block";
                    chosenCount--;
                    checkCompareBtn();
                });
                div.appendChild(removeBtn);
                chosenList.appendChild(div);

                // 2) Ustaw w hidden inputach
                setNextAvailableBrandInput(brandID);

                // 3) chowamy li z dropdowna, by nie wybierać ponownie
                li.style.display = "none";
                chosenCount++;

                checkCompareBtn();
            }
        });
    });

    function setNextAvailableBrandInput(id) {
        for(let i=0; i<brandInputs.length; i++){
            const inp = document.getElementById(brandInputs[i]);
            if(!inp.value) {
                inp.value = id;
                break;
            }
        }
    }

    function removeBrand(id) {
        // znajdź w brandInputs, który input ma taką wartość i wyczyść
        for(let i=0; i<brandInputs.length; i++){
            const inp = document.getElementById(brandInputs[i]);
            if(inp.value === id) {
                inp.value = "";
                break;
            }
        }
    }

    function checkCompareBtn() {
        // jeśli co najmniej 2 brandy => compareBtn.enabled
        let filledCount = 0;
        for(let i=0; i<brandInputs.length; i++){
            if(document.getElementById(brandInputs[i]).value) {
                filledCount++;
            }
        }
        compareBtn.disabled = (filledCount < 2);
    }
});
