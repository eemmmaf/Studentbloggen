<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-03-17 19:56:08 
 * @Last Modified by:   Emma Forslund - emfo2102 
 * @Last Modified time: 2022-03-17 19:56:08 
 */

 
$page_title = "Mina sidor";
include('includes/config.php');
//Kontroll för att se om användaren är inloggad. Olika navigeringar visas beroende på om användare är inloggad eller ej
if (isset($_SESSION['email'])) {
    include('includes/header-user.php');
} else {
    include('includes/header-public.php');
}

//Tar användaren till logga in-sidan om inloggningen misslyckades
if (!isset($_SESSION['email'])) {
    header("Location:login.php");
}

//Skapar ny instans av båda klasserna
$user = new User();
$post = new Post();
$post_list = $post->getPosts();
$username = $_SESSION['email'];


//Loopar igenom listan med användare
$usersList = $user->getUserInfo();
foreach ($usersList as $user) {

?>
    <main>
        <section class="admin">
            <h2>Mina sidor</h2>
            <div class="admin-flex">
                <div id="left">
                <h3><?= $user['blog_name'] ?>     <i class="fa-solid fa-user"></i></h3>
                    <ul id="admin-ul">
                        <!--Utskrift av användarens uppgifter-->
                        <li><strong>Bloggens namn:</strong><br> <?= $user['blog_name'] ?></li>
                        <li><strong>Bloggarens namn:</strong><br> <?= $user['fname'] . " " . $user['ename'] ?>
                        </li>
                        <li><strong>Epost: </strong><br><?= $user['email'] ?>
                        <li><strong>Blogg skapad: </strong><br><?= $user['created'] ?>
                        </li>
                    </ul>
                </div>
                <div id="right">
                    <h3>Lagrade inlägg</h3>
                    <?php
                    $post = new Post();
                    $post_list = $post->getPostByUser();

                    //Kontroll om arrayen är tom 
                    if (empty($post_list)) {
                        echo "<p id='empty-p'> Du har inte skapat några inlägg ännu.</p>";
                    } else {
                        //Loopar igenom listan med inlägg och skriver ut alla inlägg. 
                        foreach ($post_list as $row) {
                            echo " <article class='latest'>
                           <h4>" . $row['title'] . "</h4>
                           <p class='posted'>Postat: " . $row['created'] . " </p>
                           <p>" . $row['content'] . "</p>".
                                "</article>";
                        }
                    } ?>
                </div>
            </div>
        </section>
    <?php

}


include('includes/footer.php');
    ?>