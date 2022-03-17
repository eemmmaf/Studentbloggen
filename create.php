<?php
$page_title = "Hantera inlägg";
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
$user = new User();
$post = new Post();
$username = $_SESSION['email'];

//Fångar upp inläggets id med GET
if (isset($_GET['deleteid'])) {
    $deleteid = intval($_GET['deleteid']);

    //Raderar inlägg
    if ($post->deletePost($deleteid)) {
        echo "<p id='raderat'> Inlägget har raderats </p>";
    } else {
        echo "<p> Fel vid radering. Försök igen </p>";
    }
}


//Sätter variablerna som sparar innehållet till default
$title = "";
$content = "";

//Kontroll för att se om formuläret är skickat
if (isset($_POST['title'])) {
    $title = $_POST['title'];
    $title = strip_tags($title);
    $content = $_POST['content'];
    $content = strip_tags($content);

    
    //Felmeddelanden
    $success = true; //Variabel för när det postade är OK
    if (!$post->setTitle($title)) {
        $success = false;

        $errormessage= "<p class='error-create'>Titel måste innehålla minst ett tecken</p>";
    }
    if (!$post->setContent($content)) {
        $success = false;

       $errormessage = "<p class='error-create'>Innehållet måste innehålla minst ett tecken</p>";
    }


    //Lägger till inlägget om input-fälten innehåller minst ett tecken
    if ($success) {
        if ($post->addPost($title, $content, $email)) {
            $message = "<p class='stored'> Inlägget har lagrats <i class='fa-solid fa-circle-check'></i> </p>";
            //Nollställer default variablerna om inlägget postas
            $title = "";
            $content = "";
        } else {
            $message =  "<p class='stored'> Fel vid lagring </p>";
        }
    } else {
        $message =  "<p class='stored'>Blogginlägg ej lagrat. Kontrollera innehållet och försök igen</p>";
    }
}


//Loopar igenom listan med användare
$usersList = $user->getUsers();
foreach ($usersList as $a) {
    if ($a['email'] == $username) {

?>
        <main>
            <section class="admin">
                <h2>Skapa inlägg</h2>
                <?php
                //Skriver ut meddelanden
                if (isset($message)) {
                    echo $message;
                }
                if(isset($errormessage)){
                    echo $errormessage;
                }
                ?>

                <!--Formulär för att skapa inlägg-->
                <form id="admin-form" method="post" action="create.php">
                    <div class="centered">
                        <br>
                        <div><label for="title">Titel:</label><br></div>
                        <div><input type="text" id="title" name="title" value='' <?= $title; ?>><br><br></div>
                    </div>
                    <label for="content">Innehåll:</label><br>
                    <textarea id="content" name="content" rows="20"><?= $content; ?></textarea><br><br>
                    <!--Byter ut textarea till CKEDITOR-->
                    <script>
                        CKEDITOR.replace('content');
                    </script>
                    <input type="submit" value="Skapa inlägg">
                </form>
                </section>
                <section class="lagrad">
                    <h3>
                        Lagrade inlägg
                    </h3>
                    <?php
                    $post = new Post();
                    //Anropar funktionen som hämtar den inloggade användarens inlägg
                    $post_list = $post->getPostByUser();

                    //Loopar igenom listan med inlägg och skriver ut alla inlägg om det finns några. Om det är tomt skrivs meddelande ut
                    if (empty($post_list)) {
                        echo "<p> Det finns inga lagrade inlägg </p>";
                    } else {
                        foreach ($post_list as $row) {
                    ?>
                    <!--Utskrift-->
                            <article class="create-article">
                                <h4><?= $row['title'] ?></h4>
                                <p class="posted">Postat: <?= $row['created'] ?></p>
                                  <p class="content-text"> <?= $row['content'] ?> 
                                <div class="flex-a">
                                    <!--Knapp för att ta bort inlägg-->
                                    <div class="delete-a"><a href="create.php?deleteid=<?= $row['id']; ?>">Ta bort <i class="fa-solid fa-trash-can"></i></a></div>
                                    <!--Knapp för att ändra inlägg-->
                                    <div class="change-a"><a href="edit.php?id=<?= $row['id']; ?>">Ändra inlägg <i class="fa-solid fa-pen-to-square"></i></a></div>
                                </div>
                            </article>
            <?php
                        }
                    }
                }
            }
            ?>
                </section>
                <?php


                include('includes/footer.php');
                ?>