<?php
include('includes/config.php');
//Kontroll för att se om användaren är inloggad. Olika navigeringar visas beroende på om användare är inloggad eller ej
if(isset($_SESSION['email'])){
    include('includes/header-user.php');
    }else{
        include('includes/header-public.php');
    }

if(isset($_POST['email'])){
    $email=$_POST['email'];
    $password=$_POST['password'];

    //Skapar instans av klassen User
    $login = new User();
    if($login->logIn($email, $password)){
        header('Location:admin.php');
    }else{
        $message = "<p class='error-message'> Felaktig mailadress eller lösenord </p>";
    }
}
?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Bloggportalen</title>
</head>


<form method="POST" action="login.php" id="login-form">
    <h2>Logga in</h2>
    <?php
    if(isset($message)){
        echo $message;
    }
    ?>
    <label for="email">Epost:</label><br>
    <input type="email" name="email" id="email"><br><br>
    <label for="password">Lösenord:</label><br>
    <input type="password" name="password" id="password"><br><br>
    <input type="submit" value="Logga in">
    <div class="form-flex">
    <div><h3>Har du inget konto?</h3></div>
    <div><a href="register.php" id="member">Bli medlem</a></div>
    </div>

</form>

</body>
</html>