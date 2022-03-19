<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-03-17 19:54:36 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-03-18 21:13:29
 */


//Autoload för klasser
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.class.php'; 
});

//Startar session
session_start();

//Lägger till titel
$site_title = "Studentblogg";
$divider = " - ";

//Variabel för inställning av databasanslutnings-uppgifter
$developer = true;
if($developer){
//Databasanslutning lokal server
define("DBHOST", "localhost");
define("DBUSER", "Bloggportalen");
define("DBPASS", "Password");
define("DBDATABASE", "bloggportalen");
// Aktiverar Felmeddelanden 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

}else{
//Databasanslutning för publicerad webbplats
define("DBHOST", 'studentmysql.miun.se');
define("DBUSER", 'emfo2102');
define("DBPASS", 'X8jyGSt@dW');
define("DBDATABASE", 'emfo2102');
}


?>