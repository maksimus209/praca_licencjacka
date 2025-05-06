<?php
require_once '../autoryzacja.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Pobierz dane Apple (id = 1)
$sql = "SELECT * FROM Phones WHERE idProducent = 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $apple = $result->fetch_assoc();
} else {
    die("Nie znaleziono producenta.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($apple['nazwa']) ?> – informacje o producencie</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/smartphone.css">
</head>
<body>

<header class="header">
    <div class="container">
        <a href="../strona_glowna.html"><img src="../photos_licencjat/logo.png" alt="Logo Apple"></a>
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
                <img src="../photos_licencjat/apple/apple_logo.png" alt="Apple">
            </div>
            <div class="intro-text">
                <h2><?= htmlspecialchars($apple['nazwa']) ?></h2>
                <ul class="producer-data">
                    <li><strong>Kraj:</strong> <?= htmlspecialchars($apple['panstwo']) ?></li>
                    <li><strong>Rok powstania:</strong> <?= htmlspecialchars($apple['rokPowstania']) ?></li>
                    <li><strong>Pierwszy smartfon:</strong> <?= htmlspecialchars($apple['pierwszySmartphone']) ?></li>
                    <li><strong>Udział globalny:</strong> <?= htmlspecialchars($apple['procentGlob']) ?>%</li>
                    <li><strong>Udział w Polsce:</strong> <?= htmlspecialchars($apple['procentPoland']) ?>%</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="content-block">
    <h2>O firmie Apple</h2>
    <p>Apple to amerykańska firma technologiczna z siedzibą w Cupertino, znana z innowacyjnego podejścia do sprzętu, oprogramowania i designu. Od premiery iPhone’a w 2007 roku firma zrewolucjonizowała rynek smartfonów. Apple integruje autorskie procesory, systemy operacyjne i usługi, a rozwój sztucznej inteligencji w ekosystemie Apple skupia się na prywatności, lokalnym przetwarzaniu danych i intuicyjnym wsparciu użytkownika.</p>
</section>

<section class="content-block">
    <h2>Rozwój sztucznej inteligencji</h2>
    <p>Apple rozwija sztuczną inteligencję w sposób zgodny ze swoją filozofią ochrony prywatności. Od lat AI wspiera funkcje takie jak rozpoznawanie twarzy (Face ID), sugestie Siri, inteligentne edytowanie zdjęć czy systemowe podpowiedzi. W 2024 roku Apple zapowiedziało rozszerzenie tych możliwości w iOS 18 – w tym funkcje generatywne, tworzenie streszczeń, zmianę tonu wypowiedzi i integrację z zewnętrznymi LLM (np. ChatGPT). Wszystko to z silnym naciskiem na przetwarzanie lokalne dzięki układom Apple Silicon.</p>
</section>

<section class="content-block ai-tools">
    <h2>Narzędzia AI w smartfonach Apple</h2>

    <h3>Asystent głosowy – Siri</h3>
    <p>Siri to asystent głosowy Apple dostępny od 2011 roku, stale ulepszany i aktualizowany. Działa lokalnie i w chmurze, zapewniając szybki dostęp do informacji, sterowanie aplikacjami oraz integrację z systemem. Od iOS 17 Siri rozpoznaje kontekst i potrafi reagować na bardziej złożone polecenia, a planowana na iOS 18 wersja ma zawierać wsparcie generatywne i funkcje personalizacji odpowiedzi.</p>

    <h3>Analiza danych i personalizacja działania</h3>
    <p>iOS wykorzystuje uczenie maszynowe do analizy nawyków użytkownika – od korzystania z aplikacji, po zarządzanie energią i ustawienia. System przewiduje potrzeby użytkownika, podpowiada działania (np. skróty Siri), przypomina o niedokończonych zadaniach i automatycznie dostosowuje ustawienia, by poprawić komfort i efektywność.</p>

    <h3>Wspomaganie multimediów – Live Text, rozpoznawanie obiektów</h3>
    <p>Apple wykorzystuje AI do inteligentnego rozpoznawania treści na zdjęciach (Live Text), identyfikacji przedmiotów, zwierząt, roślin i tekstu. System sortuje zdjęcia wg osób, miejsc, wydarzeń i automatycznie sugeruje najlepsze kadry. Funkcja Visual Look Up dostarcza dodatkowych informacji o rozpoznanych obiektach.</p>

    <h3>Edycja treści – Sugestie tekstowe i podsumowania</h3>
    <p>Apple zapowiedziało integrację funkcji generowania tekstu w systemowych aplikacjach: Mail, Wiadomości, Notatki i Pages. Będzie można zmieniać ton wypowiedzi, skracać wiadomości lub przekształcać je w streszczenia. Te funkcje będą działać lokalnie i z możliwością wsparcia zewnętrznych modeli językowych.</p>

    <h3>Edycja multimediów – Inteligentna korekcja zdjęć</h3>
    <p>Aparat iPhone’a wykorzystuje uczenie maszynowe do automatycznej poprawy zdjęć – m.in. optymalizacji HDR, redukcji szumów, dostosowania ostrości. System umożliwia także edycję głębi ostrości i usuwanie obiektów (Photo Cutout), a funkcje edytora pozwalają na korekty jednym kliknięciem z pomocą AI.</p>

    <h3>Generowanie treści – Zapowiedziane w iOS 18</h3>
    <p>Apple testuje możliwość generowania tekstu z pomocą własnych i zewnętrznych modeli (np. OpenAI). Funkcje obejmą streszczenia, redagowanie tekstu, zmiany tonacji i automatyczne uzupełnianie. Szczegóły zostaną przedstawione na WWDC 2025, ale już wiadomo, że funkcje te mają działać z zachowaniem pełnej prywatności.</p>

    <h3>Generowanie multimediów – Brak natywnego wsparcia (jeszcze)</h3>
    <p>Na ten moment Apple nie udostępnia własnego generatora grafik AI. Według doniesień trwają testy integracji z narzędziami typu DALL·E i Firefly w ramach zewnętrznego API. Apple stawia na jakość edycji istniejących multimediów, ale generacja może pojawić się w iOS 18 lub iPhone 17 Pro.</p>

    <h3>Tłumaczenie – Apple Translate</h3>
    <p>Natywna aplikacja Tłumacz pozwala tłumaczyć tekst i mowę w czasie rzeczywistym, nawet bez dostępu do internetu. Zintegrowana z systemem – działa w Safari, wiadomościach i notatkach. Wspiera m.in. język polski, a jakość tłumaczeń ulega ciągłej poprawie.</p>

    <h3>Chatbot – Integracja z ChatGPT (planowana)</h3>
    <p>Apple nie posiada własnego czatbota AI, ale według oficjalnych doniesień iOS 18 ma oferować opcjonalną integrację z ChatGPT/OpenAI oraz innymi modelami (np. Gemini). Użytkownik będzie mógł włączyć lub wyłączyć te funkcje i mieć pełną kontrolę nad swoimi danymi.</p>
</section>

<footer class="footer">
    <div class="container">
        <p>&copy; 2025 Smartfony z SI - Praca licencjacka</p>
    </div>
</footer>

</body>
</html>
