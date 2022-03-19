<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-03-17 19:56:39 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-03-18 21:16:54
 */


$page_title = "Inlägg";
include('includes/config.php');
//Kontroll för att se om användaren är inloggad. Olika navigeringar visas beroende på om användare är inloggad eller ej
if (isset($_SESSION['email'])) {
    include('includes/header-user.php');
} else {
    include('includes/header-public.php');
}
if ((isset($_GET['user']))) {
    $blog_name = $_GET['user'];
?>
    <!--Den stora bilden som visas på startsidan-->
    <div class="hero-image">
        <picture>
        <source srcset="images/img1.jpg" media="(min-width:650px)">
            <img src="images/img1-small.jpg" alt="En laptop och kaffekopp">
        </picture>
        <!--Textruta placeras på bilden-->
        <div class="hero-text">
            <h2>Bloggportalen för studenter</h2>
            <!--Länk till register.php-->
            <a href="register.php" id="register-a">Skapa blogg</a>
        </div>
    </div>
    <main>
        <section class="index">
            <h2>Inlägg av <?= $blog_name ?></h2>
            <div class="flex-index">
                <div class="flex-article">
                    <?php
                    $userposts = new Post();
                    $postArr = $userposts->getPostsFromUser();
                    if (empty($postArr)) {
                        echo "<p> Denna användare har inte skapat några inlägg";
                    } else {
                        foreach ($postArr as $posts) {
                    ?>
                            <article class="latest">
                                <h3><?= $posts['title'] ?></h3>
                                <p class="posted">Postat: <?= $posts['created'] ?></p>
                                <p class='content'><?= $posts['content'] ?></p>
                            </article>
                    <?php
                        }
                    }
                    ?>





                </div>
                <div class="index-users">
                    <h2>Registrerade bloggar</h2>
                    <ul id="users">
                        <?php
                        $userposts = new Post();
                        $users = new User();

                        $users = $users->getUsers();

                        foreach ($users as $row) {
                        ?>
                            <li>
                                <a href="postbyuser.php?user=<?= urlencode($row['blog_name']); ?>"><?= $row['blog_name']; ?><span class='arrow-i'><i class="fa-solid fa-arrow-right"></i></span></a>
                        <?php


                        }
                    }
                        ?>
                            </li>
                    </ul>
                </div>
            </div>
        </section>
        <?php
        include('includes/footer.php');
        ?>