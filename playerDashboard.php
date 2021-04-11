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
      <div class="main" style="padding:10px; background-color: rgba(200, 200, 200, 0.8);">
          <h1 style="text-align:center">Player Dashboard</h1>
      <form method="post" action="/playerDashboard.php" id="mainForm">
        <div>
            <h3 style="color: white"> Refine Results </h3>
            <!-- Specify the Conference-->
            <label for="conference">Conference :</label>
            <select name="conference" id="conference">
                <option value="any">All</option>
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
                    <option value=<?php echo $conferenceId; ?> <?php if($_POST["conference"] ==$conferenceId){echo("selected");}?>><?php echo $name; ?></option>
                <?php
              } 
            ?>
            </select>
            <!-- Specify the Division-->
            <label for="division">Division :</label>
            <select name="division" id="division">
                <option value="any">All</option>
            <?php 
            if($_POST["conference"] != "any"){
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
                        <option value=<?php echo $divisionId; ?> <?php if($_POST["division"] ==$divisionId){echo("selected");}?>><?php echo $name; ?></option>
                <?php
                } 
            }
            ?>
            </select>
            <!-- Specify the Team-->
            <label for="team">Team :</label>
            <select name="team" id="team">
                <option value="any">All</option>
            <?php 
            if($_POST["division"] != "any" && $_POST["conference"] != "any"){
                $db = mysqli_connect($servername, $username, $password, $dbname);
                $divisionId = $_POST["division"];
                $query = "SELECT * FROM TEAM WHERE DivisionId = '$divisionId'";
                $result = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($result);
                for ($i = 0; $i < $num_rows; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    $teamId = $row["TeamId"];
                    $name = $row["Name"];
                    $mascot = $row["Mascot"];
                    $arenaId = $row["ArenaId"];
                    $coachId = $row["CoachId"];
                ?>
                    <option value=<?php echo $teamId; ?> <?php if($_POST["team"] ==$teamId){echo("selected");}?>><?php echo $name; ?></option>
                <?php
                } 
            }
            ?>
            </select>
            <!-- Show the results-->
            <table>
                
                <?php 
                $db = mysqli_connect($servername, $username, $password, $dbname);

                $conf = $_POST["conference"];
                $conferenceWhere = "";
                if($conf == "any"){
                    $conferenceWhere = "SELECT ConferenceId FROM CONFERENCE";
                }else{
                    $conferenceWhere = "SELECT ConferenceId FROM CONFERENCE WHERE ConferenceId = '$conf'";
                }
                /*echo "<p>First Results for '$conferenceWhere'</p>";
                $result = mysqli_query($db, $conferenceWhere);
                $num_rows = mysqli_num_rows($result);
                for ($i = 0; $i < $num_rows; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    $conferenceId = $row["ConferenceId"];
                    ?>

                    <p> it is <?php echo $conferenceId ?>.</p>
                <?php }*/
                
                $div = $_POST["division"];
                $divisionWhere = "";
                if($div == "any"){
                    $divisionWhere = "SELECT DivisionId FROM DIVISION WHERE ConferenceId IN ( $conferenceWhere )";
                }else{
                    $divisionWhere = "SELECT DivisionId FROM DIVISION WHERE DivisionId = '$div'";
                }
                /*echo "<p>First Results for $divisionWhere</p>";
                $result = mysqli_query($db, $divisionWhere);
                $num_rows = mysqli_num_rows($result);
                for ($i = 0; $i < $num_rows; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    $divisionId = $row["DivisionId"];
                    ?>

                    <p> it is<?php echo $divisionId ?>.</p>
                <?php }*/
                
                $team = $_POST["team"];
                $teamWhere = "";
                if($team == "any"){
                    $teamWhere = "SELECT TeamId FROM TEAM WHERE DivisionId IN ( $divisionWhere )";
                }else{
                    $teamWhere = "SELECT TeamId FROM TEAM WHERE TeamId = '$team'";
                }
                /*echo "<p>First Results for $teamWhere</p>";
                $result = mysqli_query($db, $teamWhere);
                $num_rows = mysqli_num_rows($result);
                echo "<p>There are $num_rows rows</p>";
                for ($i = 0; $i < $num_rows; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    $teamId = $row["TeamId"];
                    ?>

                    <p> it is<?php echo $teamId ?>.</p>
                <?php }*/
                
                $query = "SELECT * FROM PLAYER WHERE TeamId IN ( $teamWhere )";
                $result = mysqli_query($db, $query);

                $num_rows = mysqli_num_rows($result);
				$col = mysqli_fetch_fields($result);
				echo " <tr>";
				foreach($col as $val) {
					?>
					<td style='border:solid gold 2px; padding:3px;'>
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
							
							echo "<td style='border:solid white 2px; padding:3px;'>".$value."</td>";
						}

                    ?>
		
                  </tr>
                <?php } ?>
                    
                
            </table>
        </div>
        <script>
            function onchange(e) {
                var form = document.getElementById("mainForm");
                form.submit();
            }
            document.getElementById('conference').addEventListener('change', onchange);
            document.getElementById('division').addEventListener('change', onchange);
            document.getElementById('team').addEventListener('change', onchange);
        </script>
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
