<?php
//Loggar ut användare och avbryter sessionen
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();

    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/2090b52781.js" crossorigin="anonymous"></script>
    <script src="//cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
    <title>Bloggportalen</title>
</head>

<body>
    <header>
        <h1><a href="index.php">Bloggportalen</a></h1>
        <nav class="desktop-nav">
            <ul>
                <li><a href="about.php">Om oss    <i class="fa-solid fa-circle-info fa-2xs"></i></a></li>
                <li><a href="create.php">Skapa inlägg   <i class="fa-solid fa-pen fa-2xs"></i></a></li>
                <li><a href="admin.php">Mina sidor  <i class="fa-solid fa-user fa-2xs"></i></a></li>
                <li><a href="logout.php">Logga ut   <i class="fa-solid fa-arrow-right-from-bracket fa-2xs"></i></a></li>
            </ul>
        </nav>
        <!--Hamburger-meny-->
        <nav class="hamburger-menu">
            <button class="hamburger-icon" id="hamburger-icon"><i class="fas fa-bars"></i></button>
            <ul class="nav-ul" id="nav-ul">
                <li><a href="about.php">Om oss   <i class="fa-solid fa-circle-info fa-2xs"></i></a></li>
                <li><a href="create.php">Skapa inlägg <i class="fa-solid fa-pen fa-2xs"></i></a></li>
                <li><a href="admin.php">Mina sidor   <i class="fa-solid fa-user fa-2xs"></i></a></li>
                <li><a href="logout.php">Logga ut    <i class="fa-solid fa-arrow-right-from-bracket fa-2xs"></i></a></li>
            </ul>
        </nav>
    </header>