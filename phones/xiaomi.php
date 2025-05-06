<?php
require_once '../autoryzacja.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Pobierz dane Xiaomi (przyjmijmy id = 4)
$sql = "SELECT * FROM Phones WHERE idProducent =3";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $xiaomi = $result->fetch_assoc();
} else {
    die("Nie znaleziono producenta.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($xiaomi['nazwa']) ?> – informacje o producencie</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/smartphone.css">
</head>
<body>

<header class="header">
    <div class="container">
        <a href="../strona_glowna.html"><img src="../photos_licencjat/logo.png" alt="Logo Xiaomi"></a>
        <nav class="nav">
            <ul>
                <li><a href="../strona_glowna.html">Strona główna</a></li>
                <li><a href="../si.html">SI</a></li>
                <li><a href="../producent.html">Producenci</a></li>
                <li><a href="">Forum</a></li>
                <li><a href="../serwis.html">O serwisie</a></li>
                <li><a href="">Zaloguj się</a></li>
            </ul>
        </nav>
    </div>
</header>

<section class="producer-intro">
    <div class="intro-box">
        <div class="intro-wrapper">
            <div class="intro-image">
                <img src="../photos_licencjat/xiaomi/xiaomi_logo.png" alt="Xiaomi">
            </div>
            <div class="intro-text">
                <h2><?= htmlspecialchars($xiaomi['nazwa']) ?></h2>
                <ul class="producer-data">
                    <li><strong>Kraj:</strong> <?= htmlspecialchars($xiaomi['panstwo']) ?></li>
                    <li><strong>Rok powstania:</strong> <?= htmlspecialchars($xiaomi['rokPowstania']) ?></li>
                    <li><strong>Pierwszy smartfon:</strong> <?= htmlspecialchars($xiaomi['pierwszySmartphone']) ?></li>
                    <li><strong>Udział globalny:</strong> <?= htmlspecialchars($xiaomi['procentGlob']) ?>%</li>
                    <li><strong>Udział w Polsce:</strong> <?= htmlspecialchars($xiaomi['procentPoland']) ?>%</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="content-block">
    <h2>O firmie Xiaomi</h2>
    <p>Xiaomi to chiński producent elektroniki założony w 2010 roku, który bardzo szybko stał się jednym z liderów rynku smartfonów. Marka zyskała popularność dzięki oferowaniu wysokiej jakości urządzeń w konkurencyjnych cenach. Xiaomi rozwija także własny ekosystem smart home oraz wprowadza do swoich smartfonów innowacyjne rozwiązania z zakresu AI i fotografii mobilnej. Ich flagowe modele, takie jak Xiaomi 14 czy MIX Fold, stanowią przykład integracji najnowszych technologii.</p>
</section>

<section class="content-block">
    <h2>Rozwój sztucznej inteligencji</h2>
    <p>Xiaomi intensywnie inwestuje w rozwój sztucznej inteligencji, szczególnie w zakresie fotografii, rozpoznawania głosu oraz zarządzania systemem. W 2024 roku firma zaprezentowała własny model AI o nazwie "Xiao AI 6.0", który działa lokalnie i oferuje szereg funkcji offline, takich jak tłumaczenia, generowanie streszczeń i sugestie w czasie rzeczywistym. Nowa warstwa HyperOS, obecna w najnowszych smartfonach Xiaomi, jeszcze lepiej integruje AI z systemem.</p>
</section>

<section class="content-block ai-tools">
    <h2>Narzędzia AI w smartfonach Xiaomi</h2>

    <h3>Asystent głosowy – Xiao AI i Google Asystent</h3>
    <p>Xiaomi rozwija własnego asystenta głosowego – Xiao AI – dostępnego głównie w Chinach. Wersja 6.0 wprowadza lokalne przetwarzanie danych, obsługę złożonych poleceń i sugestie kontekstowe. W wersjach globalnych smartfonów Xiaomi dostępna jest pełna integracja z Asystentem Google, który umożliwia zarządzanie funkcjami telefonu głosowo również w języku polskim.</p>

    <h3>Analiza danych – optymalizacja baterii i personalizacja</h3>
    <p>System HyperOS analizuje wzorce użytkowania, by optymalizować zużycie energii i wydajność aplikacji. Dzięki AI możliwe jest także wykrywanie aplikacji nieaktywnych i automatyczne ich zamrażanie. System uczy się również lokalizacji, nawyków oraz godzin aktywności użytkownika, aby dostosowywać tryby pracy, np. "inteligentny tryb nocny".</p>

    <h3>Wspomaganie multimediów – AI w aparacie i wideo</h3>
    <p>Algorytmy AI Xiaomi rozpoznają sceny i obiekty w czasie rzeczywistym, dostosowując parametry zdjęć i wideo. Xiaomi wprowadziło także funkcję "AI Album", która automatycznie kategoryzuje zdjęcia oraz pozwala na szybkie wyszukiwanie po słowach kluczowych. Filmy są stabilizowane dzięki AI i wspomagane adaptacyjnym HDR.</p>

    <h3>Edycja treści – AI Text Tools</h3>
    <p>W Xiaomi 14 Pro pojawiła się funkcja inteligentnego przetwarzania tekstu: użytkownik może wygenerować streszczenie długich wiadomości, przetłumaczyć tekst lub zmienić styl wypowiedzi. Narzędzie działa w obrębie aplikacji wiadomości, maili oraz przeglądarki i może działać offline dzięki wsparciu lokalnych modeli AI.</p>

    <h3>Edycja multimediów – Magic Eraser i Photo Remaster</h3>
    <p>Xiaomi oferuje zaawansowane narzędzia AI do edycji zdjęć. Magic Eraser umożliwia usuwanie obiektów ze zdjęcia, a Photo Remaster automatycznie poprawia jakość fotografii, balans bieli i ostrość. Edytor oparty jest o techniki uczenia maszynowego i działa w czasie rzeczywistym.</p>

    <h3>Generowanie treści – AI Note Summary</h3>
    <p>W systemie Xiaomi HyperOS dostępna jest funkcja automatycznego streszczania notatek i wiadomości. Narzędzie analizuje wpisywany tekst i proponuje zwięzłe podsumowania. Działa to zarówno dla tekstów pisanych przez użytkownika, jak i przychodzących wiadomości (np. e-maili, artykułów).</p>

    <h3>Generowanie multimediów – Xiaomi AI Canvas</h3>
    <p>W 2025 roku Xiaomi zaprezentowało AI Canvas – narzędzie do generowania obrazów na podstawie tekstowego opisu. Użytkownicy mogą wpisać komendę (np. „kotek w stylu akwareli”) i otrzymać obraz wygenerowany przez model AI. Narzędzie to jest zintegrowane z galerią i funkcjonuje również offline.</p>

    <h3>Tłumacz – wbudowany tłumacz offline</h3>
    <p>Xiaomi oferuje funkcję tłumaczeń w czasie rzeczywistym w wielu aplikacjach, także offline. Tłumacz integruje się z aplikacją Wiadomości, Dokumenty, Przeglądarka oraz Notatki. Obsługuje kilkanaście języków, w tym polski, i wykorzystuje lokalne modele do natychmiastowego tłumaczenia tekstu oraz napisów wideo.</p>

    <h3>Chatboty – integracja z Mi AI i ChatGPT</h3>
    <p>Xiaomi umożliwia integrację z ChatGPT oraz własną platformą Mi AI. Chatboty dostępne są w aplikacjach wiadomości oraz jako widżety ekranowe. Użytkownik może korzystać z gotowych scenariuszy lub prowadzić swobodną rozmowę. Funkcja działa w wersjach globalnych przy połączeniu z siecią.</p>

</section>

<footer class="footer">
    <div class="container">
        <p>&copy; 2025 Smartfony z SI - Praca licencjacka</p>
    </div>
</footer>

</body>
</html>
