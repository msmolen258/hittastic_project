<!DOCTYPE html>
<html>

    <head>
        <div class="logo"></div>
    </head>

    <body>
        <?php

        $u= htmlentities ($_POST["username"]);
        $n= htmlentities ($_POST["name"]);   
        $p= htmlentities ($_POST["password"]);

        $conn = new PDO ("mysql:host=localhost;dbname=assign124;", "assign124", "iiV7aezo");
        $statement= $conn->prepare("SELECT * FROM users where username= ?");
        $statement->bindParam(1, $u);
        $statement->execute();
        $row = $statement->fetch();

        if(!ctype_alnum($u) or !ctype_alpha($n) or !ctype_alnum($p) )
        {
            echo "ERROR: Input contains characters other than letters and numbers!";


        } elseif( $row == true ) {
            echo "This username is already in use.";
        }

        else {
            echo "<h1>Congratulation, your accout has been created. Now you can log in!</h1><br/>";

            $stmt= $conn->prepare("INSERT INTO users (name, password,username, isadmin) VALUES (?, ?, ?,0)");
            $stmt->bindParam(1, $n);
            $stmt->bindParam(2, $p);
            $stmt->bindParam(3, $u);    
            $stmt->execute();

        ?>

        <div class="header">
            <p class="logintext"> Insert your login details:</p>
            <form class="login" method="post" action="login.php">
                <input name="username" placeholder="USERNAME" id="username" type="text"/>
                <input name="password" placeholder="PASSWORD" id="password" type="password"/>
                <input type="submit" value="LOG IN" />
            </form> 
        </div>

        <?php } ?>


    </body>

</html>