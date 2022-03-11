<?php
include('includes/config.php');
//Kontroll för att se om användaren är inloggad. Olika navigeringar visas beroende på om användare är inloggad eller ej
if(isset($_SESSION['email'])){
    include('includes/header-user.php');
    }else{
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

    //Raderar
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
    $title = htmlentities($title, ENT_QUOTES, 'UTF-8');
    $content = $_POST['content'];
    $content = htmlentities($title, ENT_QUOTES, 'UTF-8');
    //Felmeddelanden
    $success = true; //Variabel för när det postade är OK
    if (!$post->setTitle($title)) {
        $success = false;

        echo "<p class='error-message'>Titel måste innehålla minst ett tecken</p>";
    }
    if (!$post->setContent($content)) {
        $success = false;

        echo "<p class='error-message'>Innehållet måste innehålla minst ett tecken</p>";
    }


    if ($success) {
        if ($post->addPost($title, $content, $email)) {
            echo "<p id='lagrat-admin'> Inlägget har lagrats </p>";
            //Nollställer default variablerna om inlägget postas
            $title = "";
            $content = "";
        } else {
            echo "<p> Fel vid lagring </p>";
        }
    } else {
        echo "<p class='not-stored'>Blogginlägg ej lagrat. Kontrollera innehållet och försök igen</p>";
    }
}


//Loopar igenom listan med användare
$usersList = $user->getUsers();
foreach ($usersList as $a) {
    if ($a['email'] == $username) {

?>
        <main>
            <section class="admin">
                <h2><?= $a['blog_name'] ?></h2>
                <div class="flex-container">
                    <div id="logout"><a href="admin.php?logout">Logga ut</a></div>


            <!--Formulär för att skapa inlägg-->
            <form id="admin-form" method="post" action="create.php">
                <h3>Skapa inlägg</h3>
                <div class="centered">
                    <div><label for="title">Titel:</label><br></div>
                    <div><input type="text" id="title" name="title" value='' <?= $title; ?>><br><br></div>
                </div>
                <label for="content">Innehåll:</label><br>
                <textarea id="content" name="content" rows="20"><?= $content; ?></textarea><br><br>
                <script>
                    CKEDITOR.replace('content');
                </script>
                <input type="submit" value="Skapa inlägg">
            </form>
            <section class="lagrad">
                <h3>
                    Lagrade inlägg
                </h3>
                <?php
                $post = new Post();
                $post_list = $post->getPostByUser();

                //Loopar igenom listan med inlägg och skriver ut alla inlägg. 
                if(empty($post_list)){
                    echo "<p> Det finns inga lagrade inlägg </p>";
                }else{
                foreach ($post_list as $row) {
                ?>
                    <article class="latest">
                        <h4><?= $row['title'] ?></h4>
                        <p class="posted">Postat: <?= $row['created'] ?></p>
                        <p><?= $row['content'] ?>
                        <div class="flex-a">
                            <!--Knapp för att ändra inlägg-->
                            <div><a href="edit.php?id=<?= $row['id']; ?>" class="edit-a">Ändra inlägg</a></div>
                            <!--Knapp för att ta bort inlägg-->
                            <div><a href="create.php?deleteid=<?= $row['id']; ?>" class="delete-a">Ta bort</a></div>
                        </div>
                    </article>
        <?php
                }
            }
            }
        }


        include('includes/footer.php');
        ?>