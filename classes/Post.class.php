
   <?php
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
            //SQL Fråga
            $sql = "UPDATE posts SET title='" . $this->title . "',content= '" . $this->content . "' WHERE id=$id;";
            //Skicka fråga
            return mysqli_query($this->db, $sql);
        }

        //Metod för att hämta ett specifikt inlägg med ID
        public function getPostById(int $id): array
        {
            $sql = "SELECT * FROM posts where id=$id;";
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
        function getPostsFromUser()
        {
            $escaped_get = $this->db->real_escape_string($_GET['email']);

            $sql = "SELECT * FROM posts WHERE email='" . $escaped_get . "'";
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


        //Set-metoder
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
