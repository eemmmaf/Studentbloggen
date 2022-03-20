<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-03-17 19:56:39 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-03-17 19:57:07
 */


$page_title = "Logga in";
include('includes/config.php');
//Kontroll för att se om användaren är inloggad. Olika navigeringar visas beroende på om användare är inloggad eller ej
if (isset($_SESSION['email'])) {
    include('includes/header-user.php');
} else {
    include('includes/header-public.php');
}

//Sparar användarens mail och lösenord i variabler
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Skapar instans av klassen User
    $login = new User();
    //Loggar in användaren om rätt användarnamn och lösenord anges
    if ($login->logIn($email, $password)) {
        header('Location:admin.php');
    } else {
        $message = "<p class='error-message'> Felaktig mailadress eller lösenord </p>";
    }
}
?>


<!--Formulär för att logga in-->
<form method="POST" action="login.php" id="login-form">
    <h2>Logga in</h2>
    <?php
    //Skriver ut felmeddelanden
    if (isset($message)) {
        echo $message;
    }
    ?>
    <label for="email">Epost:</label><br>
    <input type="email" name="email" id="email"><br><br>
    <label for="password">Lösenord:</label><br>
    <input type="password" name="password" id="password"><br><br>
    <input type="submit" value="Logga in">
    <div class="form-flex">
        <!--Länkar till register.php-->
        <div>
            <h3>Har du inget konto?</h3>
        </div>
        <div><a href="register.php" id="member">Bli medlem</a></div>
    </div>
</form>
<!--Slut på formulär-->

<!--Inkluderar ej footern i denna fil-->
<script src="js/main.js"></script>
</body>

</html>