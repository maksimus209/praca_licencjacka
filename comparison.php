<?php
require_once 'autoryzacja.php'; // plik łączący z bazą danych

// 1) Pobierz wszystkie marki z bazy
$sql = "SELECT idProducent, nazwa FROM AI_Tools ORDER BY nazwa";
$result = $conn->query($sql);
$brands = [];
while($row = $result->fetch_assoc()) {
    $brands[$row['idProducent']] = $row['nazwa'];
}

// 2) Obsługa formularza – gdy klikamy „Porównaj”
$selectedBrands = []; // przechowa idProducent dla wybranych marek
$comparisonTable = null; // ewentualnie zmienna do przechowywania danych AI

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['compare'])) {
    // Wybrane marki, np. brand1, brand2, brand3
    $selectedBrands = array_filter([
        $_POST['brand1'] ?? null,
        $_POST['brand2'] ?? null,
        $_POST['brand3'] ?? null
    ]);

    // Maksymalnie 3 marki, conajmniej 2
    if (count($selectedBrands) >= 2) {
        // Pobierz nazwy narzędzi z AI_Tools
        // (Załóżmy, że mamy w bazie kolumny asystentGłosowy, analizaDanych itd.)
        // lub dynamicznie z innej tabeli Tools -> przerabiamy do wyświetlenia.

        // Tworzymy dynamiczne zapytanie
        // Zakładamy, że w AI_Tools mamy 1 rekord = 1 producent, kolumny to narzędzia
        $inClause = implode(',', array_map('intval', $selectedBrands));
        $sqlAi = "SELECT * FROM AI_Tools WHERE idProducent IN ($inClause)";
        $resultAi = $conn->query($sqlAi);
        $rowsAi = [];
        while($rowAi = $resultAi->fetch_assoc()) {
            $rowsAi[$rowAi['idProducent']] = $rowAi;
        }
        // $rowsAi będzie tablicą [idProducent => [nazwa => ..., asystentGłosowy => ..., ...]]

        $comparisonTable = $rowsAi;
    }
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Porównywarka smartfonów z AI</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/comparison.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

</head>
<body>

<h1>Smartfony z AI – Porównywarka</h1>
<p>Wybierz maksymalnie 3 marki, aby porównać dostępne w nich narzędzia AI.</p>

<form method="POST" action="">
    <!-- Pola ukryte / inputy, w których będziemy zapisywać wybór z JavaScript -->
    <input type="hidden" name="brand1" id="brand1" />
    <input type="hidden" name="brand2" id="brand2" />
    <input type="hidden" name="brand3" id="brand3" />

    <!-- Przycisk Porównaj (pojawia się, gdy co najmniej 2 brandy są wybrane) -->
    <button type="submit" name="compare" id="compareBtn" disabled>Porównaj</button>
</form>

<!-- Tutaj lista marek / dropdown / okienko z JS -->
<div id="brandDropdown" style="border:1px solid #ccc; width:200px; display:none;">
    <ul>
        <?php foreach($brands as $id => $nazwa): ?>
            <li data-id="<?= $id; ?>"><?= $nazwa; ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<!-- Sekcja z wynikami porównania -->
<?php if ($comparisonTable): ?>
    <h2>Wyniki porównania</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Narzędzie AI</th>
            <!-- Nagłówki dla wybranych marek -->
            <?php foreach($selectedBrands as $bid): ?>
                <th><?= $brands[$bid]; ?></th>
            <?php endforeach; ?>
        </tr>

        <?php
        // Tutaj statycznie wymieniamy nazwy kolumn np. asystentGłosowy, analizaDanych...
        $toolsList = ['asystentGłosowy','analizaDanych','wspomaganieMultim','edycjaTresc','edycjaMultim','generowanieTresc','generowanieMultim','tlumacz','chatboty'];

        foreach($toolsList as $tool) {
            echo "<tr>";
            echo "<td>$tool</td>";
            foreach($selectedBrands as $bid) {
                // Czy w kolumnie jest "Tak", "Nie", "Specyficzne" etc.
                $val = isset($comparisonTable[$bid][$tool]) ? $comparisonTable[$bid][$tool] : '';
                echo "<td>$val</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
<?php endif; ?>

<script>
    // Pseudokod - po kliknięciu w "Wybierz markę..." otwieramy listę marek
    // Gdy user kliknie na markę, wypełniamy kolejne wolne input brand1/brand2/brand3
    // Gdy min. 2 brandy, włączamy compareBtn

    // Prosty przykład:
    const brandInputs = ['brand1','brand2','brand3'];
    let brandIndex = 0; // wskaźnik kolejnego brandu

    document.getElementById('brandDropdown').style.display = 'block'; // np. testowo

    // Przycisk compare
    const compareBtn = document.getElementById('compareBtn');
    const lis = document.querySelectorAll('#brandDropdown ul li');

    lis.forEach(li => {
        li.addEventListener('click', () => {
            if (brandIndex < 3) {
                // Ustawiamy w brandX
                let hiddenInput = document.getElementById(brandInputs[brandIndex]);
                hiddenInput.value = li.dataset.id;

                brandIndex++;
                li.style.display = 'none'; // ukryj wybraną markę (by nie wybierać jej jeszcze raz)

                // Jeśli brandIndex >= 2 => włącz compareBtn
                if (brandIndex >= 2) {
                    compareBtn.disabled = false;
                }
            }
        });
    });
</script>

</body>
</html>
