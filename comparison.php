<?php
require_once 'autoryzacja.php'; // <-- plik z obiektem $conn do bazy

// Pobranie listy producentów
$sql = "SELECT idProducent, nazwa FROM Phones ORDER BY nazwa ASC";
$res = $conn->query($sql);
$phones = [];
while ($row = $res->fetch_assoc()) {
    $phones[$row['idProducent']] = $row['nazwa'];
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Porównywarka</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/comparison.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
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
        <p>Wybierz maksymalnie 4 producentów, aby porównać narzędzia AI.</p>

        <!-- Lista wszystkich producentów (przycisk +) -->
        <div id="allBrands" class="brand-pool">
            <?php foreach ($phones as $pid => $pname): ?>
                <div class="brand-option" data-id="<?= $pid; ?>">
                    <?= htmlspecialchars($pname); ?>
                    <button class="add-btn">+</button>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Formularz: wysyłamy brand1, brand2, brand3 metodą GET do 'wynik.php' -->
        <form method="GET" action="wynik.php" class="compare-form">
            <input type="hidden" name="brand1" id="brand1" />
            <input type="hidden" name="brand2" id="brand2" />
            <input type="hidden" name="brand3" id="brand3" />
            <input type="hidden" name="brand4" id="brand4" />

            <button type="submit" name="compare" id="compareBtn" class="compare-btn" disabled>Porównaj</button>

            <!-- Poniżej wyświetlą się wybrani producenci (przycisk ×) -->
            <div id="chosenList" class="chosen-list"></div>
        </form>
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

<script src="js/compare.js"></script>
</body>
</html>
