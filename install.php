<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-03-17 19:56:39 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-03-18 16:02:46
 */


include('includes/config.php');

//Anslut
$db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
if($db->connect_errno > 0) {
    die("Fel vid anslutning" . $db->connect_error);
}

//SQL-fråga
$sql = "DROP TABLE IF EXISTS posts, users;";

$sql .= "
CREATE TABLE posts(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(128) NOT NULL,
    content TEXT NOT NULL,
    created timestamp NOT NULL DEFAULT current_timestamp(),
    email VARCHAR(60) NOT NULL
    ); 
    
    CREATE TABLE users(
    email VARCHAR(60) PRIMARY KEY NOT NULL UNIQUE,
    blog_name VARCHAR(60) NOT NULL UNIQUE,
    password VARCHAR(128),
    created timestamp NOT NULL DEFAULT current_timestamp(),
    fname VARCHAR(50),
    ename VARCHAR(50));

    
ALTER TABLE posts
ADD FOREIGN KEY (email) REFERENCES users(email);

";
    

echo "<pre> $sql </pre>";

//SKicka till servern
if($db->multi_query($sql)){
    echo "Tabell installerad";
}else{
    "Fel vid installation av tabell";
}

?>