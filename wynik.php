<?php
require_once 'autoryzacja.php'; // <-- plik z obiektem $conn do bazy

// Odczyt wybranych producentów z GET
$selectedIDs = array_filter([
    $_GET['brand1'] ?? null,
    $_GET['brand2'] ?? null,
    $_GET['brand3'] ?? null,
    $_GET['brand4'] ?? null
]);

// Pobranie listy producentów (by wyświetlić ich nazwy)
$phones = [];
$sql = "SELECT idProducent, nazwa FROM Phones";
$res = $conn->query($sql);
while ($row = $res->fetch_assoc()) {
    $phones[$row['idProducent']] = $row['nazwa'];
}

// Pobranie informacji o narzędziach AI
$aiRows = [];
if (count($selectedIDs) >= 2) {
    $inClause = implode(',', array_map('intval', $selectedIDs));
    // Upewnij się, że tabela AI_Tools istnieje i ma odpowiednie kolumny
    $sqlAi = "SELECT * FROM AI_Tools WHERE idProducent IN ($inClause)";
    $result = $conn->query($sqlAi);

    while ($row = $result->fetch_assoc()) {
        $aiRows[$row['idProducent']] = $row;
    }
}

// Lista dostępnych pól w tabeli (dostosuj do swojej bazy!)
$toolsList = [
    'asystentGłosowy',
    'anlizaDanych',
    'wspomaganieMultim',
    'edycjaTresc',
    'edycjaMultim',
    'generowanieTresc',
    'generowanieMultim',
    'tlumacz',
    'chatbot'
];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wyniki porównania</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/wynik.css">
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

<section class="comparison-results">
    <div class="container">
        <h1>Wyniki porównania funkcji AI</h1>

        <div class="buttons-row">
            <a href="comparison.php" class="btn-clear">Wyczyść i wybierz ponownie</a>
        </div>

        <?php if (count($selectedIDs) < 2): ?>
            <!-- Jeśli użytkownik trafił tu bez minimum 2 producentów -->
            <p class="empty">
                Nie wybrałeś wystarczającej liczby producentów.
                <a href="comparison.php" style="color: #2c4794; font-weight: bold;">Powrót do porównywarki</a>
            </p>
        <?php else: ?>
            <!-- Wyświetlamy wyniki w formie listy (lub możesz to zmienić w tabelę) -->
            <div class="wynik-tabela">
                <?php foreach ($toolsList as $tool): ?>
                    <div class="tool-row">
                        <strong><?= ucfirst($tool); ?></strong>
                        <?php foreach ($selectedIDs as $pid): ?>
                            <?php
                            $nazwaProducenta = $phones[$pid] ?? '???';
                            $val = $aiRows[$pid][$tool] ?? '-';
                            ?>
                            <span>
                                <?= htmlspecialchars($nazwaProducenta) ?>:
                                <b><?= htmlspecialchars($val) ?></b>
                            </span>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="buttons-row bottom">
                <a href="comparison.php" class="btn-clear">Wyczyść i wybierz ponownie</a>
            </div>

        <?php endif; ?>
    </div>
</section>

<!-- Przycisk "Scroll To Top" inspirowany stylem z uiverse.io -->
<button class="scroll-button" id="scrollButton" onclick="scrollToTop()">
    <svg width="24" height="24" viewBox="0 0 24 24">
        <path d="M12 4l-8 8h16z"/>
    </svg>
</button>


<footer class="footer">
    <div class="container">
        <p>&copy; 2025 Smartfony z SI - Praca licencjacka</p>
    </div>
</footer>

</body>
</html>
