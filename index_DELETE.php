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
        <h2>Delete by name in sport database</h2>
        <label>Name:</label><input type="text" name="name"><br><br>
        <input type="submit" name="submit1" value="DELETE">
    </form><br>
    <?php //INSERT Query
    if (isset($_POST["submit1"])) {
        $name = $_POST["name"];
        $command = "DELETE FROM sport WHERE name='$name'";;
        $stmt = $dbConn->prepare($command);
        $execOK = $stmt->execute();
        if ($execOK)
        echo "DELETE SQL query successfully executed <br> <br>";
        else
        echo "Error executing DELETE SQL query <br> <br>";
    }
    ?>
    <form action="index_HOME.php">
         <button type="submit">BACK TO HOME</button>
      </form>

</body>

</html>