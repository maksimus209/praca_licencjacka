<?php
require_once '../autoryzacja.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Pobierz dane Google (id = 3)
$sql = "SELECT * FROM Phones WHERE idProducent = 4";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $google = $result->fetch_assoc();
} else {
    die("Nie znaleziono producenta.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($google['nazwa']) ?> – informacje o producencie</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/smartphone.css">
</head>
<body>

<header class="header">
    <div class="container">
        <a href="../strona_glowna.html"><img src="../photos_licencjat/logo.png" alt="Logo Google"></a>
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
                <img src="../photos_licencjat/google/google_logo.png" alt="Google">
            </div>
            <div class="intro-text">
                <h2><?= htmlspecialchars($google['nazwa']) ?></h2>
                <ul class="producer-data">
                    <li><strong>Kraj:</strong> <?= htmlspecialchars($google['panstwo']) ?></li>
                    <li><strong>Rok powstania:</strong> <?= htmlspecialchars($google['rokPowstania']) ?></li>
                    <li><strong>Pierwszy smartfon:</strong> <?= htmlspecialchars($google['pierwszySmartphone']) ?></li>
                    <li><strong>Udział globalny:</strong> <?= htmlspecialchars($google['procentGlob']) ?>%</li>
                    <li><strong>Udział w Polsce:</strong> <?= htmlspecialchars($google['procentPoland']) ?>%</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="content-block">
    <h2>O firmie Google</h2>
    <p>Google to amerykańska korporacja technologiczna, znana głównie z wyszukiwarki, systemu Android i chmury obliczeniowej. Smartfony z serii Pixel to flagowe urządzenia firmy, w których Google prezentuje innowacje w zakresie sztucznej inteligencji, fotografii i personalizacji systemu. Własne układy Tensor oraz pełna integracja z usługami chmurowymi umożliwiają wykorzystanie AI zarówno lokalnie, jak i online.</p>
</section>

<section class="content-block">
    <h2>Rozwój sztucznej inteligencji</h2>
    <p>Google od lat rozwija AI w ramach projektów takich jak Google Assistant, Translate, Lens czy Photos. W 2023 roku firma zintegrowała model Gemini (wcześniej Bard) ze swoimi usługami i urządzeniami. Od 2024 roku seria Pixel 8 i 9 oferuje generatywne funkcje offline – edycję zdjęć, transkrypcje, tłumaczenia i podsumowania. AI stało się kluczowym elementem doświadczenia użytkownika, a Pixel to najbardziej „inteligentne” smartfony z Androidem.</p>
</section>

<section class="content-block ai-tools">
    <h2>Narzędzia AI w smartfonach Google</h2>

    <h3>Asystent głosowy – Google Assistant i Gemini</h3>
    <p>Google Assistant to jeden z najbardziej zaawansowanych asystentów głosowych. Działa w języku polskim, umożliwia obsługę telefonu, dostęp do informacji, zarządzanie urządzeniami smart home i wiele innych. Od 2024 r. użytkownicy mogą przełączyć się na Google Gemini – nową generację AI chatbota z funkcjami generatywnymi, integracją z Gmailem, Mapami i Dokumentami Google.</p>

    <h3>Analiza danych – personalizacja i sugestie</h3>
    <p>Google Pixel automatycznie analizuje dane użytkownika, by dostarczać inteligentne sugestie, np. rekomendacje aplikacji, skróty do działań, przypomnienia czy dopasowanie trybów pracy. Dane przetwarzane są lokalnie i chmurowo, z dbałością o prywatność – użytkownik ma pełną kontrolę nad historią aktywności i ustawieniami danych.</p>

    <h3>Wspomaganie multimediów – fotografie i audio</h3>
    <p>Funkcje AI w aparacie to największy atut Pixela. Google wprowadziło m.in. Magic Eraser (usuwanie obiektów), Best Take (scalanie najlepszych min z kilku zdjęć), Night Sight (fotografia nocna), Real Tone (wierne odwzorowanie odcienia skóry) i Photo Unblur. AI wpływa też na jakość dźwięku – automatyczne dopasowanie głośności, filtracja hałasu i optymalizacja mikrofonów.</p>

    <h3>Edycja treści – podsumowania i Smart Reply</h3>
    <p>System Android w Pixelach potrafi generować podsumowania tekstu, np. artykułów, wiadomości e-mail, czy dokumentów Google. Funkcja Smart Reply podpowiada gotowe odpowiedzi na wiadomości, bazując na kontekście. W Gmailu dostępne są także rozszerzone funkcje redagowania maili z pomocą AI.</p>

    <h3>Edycja multimediów – Magic Editor i Audio Magic Eraser</h3>
    <p>Google Pixel 8 i 9 umożliwiają edycję zdjęć za pomocą Magic Editor – użytkownik może zaznaczyć, przenieść lub zmienić tło obiektu, a AI automatycznie odtworzy brakujące elementy. Wideo można poprawić przy pomocy Video Boost i Audio Magic Eraser – który eliminuje hałasy z tła, zachowując głos mówiącego.</p>

    <h3>Generowanie treści – AI Summary i Gboard</h3>
    <p>Klawiatura Gboard zintegrowana z Gemini pozwala generować wiadomości, podsumowania i poprawki stylistyczne. Asystent potrafi przekształcić notatki w listy zadań lub automatycznie przygotować streszczenie długiego tekstu. Funkcja dostępna jest w przeglądarce Chrome, aplikacjach Google i wielu komunikatorach.</p>

    <h3>Generowanie multimediów – Magic Compose i nowe modele</h3>
    <p>Magic Compose to funkcja umożliwiająca generowanie wiadomości w różnych tonach – np. formalnym, zabawnym lub romantycznym. W 2025 roku Google testuje generowanie obrazów z tekstu w Gemini Advanced, ale nie wszystkie funkcje są jeszcze dostępne globalnie na smartfonach.</p>

    <h3>Tłumacz – Google Translate i Live Caption</h3>
    <p>Google Translate oferuje tłumaczenia tekstu, mowy i obrazu (z aparatu) w czasie rzeczywistym. Aplikacja działa również offline. Pixel oferuje też Live Caption – transkrypcję i tłumaczenie napisów w czasie rzeczywistym dla wideo, rozmów i aplikacji.</p>

    <h3>Chatbot – Gemini (dawniej Bard)</h3>
    <p>Gemini to nowy chatbot AI firmy Google, który zastąpił Bard. Może odpowiadać na pytania, podsumowywać dokumenty, pisać kody, tworzyć treści i działać w aplikacjach mobilnych. Gemini zintegrowany jest z Androidem 14 i Gboard, co umożliwia szybkie korzystanie z niego w każdej aplikacji.</p>
</section>

<footer class="footer">
    <div class="container">
        <p>&copy; 2025 Smartfony z SI - Praca licencjacka</p>
    </div>
</footer>

</body>
</html>
