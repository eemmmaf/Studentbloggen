<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-03-17 19:54:36 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-03-20 20:14:07
 */
?>
</main>
<footer>
    <div class="footer-flex">
        <div>
            <h2>Studentblogg</h2>
            <ul>
                <?php
                if (isset($_SESSION['email'])) {
                    echo ' <li><a href="about.php">Om oss </a></li>
    <li><a href="create.php">Skapa inlägg </a></li>
    <li><a href="admin.php">Mina sidor</a></li>
    <li><a href="logout.php">Logga ut</a></li>';
                } else {
                    echo ' <li><a href="index.php">Startsidan</a></li>
        <li><a href="login.php">Logga in</a></li>
        <li><a href="register.php">Skapa blogg</a></li>
        <li><a href="about.php">Om bloggportalen</a></li>';
                } ?>
            </ul>
        </div>
        <div>
            <h2>Kontakt</h2>
            <a href="mailto:emfo2102@student.miun.se">emfo2102@student.miun.se</a>
        </div>
    </div>
</footer>
<footer class="footer">
    <p>Skapad av: Emma Forslund, 2022</p>
</footer>
<script src="js/main.js"></script>
</body>

</html>