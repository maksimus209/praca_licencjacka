<?php
require_once 'autoryzacja.php'; // łączy z bazą ($conn)

// [1] POBRANIE LISTY PRODUCENTÓW / MODELI (opcjonalnie)
$sql = "SELECT idProducent, nazwa FROM Phones ORDER BY nazwa ASC";
$res = $conn->query($sql);
$phones = [];
while ($row = $res->fetch_assoc()) {
    $phones[$row['idProducent']] = $row['nazwa'];
}

// [2] Sprawdzamy, czy wysłano zapytanie o porównanie
$selectedIDs = []; // przechowa idProducent
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['compare'])) {
    // w formie JSON lub w formie hidden inputów: brand1, brand2, brand3
    $selectedIDs = array_filter([
        $_POST['brand1'] ?? null,
        $_POST['brand2'] ?? null,
        $_POST['brand3'] ?? null
    ]);

    // jeśli >= 2, tworzymy zapytanie
    if (count($selectedIDs) >= 2) {
        $inClause = implode(',', array_map('intval', $selectedIDs));
        $sqlAi = "SELECT * FROM AI_Tools WHERE idProducent IN ($inClause)";
        $rAi = $conn->query($sqlAi);
        $aiRows = [];
        while ($a = $rAi->fetch_assoc()) {
            $aiRows[$a['idProducent']] = $a;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Porównywarka AI w smartfonach</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/comparison.css">
</head>
<body>
<header class="header">
    <div class="container">
        <a href="strona_glowna.html"><img src="photos_licencjat/logo.png" alt="Logo Ai"></a>
        <nav class="nav">
            <ul>
                <li><a href="strona_glowna.html">Strona główna</a></li>
                <li><a href="si.html">SI</a></li>
                <li><a href="producent.html">Producenci</a></li>
                <li><a href="">Forum</a></li>
                <li><a href="serwis.html">O serwisie</a></li>
                <li><a href="">Zaloguj się</a></li>
            </ul>
        </nav>
    </div>
</header>
<section class="comparison">
<div class="compare-container">
    <h1>Smartfony z AI – Porównywarka</h1>
    <p>Wybierz maksymalnie 3 producentów, aby porównać narzędzia AI.</p>

    <!-- Sekcja: Wybór producentów -->
    <form method="POST" class="compare-form">
        <!-- inputy hidden -->
        <input type="hidden" name="brand1" id="brand1" />
        <input type="hidden" name="brand2" id="brand2" />
        <input type="hidden" name="brand3" id="brand3" />

        <div id="chosenList" class="chosen-list">
            <!-- tu wyświetlimy nazwy wybranych producentów -->
        </div>

        <button type="submit" name="compare" id="compareBtn" class="compare-btn" disabled>Porównaj</button>
    </form>

    <!-- Dropdown z listą producentów (początkowo ukryty) -->
    <div id="brandDropdown" class="brand-dropdown">
        <ul>
            <?php foreach ($phones as $pid => $pname): ?>
                <li data-id="<?= $pid; ?>"><?= $pname; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Gdy POST z co najmniej 2 brandami -->
    <?php if (!empty($selectedIDs) && count($selectedIDs)>=2): ?>
        <h2>Wyniki porównania</h2>
        <table class="comparison-table">
            <tr>
                <th>Narzędzie AI</th>
                <?php foreach($selectedIDs as $bid): ?>
                    <th><?= $phones[$bid] ?? '???'; ?></th>
                <?php endforeach; ?>
            </tr>
            <?php
            // załóżmy, że nazwy kolumn w AI_Tools:
            $toolsList = ['asystentGłosowy','anlizaDanych','wspomaganieMultim','edycjaTresc','edycjaMultim','generowanieTresc','generowanieMultim','tlumacz','chatbot'];
            foreach($toolsList as $tool) {
                echo "<tr>";
                echo "<td>$tool</td>";
                foreach($selectedIDs as $bid) {
                    $val = $aiRows[$bid][$tool] ?? '';
                    echo "<td>$val</td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    <?php endif; ?>
</div>
</section>

<script src="js/compare.js"></script>
</body>
</html>
