<?php
session_start();
if ( !isset ($_SESSION["gatekeeper"]))
{
    echo "You're not logged in. Create an account!";
    echo "<p><a href='index.html'>Click here </a>to login or register!</p>";
}
else
{
?>

<!DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" type="text/css" href="css/searchresultstyle.css">

    </head>
    <body>

        <?php 

    $t= htmlentities ($_GET["type"]);

    $conn = new PDO ("mysql:host=localhost;dbname=assign124;", "assign124", "iiV7aezo");
    echo "<div class='title'> You are searching for venues by type: $t </br></div>"; 

    $stmt= $conn->prepare("select * from venues where type=?");
    $stmt->bindParam(1, $t);
    $stmt->execute();

    while($row=$stmt->fetch())

    {
        echo "<div class='searchresults'>";
        echo "<span id='row1'> Name: <span id='row1a'> ". $row["name"] ."<br/></span> </span> ";
        echo "<span id='row2'> Description: </span>  ". $row["description"] ."<br/> ";
        echo "Recommendations: <span id='spanvenue" . $row["ID"] . "'>" . $row["recommended"] . "</span>" ;
        echo "<input type='submit' value='Recommend!'  onclick='recommend(". $row["ID"] .")'>";
        echo "<p class='seereviews'> Do you want to read reviews for this venue and ADD yours? <a href='seereviews.php?venueID=". $row["ID"]."'>Click here </a></p>";
        echo "</div>";

    }




        ?>
    </body>
</html>

<?php } 
?>
