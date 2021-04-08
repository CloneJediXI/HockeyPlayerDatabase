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
    <!-- <link rel="stylesheet" href="css/stylesheet.css"> -->
  </head>

  <body>
    <h2 class="header">Hockey Player Database</h2>
    <div class="inputDesign">
        <input class="inputDesign" type="text" placeholder="Search..">
    </div>
    <div class="sidenav">
      <a href="/index.php">Home</a>
      <a href="#services">Services</a>
      <a href="#clients">View</a>
      <a href="#contact">About</a>
      <a href="adminPages/adminHome.html">Admin</a>
    </div>
    <main>
      <div class="main">
        <form method="post" action="/team.php">
          <div>
            <p style="color: white"> SELECT DIVISION </p>
              <?php 
                $db = mysqli_connect($servername, $username, $password, $dbname);
                $conferenceId = $_POST["conference"];
                $query = "SELECT * FROM DIVISION WHERE ConferenceId = '$conferenceId'";
                $result = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($result);
                for ($i = 0; $i < $num_rows; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    $name = $row["NAME"];
                    $divisionId = $row["DivisionId"];
                    ?>
                    <table>
                    <tr>
                    <td>
                      <!-- Radio buttons pull data dynamically from database and pass the divisionId to the POST array which is used to determine which division to show on team.php screen -->
                      <input name="division" value=<?php echo $divisionId; ?> type="radio"></input>
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















