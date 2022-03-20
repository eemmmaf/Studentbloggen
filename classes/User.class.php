<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-03-17 19:54:36 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-03-20 17:50:36
 */

class User
{
    private $email;
    private $blogname;
    private $password;
    private $fname;
    private $ename;
    private $db;

    //Konstruktor med databasanslutning
    function __construct()
    {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

        //Kontrollerar om det finns något fel
        if ($this->db->connect_errno > 0) {
            die("Fel vid anslutning" . $this->db->connect_error);
        }
    }



    //Metod som kontrollerar att textfält inte är tomt
    public function setFname(string $fname): bool
    {
        if ($fname != "") {
            $this->fname = $fname;
            return true;
        } else {
            return false;
        }
    }

    //Metod som kontrollerar att textfält inte är tomt
    public function setEname(string $ename): bool
    {
        if ($ename != "") {
            $this->ename = $ename;
            return true;
        } else {
            return false;
        }
    }

    //Metod som kontrollerar att den angivna emailadressen är i korrekt format med funktionen filter_var
    public function setEmail(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL && $email != "")) {
            $this->email = $email;
            return true;
        } else {
            return false;
        }
    }

    //Kontrollerar att lösenordet är minst 8 tecken långt
    public function setPassword(string $password): bool
    {
        if (strlen($password) >= 8) {
            $this->password = $password;
            return true;
        } else {
            return false;
        }
    }


    //Setmetod för att kolla så att inte fältet är tomt
    public function setBlogname(string $blogname): bool
    {
        if (strlen($blogname) >= 5) {
            $this->blogname = $blogname;
            return true;
        } else {
            return false;
        }
    }

    //Metod för att registrera användare
    public function registerUser($email, $blogname, $password, $ename, $fname)
    {


        //Kontrollerar om set-metoder är uppfyllda
        if (!$this->setEmail($email)) return false;
        if (!$this->setPassword($password)) return false;
        if (!$this->setBlogname($blogname)) return false;
        if (!$this->setEname($ename)) return false;
        if (!$this->setFname($fname)) return false;


        //Hashar lösenordet
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        //Använder real_escape_string för att undvika att skadlig kod hamnar i databasen
        $blogname = $this->db->real_escape_string($blogname);
        $email = $this->db->real_escape_string($email);
        $password = $this->db->real_escape_string($password);
        $fname = $this->db->real_escape_string($fname);
        $ename = $this->db->real_escape_string($ename);

        //Använder strip_tags för att ta bort HTML-taggar
        $blogname = strip_tags($blogname);
        $email = strip_tags($email);
        $password = strip_tags($password);
        $fname = strip_tags($fname);
        $ename = strip_tags($ename);


        $sql = "INSERT INTO users(blog_name, email, password, fname, ename) VALUES('$blogname', '$email', '$hashed_password', '$fname', '$ename')";

        $result = $this->db->query($sql);

        return $result;
    }


    //Metod för att logga in 
    public function logIn(string $email, string $password): bool
    {
        $email = $this->db->real_escape_string($email);
        $password = $this->db->real_escape_string($password);

        $email = strip_tags($email);
        $password = strip_tags($password);


        //SQL-fråga
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];

            //Kontrollerar det inmatade lösenordet mot det lagrade lösenordet
            if (password_verify($password, $stored_password)) {
                $_SESSION['email'] = $email;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Kontroll för att se om bloggnamnet och mailen finns
    public function uniqueNames(string $blogname, string $email): bool
    {
        $blogname = $this->db->real_escape_string($blogname);
        $mail = $this->db->real_escape_string($email);

        //SQL-fråga
        $sql = "SELECT blog_name, email FROM users WHERE blog_name='$blogname' OR email='$mail'";
        $result = $this->db->query($sql);


        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }


    //Läs ut användare
    public function getUsers(): array
    {
        //SQL fråga. Sorterar så att de nyaste inläggen kommer överst
        $sql = "SELECT * FROM users ORDER BY created DESC;";
        $result = mysqli_query($this->db, $sql);

        //Returnerar resultatet i en associativ array
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }


    //Metod för att hämta info om den inloggade användaren
    public function getUserInfo(): array
    {

        $sql = "SELECT * FROM users where email='" . $_SESSION['email'] . "'";

        $result = mysqli_query($this->db, $sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

     //Destruktor
     function __destruct()
     {
         mysqli_close($this->db);
     }
}
