<?php
include('includes/config.php');
//Kontroll för att se om användaren är inloggad. Olika navigeringar visas beroende på om användare är inloggad eller ej
if (isset($_SESSION['email'])) {
    include('includes/header-user.php');
} else {
    include('includes/header-public.php');
}
?>
<!--Den stora bilden som visas på startsidan-->
<div class="hero-image">
    <img src="images/img1.jpg" alt="En bild på en laptop, gul blomma och en kaffekopp">
    <!--Textruta placeras på bilden-->
    <div class="hero-text">
        <h2>Börja blogga</h2>
        <ul id="getstarted-ul">
            <li>Det är gratis</li>
            <li>Lätt att komma igång</li>
            <li>Dela dina tankar med andra studenter</li>
        </ul>
        <!--Länk till register.php-->
        <a href="register.php" id="register-a">Tryck här för att registrera din blogg</a>
    </div>
</div>
<main>
    <section class="about">
        <article class="about-article">
            <h2>Om denna sida</h2>
            <p>Detta är en bloggportal som först och främst är ämnad åt studenter, men det är självklart inget krav.
                På denna bloggportal kan studenter skriva inlägg kring hur det är att vara student och dela sina tankar.
                Kanske träffar du en ny pluggkompis, får tips eller blir mer motiverad?
            </p>
        </article>
        <article class="about-article">
            <h2>
<h2>Om mig</h2>
<p>Mitt namn är Emma Forslund, är 26 år och bor i Stockholm. Jag studerar andra terminen Webbutveckling och detta är en projektuppgift i kursen Webbutveckling ll.</p>
            </h2>
        </article>
        </div>
        </div>
    </section>
    <?php
    include('includes/footer.php');
    ?>