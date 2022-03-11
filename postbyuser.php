<?php
include('includes/config.php');
//Kontroll för att se om användaren är inloggad. Olika navigeringar visas beroende på om användare är inloggad eller ej
if (isset($_SESSION['email'])) {
    include('includes/header-user.php');
} else {
    include('includes/header-public.php');
}
if ((isset($_GET['email']))) {
    $blog_name = $_GET['email'];
    $blog_name = htmlentities($blog_name, ENT_QUOTES, 'UTF-8');
?>
    <div class="hero-image">
        <img src="images/img1.jpg" alt="En bild på en laptop, gul blomma och en kaffekopp">
        <div class="hero-text">
            <h2>Börja blogga</h2>
            <ul id="getstarted-ul">
                <li>Det är gratis</li>
                <li>Lätt att komma igång</li>
            </ul>
            <a href="register.php" id="register-a">Tryck här för att registrera din blogg</a>
        </div>
    </div>
    <main>
        <section class="index">
            <h2>Inlägg av <?= $blog_name ?></h2>
            <div class="flex-index">
                <div class="flex-article">
                    <?php
                    $userposts = new Post();
                    $postArr = $userposts->getPosts();
                    foreach ($postArr as $posts) {
                    ?>
                        <article class="latest">
                            <h3><?= $posts['title'] ?></h3>
                            <p class="posted">Postat: <?= $posts['created'] ?></p>
                            <?= $posts['content'] ?>
                        </article>
                    <?php
                    }
                    ?>





                </div>
                <div class="index-users">
                    <h2>Registrerade användare</h2>
                    <ul id="users">
                    <?php
                    $userposts = new Post();
                    $users = new User();
                    $postArr = $userposts->getPostsFromUser();

                    $users = $users->getUsers();

                    foreach ($users as $row) {
                    ?>
                            <li>
                                <a href="postbyuser.php?email=<?= $row['blog_name']; ?>"><?= $row['blog_name']; ?></a>
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