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
    <!-- <link rel="stylesheet" href="stylesheet.css"> -->
  </head>

  <body>
    <h2 class="header">Hockey Player Database</h2>
    <div class="inputDesign">
        <input class="inputDesign" type="text" placeholder="Search..">
    </div>
    <div class="sidenav">
      <a href="/index.php">Home</a>
      <a href="playerDashboard.php">Player Dashboard</a>
      <a href="#clients">View</a>
      <a href="#contact">About</a>
      <a href="adminPages/adminHome.html">Admin</a>
    </div>
    <main>
      <div class="main" style="padding:10px; background-color: rgba(200, 200, 200, 0.8);">
        <form method="post" action="/index.php">
          <div class="tablevals">
            <p style="color: white"> VIEW PLAYERS </p>
              <?php 
                $db = mysqli_connect($servername, $username, $password, $dbname);
                $teamId = $_POST["team"];
                $query = "SELECT * FROM PLAYER WHERE TeamId = '$teamId'";
                $result = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($result);
				$col = mysqli_fetch_fields($result);
				echo "<table style='border:solid white 2px'> <tr>";
				foreach($col as $val) {
					?>
					<td style='border:solid gold 2px'>
					<?php echo "<b>".$val->name."</b>"; ?>
					</td>
					<?php
				}
				echo "</tr>";
	
                while ($row = mysqli_fetch_array($result)) {
					$arr = array_unique($row);
					$count = count($arr);
					?>
					<tr>
					<?php
						foreach ($arr as $value) {
							
							echo "<td style='border:solid white 2px'>".$value."</td>";
						}

                    ?>
		
                  </tr>
                <?php
              } 
			  
			  
            ?>
			</table>
          </div>
          <div>
            <table>
            <tr>
            <td>
                <input type="submit" value="Go Home"></input>
            </td>
            </tr>
            </table>
        </div>
      </form>
      </div>
    </main>
  </body>
  </html>















