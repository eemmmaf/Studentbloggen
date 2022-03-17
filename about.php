<?php
$page_title = "Om sidan";
include('includes/config.php');
//Kontroll för att se om användaren är inloggad. Olika navigeringar visas beroende på om användare är inloggad eller ej
if (isset($_SESSION['email'])) {
    include('includes/header-user.php');
} else {
    include('includes/header-public.php');
}
?>
<main>
        <article class="about-article">
            <h2>Om denna sida</h2>
            <p>Detta är en bloggportal för studenter som vill dela sina tankar med varandra.
                Kanske träffar du en ny pluggkompis, får tips eller blir mer motiverad till dina studier?
            </p>
        </article>
        <article class="about-article">
            <h2>Om mig</h2>
            <p>Mitt namn är Emma Forslund, är 26 år och bor i Stockholm. Jag studerar andra terminen Webbutveckling och detta är en projektuppgift i kursen Webbutveckling ll.</p>
        </article>
    <?php
    include('includes/footer.php');
    ?>