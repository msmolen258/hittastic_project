<?php

$rid=  htmlentities ($_POST["ID"]); 
$conn = new PDO ("mysql:host=localhost;dbname=assign124;", "assign124", "iiV7aezo");

$stmt= $conn->prepare("DELETE FROM  reviews  WHERE ID= ?");
$stmt->bindParam(1, $rid);
$stmt->execute();


echo "The review has been removed!";

?>