<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-03-18 10:30:08 
 * @Last Modified by:   Emma Forslund - emfo2102 
 * @Last Modified time: 2022-03-18 10:30:08 
 */

$page_title = "Inlägg";

include('includes/config.php');
//Kontroll för att se om användaren är inloggad. Olika navigeringar visas beroende på om användare är inloggad eller ej
if (isset($_SESSION['email'])) {
    include('includes/header-user.php');
} else {
    include('includes/header-public.php');
}
//Kontroll för att se om ID är skickat. Redirectar till startsidan om det misslyckas
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    header("location: index.php");
}

//Anropar metoden som hämtar inlägg baserat på inläggets id
$post = new Post();
$info = $post->getPostById($id);
?>
<main>
    <div class="detail">
        <!--Utskrift av inlägg-->
        <article class="latest">
            <h2><?= $info['title'] ?></h2>
            <p class="posted">Postat: <?= $info['created'] ?>
            | Bloggare: <?= $info['blog_name'] ?></p>
            <?= $info['content'] ?>
        </article>
    </div>


<?php
include('includes/footer.php')
?>