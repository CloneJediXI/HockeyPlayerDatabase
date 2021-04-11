<?php
require('adminPages/dbconnect.php');
?>

<!DOCTYPE html>
<html lang="en">

<?php
include('meta/header.html');
?>
  <head>
    <title> NHL Database Site Admin </title>
    <meta name="keywords" content="hockey nhl">
    <meta name="author" content="Group Project">
    <meta charset="UTF-8">
    <!--<link rel="stylesheet" href="../css/stylesheet.css">-->
  </head>

  <body>
    <h2 class="header">Hockey Player Database</h2>
    <div class="sidenav">
      <a href="/index.php">Home</a>
      <a href="#services">Services</a>
      <a href="#clients">View</a>
      <a href="#contact">About</a>
      <a href="adminPages/adminHome.html">Admin</a>
    </div>
    <main>
      <div class="main">
      <form method="post" action="/division.php">
        <div>

          <p style="color: white"> SEARCH RESULTS </p>
            <?php 
              $searchTerm = $_POST["searchTerm"];
              //echo $searchTerm;
              $db = mysqli_connect($servername, $username, $password, $dbname);
              $query = "SELECT * FROM PLAYER WHERE Name='$searchTerm'";
              $result = mysqli_query($db, $query);
              $num_rows = mysqli_num_rows($result);
              if($num_rows == 0) {
                ?><p style="color: white"> Player not found in database!! </p><?php
              }
              for ($i = 0; $i < $num_rows; $i++) {
                  $row = mysqli_fetch_assoc($result);
                  $name = $row["Name"];
                  $teamId = $row["TeamId"];
                  ?>
                    <table>
                    <tr>
                    <td style="color: white">
                        <?php 
                        echo $name . " plays for the "; 
                        $query = "SELECT Name FROM TEAM WHERE TeamId='$teamId'";
                        $result = mysqli_query($db, $query);
                        $row = mysqli_fetch_assoc($result);
                        $teamName = $row["Name"];
                        echo $teamName; 
                        
                        ?>
                    </td>
                    </tr>
                    </table>
                <?php
              } 
            ?>
        </div>
      </form>
      </div>
    </main>
  </body>
</html>
