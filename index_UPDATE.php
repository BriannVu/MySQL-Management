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
        echo "Successful connect<br>";
    } catch (PDOException $e) {
        echo "Error";
    }
    ?>
    <form method="POST">
        <h2>Update into sport database by name</h2>
        <u><b>Search by</b></u> <br>
        <label>Name:</label><input type="text" name="name"><br>
        <u><b>Update</b></u> <br>
        <label>Player count:</label><input type="number" name="playerCount" min="0"><br>
        <label>Indoor: </label><input type="text" name="indoor" placeholder="i/o"><br>
        <label>Referee count: </label><input type="number" name="refereeCount" min="0"><br>
        <label>Origin: </label><input type="text" name="origin"><br><br>
        <input type="submit" name="submit1" value="UPDATE">
    </form><br>
    
    <?php //INSERT Query
    if (isset($_POST["submit1"])) {
        $name = $_POST["name"];
        $playerCount = $_POST["playerCount"];
        $indoor = $_POST["indoor"];
        $refereeCount = $_POST["refereeCount"];
        $origin = $_POST["origin"];
        $command = "UPDATE sport SET player_count='$playerCount', indoor='$indoor', referee_count='$refereeCount', origin='$origin' WHERE name='$name'";
        $stmt = $dbConn->prepare($command);
        $execOK = $stmt->execute();
        if ($execOK)
        echo "UPDATE SQL query successfully executed <br> <br>";
        else
        echo "Error executing UPDATE SQL query <br> <br>";
    }
    ?>
<form action="index_HOME.php">
     <button type="submit">BACK TO HOME</button>
  </form>

</body>

</html>