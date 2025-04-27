<?php
require_once 'autoryzacja.php';

// Odczyt wybranych producentów z GET
$selectedIDs = array_filter([
    $_GET['brand1'] ?? null,
    $_GET['brand2'] ?? null,
    $_GET['brand3'] ?? null,
    $_GET['brand4'] ?? null
]);

// Pobranie listy producentów
$phones = [];
$sql = "SELECT idProducent, nazwa FROM Phones";
$res = $conn->query($sql);
while ($row = $res->fetch_assoc()) {
    $phones[$row['idProducent']] = $row['nazwa'];
}

// Pobranie danych AI
$aiRows = [];
if (count($selectedIDs) >= 2) {
    $inClause = implode(',', array_map('intval', $selectedIDs));
    $sqlAi = "SELECT * FROM AI_Tools WHERE idProducent IN ($inClause)";
    $result = $conn->query($sqlAi);
    while ($row = $result->fetch_assoc()) {
        $aiRows[$row['idProducent']] = $row;
    }
}

// Lista narzędzi
$toolsList = [
    'asystentGłosowy' => 'Asystent głosowy',
    'anlizaDanych' => 'Analiza danych',
    'wspomaganieMultim' => 'Wspomaganie multimediów',
    'edycjaTresc' => 'Edycja treści',
    'edycjaMultim' => 'Edycja multimediów',
    'generowanieTresc' => 'Generowanie treści',
    'generowanieMultim' => 'Generowanie multimediów',
    'tlumacz' => 'Live Tłumacze',
    'chatbot' => 'Chatboty'
];

// Opisy narzędzi
$toolDescriptions = [
    'asystentGłosowy' => "Zapewniają wykonywanie poleceń głosowych i prowadzenie rozmów w języku naturalnym.",
    'anlizaDanych' => "Pozwalają na analizę scen, twarzy i danych w czasie rzeczywistym dla wygody i bezpieczeństwa.",
    'wspomaganieMultim' => "Ulepszają dźwięk i obraz podczas nagrywania i odtwarzania multimediów.",
    'edycjaTresc' => "Pomagają poprawiać, streszczać lub parafrazować tekst w komunikatorach i dokumentach.",
    'edycjaMultim' => "Służą do retuszowania zdjęć i filmów oraz dodawania efektów w czasie rzeczywistym.",
    'generowanieTresc' => "Umożliwiają tworzenie treści tekstowych na podstawie krótkich poleceń użytkownika.",
    'generowanieMultim' => "Pozwalają generować grafiki i obrazy z wykorzystaniem sztucznej inteligencji.",
    'tlumacz' => "Umożliwiają tłumaczenie mowy lub tekstu w czasie rzeczywistym w różnych językach.",
    'chatbot' => "Prowadzą rozmowy i odpowiadają na pytania użytkownika w formie czatu."
];
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wyniki porównania</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/wynik.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
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
        <div class="head">
        <h1>Wyniki porównania funkcji AI</h1>

        <div class="buttons-row">
            <a href="comparison.php" class="btn-clear">Wyczyść i wybierz ponownie</a>
        </div>
        </div>

        <?php if (count($selectedIDs) < 2): ?>
            <p class="empty">Nie wybrałeś wystarczającej liczby producentów.
                <a href="comparison.php" style="color: #2c4794; font-weight: bold;">Powrót do porównywarki</a>
            </p>
        <?php else: ?>
            <div class="legend-info">
                <h2>Oznaczenia w tabelach</h2>
                <ul>
                    <li><b>Tak</b> – Funkcja jest w pełni dostępna i działa bez ograniczeń na całym świecie.</li>
                    <li><b>Nie</b> – Funkcja nie jest dostępna w systemach operacyjnych danej marki smartfonów.</li>
                    <li><b>Częściowo</b> – Funkcja jest dostępna, ale dla małej ilości smartfonów lub tylko w określonych regionach.</li>
                    <li><b>Ograniczone</b> – Funkcja działa, ale w formie beta lub jej funkcjonalność jest ograniczona od pierwotnie zapowiedzianej wersji.</li>
                    <li><b>Specyficzne dla rynku</b> – Funkcja jest dostępna, ale różni się sposób jej działania w zależności od rynku, zgodnie z polityką producenta.</li>
                </ul>
            </div>

            <div class="filter-tools">
                <div class="filter-list">
                    <?php foreach ($toolsList as $column => $label): ?>
                        <label>
                            <input type="checkbox" class="tool-filter" value="<?= $column ?>">
                            <?= htmlspecialchars($label) ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="wynik-tabela">
                <?php foreach ($toolsList as $column => $label): ?>
                    <div class="tool-row" data-tool="<?= $column ?>">
                        <h2 class="ai-heading"><?= htmlspecialchars($label) ?></h2>
                        <p class="tool-description"><?= $toolDescriptions[$column] ?? '' ?></p>
                        <table class="ai-table">
                            <thead>
                            <tr>
                                <?php foreach ($selectedIDs as $pid): ?>
                                    <th><?= htmlspecialchars($phones[$pid] ?? '???') ?></th>
                                <?php endforeach; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php foreach ($selectedIDs as $pid): ?>
                                    <td><strong><?= htmlspecialchars($aiRows[$pid][$column] ?? '-') ?></strong></td>
                                <?php endforeach; ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="buttons-row bottom">
                <a href="comparison.php" class="btn-clear">Wyczyść i wybierz ponownie</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <p>&copy; 2025 Smartfony z SI - Praca licencjacka</p>
    </div>
</footer>

<script>
    const checkboxes = document.querySelectorAll('.tool-filter');
    const toolRows = document.querySelectorAll('.tool-row');

    function updateVisibility() {
        const checked = Array.from(checkboxes).filter(ch => ch.checked).map(ch => ch.value);
        if (checked.length === 0) {
            toolRows.forEach(row => row.style.display = 'block');
        } else {
            toolRows.forEach(row => {
                if (checked.includes(row.dataset.tool)) {
                    row.style.display = 'block';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    }

    checkboxes.forEach(ch => {
        ch.addEventListener('change', updateVisibility);
    });

    updateVisibility();
</script>
</body>
</html>
