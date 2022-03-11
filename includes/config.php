<?php
//Autoload för klasser
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.class.php'; 
});

//Startar session
session_start();


$developer = true;

if($developer){
//Databasanslutning lokal server
define("DBHOST", "localhost");
define("DBUSER", "Bloggportalen");
define("DBPASS", "Password");
define("DBDATABASE", "bloggportalen");


//Felmeddelanden 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
}

?>