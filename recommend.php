<?php

$conn = new PDO ("mysql:host=localhost;dbname=assign124;", "assign124", "iiV7aezo");
$id=  htmlentities ($_POST["venueID"]);

$results = $conn->query("UPDATE venues SET  recommended = recommended + 1 WHERE ID= '$id'");
$result = $conn->query("SELECT * FROM venues WHERE ID= '$id'");
 

while($row=$result->fetch())
{
echo $row["recommended"];
}

?>