<?php
session_start();
$u= $_SESSION["gatekeeper"];    
$id= htmlentities ($_POST["venueID"]);
$p = htmlentities ($_POST["review"]);    

$conn = new PDO ("mysql:host=localhost;dbname=assign124;", "assign124", "iiV7aezo");


$stmt= $conn->prepare("INSERT INTO reviews (venueID, review,  username, approved) VALUES (?, ?,'$u', 0)");
$stmt->bindParam(1, $id);
$stmt->bindParam(2, $p);
$stmt->execute();

?>