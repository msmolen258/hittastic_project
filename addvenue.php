<?php
session_start();
$u= $_SESSION["gatekeeper"];    
$n = htmlentities ($_POST["vname"]);
$t = htmlentities ($_POST["type"]);
$d = htmlentities ($_POST["description"]);



$conn = new PDO ("mysql:host=localhost;dbname=assign124;", "assign124", "iiV7aezo");

$stmt= $conn->prepare("INSERT INTO venues (name , type , description, recommended, username) VALUES (?, ?, ?, 0 ,'$u')");
$stmt->bindParam(1, $n);
$stmt->bindParam(2, $t);
$stmt->bindParam(3, $d);
$stmt->execute();


echo "Congratulation , you've just added new venue!\n Name of the venue: $n \n Type of the venue: $t \n Description: $d";


?> 

