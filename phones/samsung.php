<?php
require_once '../autoryzacja.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Pobierz dane Samsunga (id = 2)
$sql = "SELECT * FROM Phones WHERE idProducent = 2";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $samsung = $result->fetch_assoc();
} else {
    die("Nie znaleziono producenta.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($samsung['nazwa']) ?> – informacje o producencie</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/smartphone.css">
</head>
<body>

<header class="header">
    <div class="container">
        <a href="../strona_glowna.html"><img src="../photos_licencjat/logo.png" alt="Logo Samsung"></a>
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
            <!-- Kolumna LEWA: zdjęcie producenta -->
            <div class="intro-image">
                <img src="../photos_licencjat/samsung/samsung_logo.png" alt="Samsung">
            </div>
            <!-- Kolumna PRAWA: dane producenta -->
            <div class="intro-text">
                <h2><?= htmlspecialchars($samsung['nazwa']) ?></h2>
                <ul class="producer-data">
                    <li><strong>Kraj:</strong> <?= htmlspecialchars($samsung['panstwo']) ?></li>
                    <li><strong>Rok powstania:</strong> <?= htmlspecialchars($samsung['rokPowstania']) ?></li>
                    <li><strong>Pierwszy smartfon:</strong> <?= htmlspecialchars($samsung['pierwszySmartphone']) ?></li>
                    <li><strong>Udział globalny:</strong> <?= htmlspecialchars($samsung['procentGlob']) ?>%</li>
                    <li><strong>Udział w Polsce:</strong> <?= htmlspecialchars($samsung['procentPoland']) ?>%</li>
                </ul>
            </div>
        </div>
    </div>
</section>


<section class="content-block">
    <h2>O firmie Samsung</h2>
    <p>Samsung to południowokoreański gigant technologiczny, który rozpoczął działalność w 1938 roku. Na rynku smartfonów działa od 2009 roku, a marka Galaxy stała się globalnie rozpoznawalna. Firma produkuje własne procesory (Exynos), ekrany (AMOLED) i moduły pamięci, będąc jednocześnie największym producentem smartfonów na świecie. Modele Galaxy S, Z Fold czy A to jedne z najbardziej znanych linii na rynku.</p>
</section>

<section class="content-block">
    <h2>Rozwój sztucznej inteligencji</h2>
    <p>Samsung rozpoczął wdrażanie AI już w 2017 roku z premierą asystenta Bixby. Z czasem firma rozwinęła system Galaxy AI, który w 2024–2025 został zintegrowany z generatywnymi funkcjami offline, takimi jak tłumaczenie rozmów w czasie rzeczywistym, streszczanie notatek czy edycja obrazów. W najnowszych urządzeniach (Galaxy S25) AI działa lokalnie, co gwarantuje szybkość i prywatność.</p>
</section>

<section class="content-block ai-tools">
    <h2>Narzędzia AI w smartfonach Samsung</h2>

    <h3>Asystent głosowy – Bixby i integracja z Google</h3>
    <p>Samsung od kilku lat rozwija własnego asystenta głosowego – Bixby – który umożliwia obsługę telefonu głosowo. Choć asystent ten oferuje wiele funkcji, jego zastosowanie w Polsce jest ograniczone ze względu na brak obsługi języka polskiego. Dlatego urządzenia Galaxy oferują pełną integrację z Asystentem Google – dostępnego w języku polskim – dzięki czemu użytkownik może sterować smartfonem, zadawać pytania, pisać wiadomości i korzystać z nawigacji przy użyciu komend głosowych. Od 2024 roku funkcje AI w Samsungu zaczęły wykorzystywać również generatywne modele do podsumowań, sugestii i tłumaczeń w czasie rzeczywistym.</p>

    <h3>Analiza danych i personalizacja działania</h3>
    <p>Funkcje analizy danych w smartfonach Galaxy obejmują m.in. Adaptive Battery, która uczy się nawyków użytkownika i optymalizuje zużycie energii w zależności od preferencji. Samsung wykorzystuje uczenie maszynowe do przewidywania działań – np. uruchamianie aplikacji w określonych warunkach – oraz do rozpoznawania wzorców użytkowania. Dodatkowo system analizuje aktywność, lokalizację, godziny snu i tryb pracy, by sugerować automatyczne zmiany ustawień w ramach inteligentnych scenariuszy (Bixby Routines).</p>

    <h3>Wspomaganie multimediów – AI w aparacie i dźwięku</h3>
    <p>Samsung od dawna rozwija AI wspierające funkcje aparatu. Dzięki AI urządzenia Galaxy rozpoznają scenerie, twarze, zwierzęta i inne obiekty, automatycznie dostosowując kolory, kontrast i ekspozycję. Funkcje takie jak Single Take, Nightography czy Auto Framing (kadrowanie wideo) korzystają z algorytmów SI, by zapewnić lepszą jakość zdjęć i filmów. W zakresie dźwięku Samsung stosuje adaptacyjne wzmocnienie głosu, redukcję szumów i optymalizację głośników w czasie rzeczywistym, zależnie od otoczenia.</p>

    <h3>Edycja treści – Writing Assist</h3>
    <p>Dzięki funkcji Writing Assist w Galaxy AI, użytkownicy mogą generować lub edytować wiadomości i notatki bezpośrednio w telefonie. System oferuje tłumaczenia, zmiany tonu wypowiedzi (formalny / neutralny / swobodny), podsumowania oraz inteligentne uzupełnienia tekstu. Funkcja działa w wielu aplikacjach – w tym komunikatorach, e-mailach i przeglądarkach – i może być aktywowana kontekstowo w polu tekstowym.</p>

    <h3>Edycja multimediów – Generative Edit & Photo Remaster</h3>
    <p>Samsung Galaxy S25 i inne modele z One UI 7 oferują funkcję Generative Edit – umożliwiającą edycję zdjęcia z wykorzystaniem generatywnej sztucznej inteligencji. Użytkownik może zaznaczyć fragment zdjęcia do usunięcia lub przesunięcia, a system automatycznie uzupełnia tło i poprawia spójność obrazu. Funkcja Photo Remaster pozwala natomiast poprawić starsze zdjęcia: usunąć szumy, wyostrzyć obraz i przywrócić kolory. Edycja działa lokalnie – bez potrzeby połączenia z chmurą.</p>

    <h3>Generowanie treści – Note Assist i Transcript Assist</h3>
    <p>W systemie Galaxy AI dostępne są narzędzia do generowania streszczeń i automatycznego tworzenia notatek. Note Assist analizuje tekst wprowadzony przez użytkownika i tworzy przejrzyste podsumowanie. Funkcja Transcript Assist – zintegrowana z rejestratorem dźwięku – przekształca nagrania głosowe w transkrypcje tekstowe i generuje z nich podsumowania lub listy punktów. Dzięki obsłudze wielu języków i działania offline, funkcje te stają się niezwykle przydatne w pracy i nauce.</p>

    <h3>Generowanie multimediów – aktualnie niedostępne</h3>
    <p>Na kwiecień 2025 Samsung nie oferuje jeszcze natywnej funkcji tworzenia obrazów lub wideo z użyciem generatywnej AI (np. z opisu tekstowego). Firma koncentruje się obecnie na edycji i poprawie multimediów, ale zapowiedziano rozszerzenie Galaxy AI o nowe możliwości generowania treści wizualnych jeszcze przed końcem roku. Prawdopodobnie zostaną one wprowadzone w Galaxy Z Fold7.</p>

    <h3>Tłumaczenie – Live Translate i Interpreter</h3>
    <p>Funkcja Live Translate w Galaxy AI umożliwia tłumaczenie rozmów telefonicznych i wiadomości tekstowych w czasie rzeczywistym. Obsługuje wiele języków, w tym język polski, i działa zarówno online, jak i offline. W przypadku połączeń głosowych funkcja może wyświetlać napisy z tłumaczeniem dla obu stron rozmowy. Nowa funkcja Interpreter pozwala na prowadzenie rozmowy z osobą mówiącą w innym języku z dwustronnym tłumaczeniem na ekranie.</p>

    <h3>Chatboty – integracja z Google Gemini (dawny Bard) i ChatGPT</h3>
    <p>Samsung nie posiada własnego zaawansowanego chatbota AI. Zamiast tego urządzenia Galaxy oferują integrację z platformami firm trzecich – Google Gemini i OpenAI ChatGPT. Użytkownik może korzystać z tych narzędzi za pomocą aplikacji lub skrótów systemowych. Funkcje te nie są domyślnie zintegrowane z systemem, ale mogą być aktywowane przez użytkownika zgodnie z preferencjami.</p>
</section>

<footer class="footer">
    <div class="container">
        <p>&copy; 2025 Smartfony z SI - Praca licencjacka</p>
    </div>
</footer>

</body>
</html>
