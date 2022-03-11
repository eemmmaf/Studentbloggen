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
    <script src="//cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
    <title>Bloggportalen</title>
</head>
<body>
<header>
        <h1><a href="index.php">Bloggportalen</a></h1>
        <nav class="desktop-nav">
            <ul>
                <li><a href="about.php">Om oss</a></li>
                <li><a href="create.php">Skapa inlägg</a></li>
                <li><a href="admin.php">Mina sidor</a></li>
                <li><a href="logout.php">Logga ut</a></li>
            </ul>
        </nav>
    </header>