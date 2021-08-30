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
   <title>Player Management</title>
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <header class="alignCen">
      PLAYER MANAGEMENT
      <span id="cntStatus">
         <?php
         try {
            $dbConn = new PDO(
               "mysql:host=$hostname;dbname=$dbname",
               $user,
               $passwd
            );
            echo "Successful Connection<br><br>";
            echo "<script>console.log('Successful Connection');</script><br><br>";
         } catch (PDOException $e) {
            echo "<script>console.log('Connection Error');</script><br><br>";
         }
         ?>
      </span>
   </header>

   <div id="pageBody">
      <!-- INSERT -->
      <div id="insertBox">
         <form method="POST">
            <label>Name:</label><input type="text" name="name" required><br>
            <label>Player count:</label><input type="number" name="playerCount" min="0" required><br>
            <label>Indoor: </label><input type="text" name="indoor" placeholder="i/o" required maxlength="1"><br>
            <label>Referee count: </label><input type="number" name="refereeCount" min="0" required><br>
            <label>Origin: </label><input type="text" name="origin" required><br>
            <input type="submit" name="insert" value="INSERT">
         </form>

         <?php
         if (isset($_POST["insert"])) {
            $name = $_POST["name"];
            $playerCount = $_POST["playerCount"];
            $indoor = $_POST["indoor"];
            $refereeCount = $_POST["refereeCount"];
            $origin = $_POST["origin"];
            $command = "INSERT INTO sport (name, player_count, indoor, referee_count, origin) VALUES ('$name', '$playerCount', '$indoor', '$refereeCount', '$origin')";
            $stmt = $dbConn->prepare($command);
            $execOK = $stmt->execute();
         }
         ?>
      </div>


      <!-- UPDATE -->
      <div id="updateBox">
         <form method="POST">
            <label>Name:</label><input placeholder="Update By Name" type="text" name="name" required><br>
            <label>Player count:</label><input type="number" name="playerCount" min="0" required><br>
            <label>Indoor: </label><input type="text" name="indoor" placeholder="i/o" required maxlength="1"><br>
            <label>Referee count: </label><input type="number" name="refereeCount" min="0" required><br>
            <label>Origin: </label><input type="text" name="origin" required><br>
            <input type="submit" name="update" value="UPDATE">
         </form>

         <?php
         if (isset($_POST["update"])) {
            $name = $_POST["name"];
            $playerCount = $_POST["playerCount"];
            $indoor = $_POST["indoor"];
            $refereeCount = $_POST["refereeCount"];
            $origin = $_POST["origin"];
            $command = "UPDATE sport SET player_count='$playerCount', indoor='$indoor', referee_count='$refereeCount', origin='$origin' WHERE name='$name'";
            $stmt = $dbConn->prepare($command);
            $execOK = $stmt->execute();
         }
         ?>
      </div>
      <hr>

      <!-- VIEW -->
      <form method="POST" class="inline">
         <input type="submit" value="View all" name="view">
      </form>

      <!-- DELETE -->
      <form method="POST" class="inline floatRight">
         <input type="text" placeholder="Name" name="name" required>
         <input type="submit" name="delete" value="DELETE">
      </form>
      <?php
      if (isset($_POST["delete"])) {
         $name = $_POST["name"];
         $command = "DELETE FROM sport WHERE name='$name'";;
         $stmt = $dbConn->prepare($command);
         $execOK = $stmt->execute();
      }
      ?>

      <table>
         <tr>
            <th>Name</th>
            <th>Player count</th>
            <th>Indoor</th>
            <th>Referee count</th>
            <th>Origin</th>
         </tr>

         <?php
         if (isset($_POST["view"]))
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
            if (isset($_POST["submit1"]) && isset($name)) {
               $isNotSearch = false;
            }
            if ($execOK) {
               if ($row = $stmt->fetch()) {
                  do {
                     if ($isNotSearch || $row["name"] == $name) {
                        echo "<tr><td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["player_count"] . "</td>";
                        echo "<td>" . $row["indoor"] . "</td>";
                        echo "<td>" . $row["referee_count"] . "</td>";
                        echo "<td>" . $row["origin"] . "</td></tr>";
                     }
                  } while ($row = $stmt->fetch());
               }
            }
         }
         ?>
      </table>
   </div>
</body>

</html>