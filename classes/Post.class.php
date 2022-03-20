   <?php
    /*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-03-17 19:54:36 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-03-20 20:38:22
 */


    class Post
    {
        //Properties
        private $db; //Databas-anslutning
        private $title; //Inläggets titel
        private $content; //Inläggets innehåll
        private $email;



        //Konstruktor med databasanslutning
        function __construct()
        {
            $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

            //Kontrollerar om det finns något fel
            if ($this->db->connect_errno > 0) {
                die("Fel vid anslutning" . $this->db->connect_error);
            }
        }

        //Lägg till inlägg
        public function addPost(string $title, string $content, $email): bool
        {
            //Kontrollerar om set-metoder är uppfyllda
            if (!$this->setTitle($title)) return false;
            if (!$this->setContent($content)) return false;


            //Använder real_escape_string för att undvika att skadlig kod hamnar i databasen
            $this->db->real_escape_string($title);
            $this->db->real_escape_string($content);

            //Använder strip_tags för att ta bort HTML-taggar. Tillåter vissa taggar för utskriftens skull
            $content = strip_tags($content, '<p><strong><em><a><ul><ol><li><br>');
            $title = strip_tags($title);


            //SQL fråga
            $sql = "INSERT INTO posts(email,title, content)VALUES('" . $_SESSION['email'] . "', '" . $this->title . "', '" . $this->content . "');";

            //Skicka frågan till servern
            return mysqli_query($this->db, $sql);
        }


        //Uppdatera inlägg
        public function updatePost(int $id, string $title, string $content): bool
        {
            //Kontrollerar om set-metoder är uppfyllda
            if (!$this->setTitle($title)) return false;
            if (!$this->setContent($content)) return false;

            //Använder real_escape_string för att undvika att skadlig kod hamnar i databasen
            $this->db->real_escape_string($title);
            $this->db->real_escape_string($content);

            //Använder strip_tags för att ta bort HTML-taggar. Tillåter vissa taggar för utskriftens skull
            $content = strip_tags($content, '<p><strong><em><a><ul><ol><li><br>');
            $title = strip_tags($title);



            //SQL Fråga
            $sql = "UPDATE posts SET title='" . $this->title . "',content= '" . $this->content . "' WHERE id=$id;";
            //Skicka fråga
            return mysqli_query($this->db, $sql);
        }

        //Metod för att hämta ett specifikt inlägg med ID
        public function getPostById(int $id): array
        {
            //Gör en LEFT JOIN för att kunna hämta användarens bloggnamn
            $sql = "SELECT posts.*, users.blog_name
            FROM posts
            LEFT JOIN users ON posts.email = users.email
            where id=$id;";
            $result = mysqli_query($this->db, $sql);

            return $result->fetch_assoc();
        }


        //Metod för att hämta inlägg från den inloggade användaren
        public function getPostByUser(): array
        {

            $sql = "SELECT * FROM posts where email='" . $_SESSION['email'] . "' ORDER BY created DESC";

            $result = mysqli_query($this->db, $sql);

            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }




        //Metod för att läsa ut en viss användares inlägg
        function getPostsFromUser(): array
        {
            $escaped_get = $this->db->real_escape_string($_GET['user']);

            //Använder strip_tags för att ta bort HTML-taggar.
            $escaped_get = strip_tags($escaped_get);


            //SQL-query med LEFT JOIN för att få användarens bloggnamn
            $sql = "SELECT posts.*, users.blog_name
            FROM posts 
                LEFT JOIN users ON posts.email = users.email
                WHERE blog_name='" . $escaped_get . "'
            ORDER BY created DESC;";

            $result = $this->db->query($sql);

            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }



        //Ta bort inlägg
        public function deletePost(int $id): bool
        {
            $id = intval($id);

            //SQL fråga
            $sql = "DELETE from posts WHERE id=$id";

            //Skicka frågan
            return mysqli_query($this->db, $sql);
        }


        /*Set-metoder
        */

        //Metod som kontrollerar att textfält inte är tomt
        public function setTitle(string $title): bool
        {
            if ($title != "") {
                $this->title = $title;
                return true;
            } else {
                return false;
            }
        }




        //Metod som kontrollerar att textfält inte är tomt
        public function setContent(string $content): bool
        {
            if ($content != "") {
                $this->content = $content;
                return true;
            } else {
                return false;
            }
        }

        //Läs ut inlägg
        public function getPosts(): array
        {
            //SQL fråga. Sorterar så att de nyaste inläggen kommer överst
            $sql = "SELECT posts.*, users.blog_name
            FROM posts 
                LEFT JOIN users ON posts.email = users.email
            ORDER BY created DESC;";
            $result = mysqli_query($this->db, $sql);

            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }




        //Destruktor
        function __destruct()
        {
            mysqli_close($this->db);
        }
    }
