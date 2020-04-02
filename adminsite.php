<?php
session_start();
if ( !isset ($_SESSION["adminverification"]))
{
    echo "Access restricted!";
    echo "<p><a href='main.php'>Click here </a>to go to the main page!</p>";
}
else
{
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/adminsstyle.css">
           <link href="https://fonts.googleapis.com/css?family=Overpass|ZCOOL+QingKe+HuangYou" rel="stylesheet">
        <script type='text/javascript'>

           function accept(id)
            { 
                var xhr2 = new XMLHttpRequest();
                xhr2.addEventListener ("load", responseReceived);
                xhr2.open('POST', 'approvereview.php');
                xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");         
                xhr2.send("ID=" + id);
            }

            function responseReceived(e)
            {
                alert("Review has been approved!");
                location.reload();
                
                
            }

            
            
            function remove(id)
            { 
                var xhr = new XMLHttpRequest();
                xhr.addEventListener ("load", responseReceived3);
                xhr.open('POST', 'removereview.php');
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");         
                xhr.send("ID=" + id);
            }

            function responseReceived3(e)
            {
                alert("Review has been removed!");
                location.reload();
                
                
            }
            
        </script>

    </head>


    <body>
        <div class="logo"></div>

        <div class="loggedas">
            <form id="logout" action="logout.php" method="post">
                <label>You are logged in as: <?php echo $_SESSION["gatekeeper"]; ?></label>
                <input type="submit" value="Log out!">
            </form>
        </div>
        <div class="pendingreviews">

            <h1>PENDING REVIEWS</h1>
            <?php

 $conn = new PDO ("mysql:host=localhost;dbname=assign124;", "assign124", "iiV7aezo");
 $results = $conn->query(" select v.name,r.review, r.ID, r.username from venues AS v inner join reviews AS r on v.ID = r.venueID where approved=0");

 echo "<table>" ;
 echo "<tr>";
 echo "<th> Review ID <br/></th>";
 echo "<th> Name of the venue<br/></th>";
 echo "<th> Sent by<br/></th>";
 echo "<th> Review <br/></th>";
 echo "<th> Approve <br/></th>";
 echo "<th> Remove <br/></th>";
 echo "</tr>";

 while($row=$results->fetch())

 {   
     echo "<tr>";
     echo "<td>". $row["ID"] ."<br/></td> ";
     echo "<td> ". $row["name"] ." <br/> </td>"; 
     echo "<td>". $row["username"] ."<br/> </td> "; 
     echo "<td>". $row["review"] ."<br/></td> "; 

     echo "<td> <a href='#' onclick=accept(". $row["ID"].")> Click to approve</a></br></td></form>"; 
     echo "<td> <a href='#' onclick=remove(". $row["ID"].")> Click to remove</a></br></td></form>"; 
     echo "</tr>";

 }
 echo "</table>";

            ?>

<p id="mainpage"> Want to load main page? <a href='main.php'> Click here </a> </p>
        </div>
        
    </body>

</html>

<?php } 
?>