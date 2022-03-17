    <?php
    $page_title = "Startsida";
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
        <picture>
            <source media="(max-width:500px)" srcset="images/img1-small.jpg">
            <img src="images/img1.jpg" alt="En laptop">
        </picture>
        <!--Textruta placeras på bilden-->
        <div class="hero-text">
            <h2>Bloggportalen för studenter</h2>
            <!--Länk till register.php-->
            <a href="register.php" id="register-a">Skapa blogg direkt</a>
        </div>
    </div>
    <main>
        <section class="index">
            <h2 id="latest-h2">Senaste inläggen</h2>
            <div class="flex-index">
                <div class="flex-article">
                    <?php
                    //Här skapas nya instanser av klasserna
                    $post = new Post();
                    $user = new User();
                    $post_list = $post->getPosts();

                    $count = 0;
                    $break = 5;
                    if ($post_list == []) {
                        echo "<p> Det finns inte några inlägg på denna bloggportal ännu</p>";
                    } else {
                        foreach ($post_list as $a) {
                    ?>
                            <article class="latest">
                                <h3><?= $a['title'] ?></h3>
                                <p class="posted">Postat: <?= $a['created'] ?>
                                    | Bloggare: <?= $a['blog_name'] ?></p>
                                <p><?= $a['content'] ?></p>
                                <a class="details" href="comments.php?id=<?= $a['id'] ?>">Gå till inlägget</a>

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
                <div class="flex-container-index">
                    <div class="index-users">
                        <h2>Registrerade användare</h2>
                        <ul id="users">
                            <?php
                            $userposts = new Post();
                            $users = new User();
                            $users = $users->getUsers();

                            //Kontroll för att se om arrayen är tom
                            if ($users == []) {
                                echo "<p> Det finns inga registrerade användare ännu </p>";
                            } else {
                                //Skriver ut en länk till enskilda användares inlägg
                                foreach ($users as $row) {
                            ?>

                                    <li>
                                        <a href="postbyuser.php?user=<?= $row['email']; ?>"><?= $row['email']; ?> <span class='arrow-i'><i class="fa-solid fa-arrow-right"></i></span></a>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    </div>

                </div>
        </section>

        <!--Sektion där bild och text skrivs ut med FETCH-->
        <section id="space">
            <h2>Veckans tips - planeter</h2>
            <article id="output-article">
                <div class="flex-nasa">
                    <div id="output-div">
                    <h3 id="output-h3">Planeten </h3>
                    <p id="output-content"></p>
                    <button type="button" id="hide-swedish" onclick="showSwedish()">Visa texten på svenska</button>
                    <p id="swedish">
                        Bara 11 miljoner ljusår bort är Centaurus A den aktiva galaxen som ligger närmast planeten jorden. Den märkliga elliptiska galaxen, även känd som NGC 5128, som sträcker sig över 60 000 ljusår, visas i denna skarpa teleskopvy.<br><br> Centaurus A är tydligen resultatet av en kollision mellan två annars normala galaxer som resulterar i ett fantastiskt virrvarr av stjärnhopar och imponerande mörka dammbanor. Nära galaxens centrum konsumeras överblivna kosmiska skräp ständigt av ett centralt svart hål med en miljard gånger solens massa. Precis som i andra aktiva galaxer genererar den processen sannolikt den enorma radio-, röntgen- och gammastrålningsenergi som utstrålas av Centaurus A.
                    </p>
                    </div>
                    <div id="img-nasa">
                        
                    </div>
                </div>
            </article>

        </section>
        <?php
        include('includes/footer.php');
        ?>