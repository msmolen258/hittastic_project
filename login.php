<!DOCTYPE html>
<html>

    <head>
        <title>Night out</title>
        <link rel="stylesheet" type="text/css" href="css/styleindex.css">
        <link href="https://fonts.googleapis.com/css?family=ZCOOL+QingKe+HuangYou" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Overpass|ZCOOL+QingKe+HuangYou" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Knewave" rel="stylesheet">

    </head>

    <body>

        <?php

        session_start();

        $un = $_POST["username"];
        $pw = $_POST["password"];

        if(!ctype_alnum($un) or !ctype_alnum($pw) )
        {
            echo "ERROR: Input contains characters other than letters and numbers!";
        } else {
            $conn = new PDO("mysql:host=localhost; dbname=assign124;", "assign124", "iiV7aezo");

            $stmt= $conn->prepare("SELECT * FROM users WHERE username=? AND password= ?");
            $stmt->bindParam(1, $un);
            $stmt->bindParam(2, $pw);
            $stmt->execute();
            $row = $stmt->fetch();    

            if($row == false) 
            { ?>
        <script> 
            alert ("Ooops! The pasword or login are wrong! Try again or sign up.");
            location="index.html";
        </script>    
        <?php     
            } elseif($row["isadmin"] == "1") 
            { 
                $_SESSION["gatekeeper"] = $un;
                $_SESSION ["adminverification"] = $row['isadmin'];
                header ("Location: adminsite.php");

            }

            else {
                $_SESSION["gatekeeper"] = $un;
                header ("Location: main.php");
            }
        }
        ?>
        
    </body>

</html>