<?php

$rid= $_POST["ID"]; 
$conn = new PDO ("mysql:host=localhost;dbname=assign124;", "assign124", "iiV7aezo");

$stmt= $conn->prepare("UPDATE reviews SET approved = 1 WHERE ID= ?");
$stmt->bindParam(1, $rid);
$stmt->execute();

echo "The review has been approved!";



?>