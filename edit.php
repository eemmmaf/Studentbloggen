<?php
include('includes/config.php');
//Kontroll för att se om användaren är inloggad. Olika navigeringar visas beroende på om användare är inloggad eller ej
if(isset($_SESSION['email'])){
    include('includes/header-user.php');
    }else{
        include('includes/header-public.php');
    }
?>
<main>
    <h2 id="admin-h2">Admin</h2>
    <?php
    $post = new Post();

    //Kontrollerar om id är skickat
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);

        //Kontroll för att se om formuläret är skickat
        if (isset($_POST['title'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];


            //Felmeddelanden
            $success = true; //Variabel för när det postade är OK

            $message = "";
            if (!$post->setTitle($title)) {
                $success = false;

                $message .= "<p class='error-message'>Titel måste innehålla minst ett tecken</p>";
            }
            if (!$post->setContent($content)) {
                $success = false;

                $message .= "<p class='error-message'>Innehållet måste innehålla minst ett tecken</p>";
            }

            if ($success) {
                if ($post->updatePost($id, $title, $content)) {
                    $message .= "<p id='changed'>Ditt inlägg har ändrats</p>";
                } else {
                    $message .= "<p> Fel vid ändring av inlägg </p>";
                }
            } else {
                $message .= "<p class='not-stored'>Blogginlägg ej lagrat. Kontrollera innehållet och försök igen</p>";
            }
        }


        //Läser in innehållet i inlägget
        $info = $post->getPostById($id);
    } else {
        header("location: admin.php");
    }

    ?>
    <!--Formulär för ändring av inlägg-->
    <form id="admin-form" method="post" action="edit.php?id=<?= $id; ?>">
        <h3>Ändra inlägget <?= $info['title'] ?></h3>
        <?php
        if(isset($message)){
            echo $message;
        }
        ?>
        <div class="centered">
            <div><label for="title">Titel:</label><br></div>
            <div><input type="text" id="title" name="title" value=<?= $info['title']; ?>><br><br></div>
        </div>
            <label for="content" id="contennt">Innehåll:</label><br>
            <textarea id="content" name="content" rows="20"><?= $info['content']; ?></textarea><br><br>
            <script>
                        CKEDITOR.replace( 'content' );
                </script>
        <input type="submit" value="Spara ändringar">
    </form>

</main>


<?php
include('includes/footer.php')
?>