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
    <form method="post" action="/playerSearchResults.php">
      <div class="inputDesign">
          <input class="inputDesign" type="text" name="searchTerm" placeholder="Enter a first and last name to search for a player"></input>
          <input type="submit"></input>
      </div>
    </form>
    <div class="sidenav">
      <a href="/index.php">Home</a>
      <a href="playerDashboard.php">Player Dashboard</a>
      <a href="#clients">View</a>
      <a href="#contact">About</a>
      <a href="adminPages/adminHome.html">Admin</a>
    </div>
    <main>
      <div class="main">
      <form method="post" action="/division.php">
        <div>
          <p style="color: white"> SELECT CONFERENCE </p>
            <?php 
                $db = mysqli_connect($servername, $username, $password, $dbname);
                $query = "SELECT * FROM CONFERENCE";
                $result = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($result);
                for ($i = 0; $i < $num_rows; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    $name = $row["NAME"];
                    $conferenceId = $row["ConferenceId"];
                    ?>
                    <table>
                    <tr>
                    <td>
                      <!-- Radio buttons pull data dynamically from database and pass the conferenceId to the POST array which is used to determine which division to show on division.php screen -->
                      <input name="conference" value=<?php echo $conferenceId; ?> type="radio"></input>
                    </td>
                    <td style="color: white">
                        <?php echo $name; ?>
                    </td>
                    </tr>
                    </table>
                <?php
              } 
            ?>
        </div>
        <div>
            <table>
            <tr>
            <td>
                <input type="submit"></input>
            </td>
            </tr>
            </table>
        </div>
      </form>
      </div>
    </main>
  </body>
</html>
