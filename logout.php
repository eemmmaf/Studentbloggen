<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-03-17 19:56:39 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-03-17 19:57:11
 */


include('includes/config.php');
unset($_SESSION["email"]);
header("Location:index.php");
?>