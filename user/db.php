<?php
$serveur = "localhost";
$name = "antic";
$user = "root";
$pass = "";

 
 try {
     $db= new PDO("mysql:host=$serveur;dbname=$name",$user,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8', PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
    
 } catch (Exception $e) {
    die("Une erreur est survenue"); 
 }
?>

