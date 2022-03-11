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
        <section class="index">
            <h2>Senaste inläggen</h2>
            <div class="flex-index">
                <div class="flex-article">
                    <?php
                    //Här skapas nya instanser av klasserna
                    $post = new Post();
                    $user = new User();
                    $post_list = $post->getPosts();

                    $count = 0;
                    $break = 5;
                    if($post_list == []){
                        echo "<p> Det finns inte några inlägg på denna bloggportal ännu</p>";
                    }else{
                    foreach ($post_list as $a) {
                    ?>
                        <article class="latest">
                            <h3><?= $a['title'] ?></h3>
                            <p class="posted">Postat: <?= $a['created'] ?>
                            | Bloggare: <?= $a['blog_name'] ?></p>
                            <?= $a['content'] ?>
                            <a class="details" href="details.php?id=<?= $a['id'] ?>">Gå till inlägget</a>

                        </article>
                    <?php
                        //Skriver endast ut 5 inlägg
                        $count++;
                        if ($count == $break)
                            break;
                        }
                    }
                    ?>
                </div>
                <div class="index-users">
                    <h2>Registrerade användare</h2>
                    <ul id="users">
                        <?php
                        $userposts = new Post();
                        $users = new User();
                        $users = $users->getUsers();

if($users == []){
    echo "<p> Det finns inga registrerade användare ännu </p>";
}else{
                        foreach ($users as $row) {
                        ?>

                            <li>
                                <a href="postbyuser.php?email=<?= $row['blog_name']; ?>"><?= $row['blog_name']; ?></a>
                            </li>
                        <?php
                        }
                    }
                        ?>
                    </ul>
                </div>
            </div>
        </section>
        <?php
        include('includes/footer.php');
        ?>