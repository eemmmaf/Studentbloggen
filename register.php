<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-03-17 19:56:39 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-03-20 20:02:27
 */



$page_title = "Skapa blogg";
include('includes/config.php');
//Kontroll för att se om användaren är inloggad. Olika navigeringar visas beroende på om användare är inloggad eller ej
if (isset($_SESSION['email'])) {
    include('includes/header-user.php');
} else {
    include('includes/header-public.php');
}

if (isset($_POST['blogname'])) {
    $email = $_POST['email'];
    $blogname = $_POST['blogname'];
    $password = $_POST['password'];
    $fname = $_POST['fname'];
    $ename = $_POST['ename'];

    $register = new User();
    $success = true; //Variabel för när det postade är OK

    //Anropar setmetoder. Registrerar inte användaren om setMetoderna inte uppfylls
    if (!$register->setPassword($password)) {
        $success = false;
        $errorpassword = "<span class='error-form'>Lösenordet måste innehålla minst 8 tecken</span>";
    }

    if (!$register->setEmail($email)) {
        $success = false;

        $errormail = "<span class='error-form'>Epost måste vara i rätt format</span>";
    }

    if (!$register->setBlogname($blogname)) {
        $success = false;

        $errorblogname = "<span class='error-form'>Bloggnamnet måste innehålla minst 5 tecken</span>";
    }

    if (!$register->setFname($fname)) {
        $success = false;

        $errorfname = "<span class='error-form'>Förnamn måste innehålla minst 1 tecken</span>";
    }

    if (!$register->setEname($ename)) {
        $success = false;

        $errorename = "<span class='error-form'>Efternamn måste innehålla minst 1 tecken</span>";
    }

//Kontrollerar om bloggnamnet och mailadressen är unika
    if ($register->uniqueNames($blogname, $email)) {
        $message = "<p class='error-message'> Användare finns redan </p>";
    } else {
        if ($register->registerUser($email, $blogname, $password, $ename, $fname)) {
            $message = "<p> Användare skapad </p>";
        } else {
            $message = "<p class='error-message'> Fel vid skapande av användare </p>";
        }
    }
}


?>
<form action="register.php" method="POST" id="register">
    <h2>Skapa en blogg</h2>
    <p>Här kan du skapa en blogg helt gratis</p>
    <?php
    //Här skrivs felmeddelanden ut
    if (isset(
        $message
    )) {
        echo $message;
    }
    ?>

    <!--Bloggens namn-->
    <label for="blogname">Bloggens namn:</label><br>
    <input type="text" name="blogname" id="blogname"><br><br>
    <div class="error-js"></div>
    <?php
    //Skriver ut felmeddelande
    if (isset($errorblogname)) {
        echo $errorblogname;
    } ?>
    

    <!--Epost-->
    <label for="email">Epost:</label><br>
    <input type="email" name="email" id="email"><br><br>
    <div class="error-js"></div>
    <?php
    //Skriver ut felmeddelande
    if (isset($errormail)) {
        echo $errormail;
    }
    ?>


    <!--Förnamn-->
    <label for="fname">Förnamn:</label><br>
    <input type="text" name="fname" id="fname"><br><br>
    <div class="error-js"></div>
    <?php
    //Skriver ut felmeddelande
    if (isset($errorename)) {
        echo $errorename;
    }
    ?>


    <!--Efternamn-->
    <label for="ename">Efternamn:</label><br>
    <input type="text" name="ename" id="ename"><br><br>
    <div class="error-js"></div>
    <?php
    //Skriver ut felmeddelande
    if (isset($errorfname)) {
        echo $errorfname;
    }
    ?>

    <!--Lösenord-->
    <label for="password">Lösenord:</label><br>
    <input type="password" name="password" id="password" placeholder="Lösenordet måste innehålla minst 8 tecken" onchange="passwordValidation()"><br><br>
    <p id="ok"></p>
    <?php
    //Skriver ut felmeddelande
    if (isset($errorpassword)) {
        echo $errorpassword;
    }
    ?>


    <!--Godkänn lagring-->
    <input type="checkbox" id="approve" name="approve" value="Jag godkänner" onclick="disableSubmit(this)">
    <label for="approve">Jag godkänner lagring av mina uppgifter</label><br><br>
    <p id="approve-p"></p>

    <!--Logga in-->
    <input type="submit" value="Skapa blogg" id="submitEl" disabled>
</form>
<script src="js/main.js"></script>
</body>

</html>