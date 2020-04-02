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
        <title>Night out</title>
        <link rel="stylesheet" type="text/css" href="css/mainstyle.css"> 
        <link href="https://fonts.googleapis.com/css?family=Overpass|ZCOOL+QingKe+HuangYou" rel="stylesheet">

        <script type='text/javascript'>

            function addVenue()
            {
                var xhr3 = new XMLHttpRequest();
                
                var type = document.getElementById("type").value;
                var name = document.getElementById("vname").value;
                var description = document.getElementById("descriptiontext").value;
                
                
                xhr3.addEventListener ("load", responseReceived3);
                xhr3.open('POST', '/~assign124/addvenue.php');
                xhr3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                
                
                // Send the request.
                xhr3.send("vname=" + name  + "&type=" + type + "&description=" + description);
            }

            function responseReceived3(e)
            {
                var textanswer = e.target.responseText;
                alert (textanswer);
            }
            
            
            
            
            function seeVenues()
            { 
                var xhr2 = new XMLHttpRequest();
                
                var venue_type = document.getElementById("vtype").value;
                
                xhr2.addEventListener ("load", responseReceived);
                xhr2.open('GET', '/~assign124/searchvenues.php?type=' + venue_type);
                // Send the request.
                xhr2.send();
            }

            function responseReceived(e)
            {
                document.getElementById('venues').innerHTML = e.target.responseText;
            }



            function recommend(id)
            { 
                var xhr = new XMLHttpRequest();            
                xhr.addEventListener ("load", response2Received);
                xhr.open('POST', 'recommend.php');
                // Send the request
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.venue = id;
                xhr.send("venueID=" + id);

            }

            function response2Received(event)
            {   var span = 'spanvenue' + event.target.venue;
                document.getElementById(span).innerHTML = event.target.responseText;


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
        <div class="addvenue">
            <p class="add">Do you want to add a new venue?</p>

            <form id="add" method="post">

                <label for="name"> Name of the venue: </label>
                <input id="vname" type="text" placeholder="Full name of a venue"  name="vname"><br>


                <label for="type">Type:</label>
                <input id="type" type="text" placeholder="For example: pub, cinema, restaurant" name="type"><br>


                <label for="description">Description:</label>
                <input id="descriptiontext" type="text" placeholder="A brief description of a place" name="description"><br> 

                <input type="submit" value="Add new venue!" onclick="addVenue()">

            </form>
        </div> 


        <p>Do you want search for venue?</p>
        <form class="search" action="#" method="get">
            <p>Please enter the venue type:
                <input id="vtype"  onkeyup="seeVenues()"/>
                <input type="submit" value="Go!" onclick="seeVenues()" />
            </p>
        </form>


        <div id="venues"> </div>



    </body>

</html>

<?php } 
?>
