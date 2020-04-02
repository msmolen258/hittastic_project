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
        <link rel="stylesheet" type="text/css" href="css/seereviewsstyle.css"> 
        <link href="https://fonts.googleapis.com/css?family=Overpass|ZCOOL+QingKe+HuangYou" rel="stylesheet">


        <script type='text/javascript'>
            function writeReview() {

                var xhr2 = new XMLHttpRequest();
                var review = document.getElementById("textreview").value;
                var id = document.getElementById("id").value;

                xhr2.addEventListener ("load", responseReceived2);
                xhr2.open('POST', 'writereview.php');
                xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr2.send("venueID=" + id + "&review=" + review);

            }  

            function responseReceived2(e)
            {

                alert("Thank you! Your review has been sent for admin approval.");
                var box = document.getElementsByName ('addreview')[0];
                box.reset();  // Reset
             


            }

        </script>




    </head>
    <body>
        <div class="logo"></div>
        <div class="loggedas">
            <form id="logout" action="logout.php" method="post">
                <p>You are logged in as: <?php echo $_SESSION["gatekeeper"]; ?> </p>
                <input type="submit" value="Log out!">
            </form>
        </div>

        <div id="left">
            <?php

 $conn = new PDO ("mysql:host=localhost;dbname=assign124;", "assign124", "iiV7aezo");
 $id=  htmlentities ($_GET["venueID"]);

 $venueresult = $conn->query ("select * FROM venues WHERE ID='$id'");
 while($row=$venueresult->fetch()) 
 {

     echo "<h1>Reviews for the venue:<span id='vname'>" . $row["name"] . "</span></h1><br/>";
     echo " <div id='reviews'>";  
 }



 $results = $conn->query("SELECT username, review FROM reviews WHERE venueID='$id' AND approved=1");
 $count = $results->rowCount();

 if ($count == 0) 
 {
     echo "This venue does not have any reviews yet!<br/>";
 } else 

 { 
     while($row=$results->fetch())
     {   
         echo "<div id='onereview'><span id='user'> ". $row["username"] ."</span> : ". $row["review"] ."</div><br/> "; 
     }
 }

 echo "</div>";

            ?>
        </div>        
        <div id="right">
            <form id="addreview" name='addreview' method='post' action='#'>
                <input type='text' id='textreview' placeholder='Write your review here' name='review'> 
                <input type='hidden' value='<?php echo "$id" ?>'  id='id' name='venueID'><br/>
                <input type='button' value='Add!' onclick='writeReview()'>
            </form>

        </div>

        <div id="footer"> Go back to <a href='main.php'> MAIN PAGE </a> </div>

    </body>
</html>

<?php } ?>