    <?php
    /*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-03-17 19:56:39 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-03-20 18:09:26
 */


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
                                <?= substr($a['content'], 0, 500) ?>
                                <br><br>
                                <a class="details" href="details.php?id=<?= $a['id'] ?>">Läs hela inlägget</a>

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
                    <h2>Registrerade bloggar</h2>
                    <ul id="users">
                        <?php
                        $userposts = new Post();
                        $users = new User();
                        $users = $users->getUsers();

                        //Kontroll för att se om arrayen är tom
                        if ($users == []) {
                            echo "<li>Det finns inga registrerade användare ännu </li>";
                        } else {
                            //Skriver ut en länk till enskilda användares inlägg. Använder urlencode för att inte få mellanslag i bloggnamnet
                            foreach ($users as $row) {
                        ?>

                                <li>
                                    <a href="postbyuser.php?user=<?= urlencode($row['blog_name']); ?>"><?= $row['blog_name']; ?> <span class='arrow-i'><i class="fa-solid fa-arrow-right"></i></span></a>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>

            </div>
        </section>
        <!--Sektion där bild och text skrivs ut med FETCH-->
        <section id="space">
            <h2>Veckans lektion - Galaxer</h2>
            <article id="output-article">
                <div class="flex-nasa">
                    <div id="output-div">
                        <h3 id="output-h3">Galaxen </h3>
                        <p id="output-content"></p>
                    </div>
                    <div id="img-nasa">

                    </div>
                </div>
            </article>

        </section>
        <?php
        include('includes/footer.php');
        ?>