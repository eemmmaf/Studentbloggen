<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-03-17 19:54:36 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-03-17 19:55:43
 */
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/2090b52781.js" crossorigin="anonymous"></script>
    <title><?= $site_title . $divider . $page_title; ?></title>
</head>

<body>
    <header>
        <h1><a href="index.php">Studentblogg<i class="fa-solid fa-book"></i></a></h1>
        <nav class="desktop-nav">
            <ul>
                <li><a href="about.php">Om sidan   <i class="fa-solid fa-circle-info fa-2xs"></i></a></li>
                <li><a href="register.php">Skapa blogg   <i class="fa-solid fa-user-plus fa-2xs"></i></a></li>
                <li><a href="login.php">Logga in   <i class="fa-solid fa-right-to-bracket fa-2xs"></i></a></li>
            </ul>
        </nav>
        <!--Hamburger-meny-->
        <nav class="hamburger-menu">
            <button class="hamburger-icon" id="hamburger-icon"><i class="fas fa-bars"></i></button>
            <ul class="nav-ul" id="nav-ul">
                <li><a href="about.php">Om sidan   <i class="fa-solid fa-circle-info fa-2xs"></i></a></li>
                <li><a href="register.php">Skapa blogg   <i class="fa-solid fa-user-plus fa-2xs"></i></a></li>
                <li><a href="login.php">Logga in   <i class="fa-solid fa-right-to-bracket fa-2xs"></i></a></li>
            </ul>
        </nav>
    </header>