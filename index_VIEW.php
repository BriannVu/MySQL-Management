<!-- 
Author: Bao Nam Vu
SID: 991579193
Date: 10th August 2020
Assignment: 6 
-->
<?php
require("connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    try {
        $dbConn = new PDO(
            "mysql:host=$hostname;dbname=$dbname",
            $user,
            $passwd
        );
        echo "Successful connect<br><br>";
    } catch (PDOException $e) {
        echo "Error";
    }
    ?>

    <form method="POST">
        <h2>Search by name</h2>
        Name: <input type="text" name="name">
        <input type="submit" value="Search" name="submit1">
        <input type="submit" value="View all" name="submit2">
    </form><br><br>

    <?php //SELECT Query
    if(isset($_POST["submit2"]) || isset($_POST["submit1"])) 
    try {
        $query = "SELECT * FROM sport";
        select($query, $dbConn);
    } catch (Exception $e) {
    }
    function select($command, $dbObject)
    {
        $stmt = $dbObject->prepare($command);
        $execOK = $stmt->execute();
        $isNotSearch = true;
        $name = $_POST["name"];
        if(isset($_POST["submit1"]) && isset($name)){
            $isNotSearch = false;
        }
        if ($execOK) {
            if ($row = $stmt->fetch()) {
                do {
                    if($isNotSearch || $row["name"]==$name){
                    echo "Sport ID: " . $row["sport_id"] . "<br>";
                    echo "Name: " . $row["name"] . "<br>";
                    echo "Player Count: " . $row["player_count"] . "<br>";
                    echo "Indoor/Outdoor: " . $row["indoor"] . "<br>";
                    echo "Referee Count: " . $row["referee_count"] . "<br>";
                    echo "Country of Origin: " . $row["origin"] . "<br> <br>";
                    }
                } while ($row = $stmt->fetch());
            } else
                echo "There are zero records in the database <br> <br>";
        } else
            echo "Error executing SQL query <br> <br>";
    }
    ?>
    <br><form action="index_HOME.php">
        <button type="submit">BACK TO HOME</button>
    </form>

</body>

</html>