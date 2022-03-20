<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-03-17 19:56:39 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-03-20 20:36:31
 */



$page_title = "Redigera inlägg";
include('includes/config.php');
//Kontroll för att se om användaren är inloggad. Olika navigeringar visas beroende på om användare är inloggad eller ej
if (isset($_SESSION['email'])) {
    include('includes/header-user.php');
} else {
    include('includes/header-public.php');
}
?>

<main>
    <!--Länk till föregående sida-->
    <a href="create.php" id="back">Tillbaka till föregående sida</a>
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

                $message .= "<p class='error-create'>Titel måste innehålla minst ett tecken</p>";
            }
            if (!$post->setContent($content)) {
                $success = false;

                $message .= "<p class='error-create'>Innehållet måste innehålla minst ett tecken</p>";
            }

            //Uppdaterar inlägget om användaren har angett minst 1 tecken för titel och innehåll
            if ($success) {
                if ($post->updatePost($id, $title, $content)) {
                    $message .= "<p class='stored'>Ditt inlägg har ändrats  <i class='fa-solid fa-circle-check'></i></p>";
                } else {
                    $message .= "<p> Fel vid ändring av inlägg </p>";
                }
            } else {
                $message .= "<p class='stored'>Blogginlägg ej lagrat. Kontrollera innehållet och försök igen</p>";
            }
        }


        //Läser in innehållet i inlägget. Redirectar användaren till admin.php om det misslyckas
        $info = $post->getPostById($id);
    } else {
        header("location: admin.php");
    }

    ?>
    <!--Formulär för ändring av inlägg-->
    <form id="admin-form" method="post" action="edit.php?id=<?= $id; ?>">
        <h2>Ändra inlägget <span id="title-span"><?= $info['title'] ?></span></h2>
        <?php
        //Skriver ut felmeddelanden
        if (isset($message)) {
            echo $message;
        }
        ?>
        <div class="centered">
            <div><label for="title">Titel:</label><br></div>
            <div><input type="text" id="title" name="title" value=<?= $info['title']; ?>><br><br></div>
        </div>
        <label for="content" id="contennt">Innehåll:</label><br>
        <textarea id="content" name="content" rows="20"><?= $info['content']; ?></textarea><br><br>
        <!--Använder CKEDITOR-->
        <script>
            CKEDITOR.replace('content');
        </script>
        <input type="submit" value="Spara ändringar">
    </form>
    <!--Slut på formulär-->
    <?php
    include('includes/footer.php')
    ?>