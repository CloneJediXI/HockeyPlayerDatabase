<!-- 
Created by: Group Project
COSC 471
Winter 2021 -->

<?php 
    include 'dbconnect.php';
?>

<!-- <?php 
    // Test the conncetion to the remote database
    mysqli_connect($servername, $username, $password, $dbname);
    if (mysqli_connect_errno())
        print "not connected";
    else
        print "connected";
?> -->

<!DOCTYPE html>
<html lang="en">
	<head>
		<title> NHL Database Site Admin </title>
		<meta name="keywords" content="hockey nhl">
		<meta name="author" content="Group Project">
		<meta charset="UTF-8">
		<!-- <link rel="stylesheet" href="stylesheet.css"> -->
	</head>
	<body> 
		<header>
			<h1> Player Table Data</h1>
            <p>This will list all of the players from the PLAYER table and allow deletions/additions. To add a new player, a TeamId MUST be provided so I have it set up to display all of the relevent info on this page in addition to the current players in the database.</p>
		</header>
		<main>

			<?php
                $db = mysqli_connect($servername, $username, $password, $dbname);

                // set all the variables from the POST array after checking that they are set and not null
                if(isset($_POST["TeamId"]) && isset($_POST["Name"]) && isset($_POST["Birthdate"]) &&
                 isset($_POST["Number"]) && isset($_POST["Height"]) && isset($_POST["Weight"]) && isset($_POST["Hometown"]) && isset($_POST["Position"]) && isset($_POST["GamesPlayed"]) && isset($_POST["Goals"]) && isset($_POST["Assists"])) {
                    if($_POST["TeamId"] != '' && $_POST["Name"] != '' && $_POST["Birthdate"]!= '' && 
                        $_POST["Number"] != '' && $_POST["Height"] != '' && $_POST["Weight"] != '' && $_POST["Hometown"] != '' && $_POST["Position"] != '' && $_POST["GamesPlayed"] != '' && $_POST["Goals"] != '' && $_POST["Assists"] != '') {
                        $teamId = $_POST["TeamId"];
                        $name = $_POST["Name"];
                        $birthdate = $_POST["Birthdate"];
                        $number = $_POST["Number"];
                        $height = $_POST["Height"];
                        $weight = $_POST["Weight"];
                        $hometown = $_POST["Hometown"];
                        $position = $_POST["Position"];
                        $gamesPlayed = $_POST["GamesPlayed"];
                        $goals = $_POST["Goals"];
                        $assists = $_POST["Assists"];
						$wins = $_POST["Wins"];
                        $query = "INSERT INTO PLAYER(TeamId, Name, Birthdate, Number, Height, Weight, Hometown, Position, GamesPlayed, Goals, Assists, Wins)
                         VALUES('$teamId', '$name', '$birthdate', '$number', '$height', '$weight', '$hometown', '$position', '$gamesPlayed', '$goals', '$assists', '$wins')";
                        mysqli_query($db, $query);
                    }
                }

                // code to handle the delete function
                if(isset($_POST["PlayerId"]) && $_POST["PlayerId"] != '') {
                    $query = "SELECT * FROM PLAYER";
                    $result = mysqli_query($db, $query);
                    $num_rows = mysqli_num_rows($result);

                    for ($i = 0; $i < $num_rows; $i++) { 
                        $row = mysqli_fetch_assoc($result);
                        $id = $row["PlayerId"];

                        if($_POST["PlayerId"] == $id) {
                            $query = "DELETE FROM PLAYER WHERE PlayerId = $id";
                            mysqli_query($db, $query);
                        }
                    }
                }

                echo "##################### TEAM ID'S #####################";
                ?><br><?php
                $query = "SELECT TeamId, Name FROM TEAM";
                $result = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($result);
                for ($i = 0; $i < $num_rows; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    $name = $row["Name"];
                    $teamId = $row["TeamId"];
                    ?>

                    <div>
                    <table>
                    <tr><td>
                        <?php echo "Team Name: " . $name; ?>
                    </td>
                    <td>
                        <?php echo "***" ?>
                    </td>
                    <td>
                        <?php echo "Team Id: " . $teamId; ?>
                    </td></tr>
                    </table>
                    </div>
                    <div>
                    <tr><td>
                        <?php echo "------------------------------------------------------------------" ?>
                    </td></tr>
                    </div>
                    <?php
                }

                // display Player table data
                ?><br><?php
                echo "##################### PLAYERS #####################";
                ?><br><?php
                $query = "SELECT * FROM PLAYER";
                $result = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($result);

                // iterate through the data
                for ($i = 0; $i < $num_rows; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    // get all of the variables
                    $playerId = $row["PlayerId"];
                    $teamId = $row["TeamId"];
                    $name = $row["Name"];
                    $birthdate = $row["Birthdate"];
                    $number = $row["Number"];
                    $height = $row["Height"];
                    $weight = $row["Weight"];
                    $hometown = $row["Hometown"];
                    $position = $row["Position"];
                    $gamesPlayed = $row["GamesPlayed"];
                    $goals = $row["Goals"];
                    $assists = $row["Assists"];
					$wins = $row["Wins"];
                    ?>
                    <div>
                        <table>
                        <tr><td>
                            <?php echo "Player Id: " . $playerId; ?>
                        </tr></td>
                        <tr><td>
                            <?php echo "Team Id: " . $teamId; ?>
                        </tr></td>
                        <tr><td>
                            <?php echo "Name: " . $name; ?>
                        </tr></td>
                        <tr><td>
                            <?php echo "Birthdate: " . $birthdate; ?>
                        </tr></td>
                        <tr><td>
                            <?php echo "Number: " . $number; ?>
                        </tr></td>
                        <tr><td>
                            <?php echo "Height: " . $height; ?>
                        </tr></td>
                        <tr><td>
                            <?php echo "Weight: " . $weight; ?>
                        </td></tr>
                        <tr><td>
                            <?php echo "Hometown: " . $hometown; ?>
                        </td></tr>
                        <tr><td>
                            <?php echo "Position: " . $position; ?>
                        </td></tr>
                        <tr><td>
                            <?php echo "Games Played: " . $gamesPlayed; ?>
                        </td></tr>
                        <tr><td>
                            <?php echo "Goals: " . $goals; ?>
                        </td></tr>
                        <tr><td>
                            <?php echo "Assists: " . $assists; ?>
                        </td></tr>
			<tr><td>
                            <?php echo "Wins: " . $wins; ?>
                        </td></tr>
	
                        </table>
                    </div>
                    <div>
                        <p>##############################</p>
                    </div>
                    <?php
                }
            ?>

            <div>
                <p>Fill out the form to add a player to the database.</p>
            </div>
            <div>
                <form method="post" action="/adminPages/adminPlayer.php"> 
                    <table>
				
                    <tr><td>
                        <input name="TeamId" size="25" maxlength="200"> Enter a valid team id </input>
                    </tr></td>
                    <tr><td>
                        <input name="Name" size="25" maxlength="200"> Player Name  </input>
                    </tr></td>
                    <tr><td>
                        <input name="Birthdate" size="25" maxlength="200"> Birthdate </input>
                    </tr></td>
                    <tr><td>
                        <input name="Number" size="25" maxlength="200"> Player jersey number </input>
                    </tr></td>
                    <tr><td>
                        <input name="Height" size="25" maxlength="200"> Player height </input>
                    </tr></td>
                    <tr><td>
                        <input name="Weight" size="25" maxlength="200"> Player weight </input>
                    </tr></td>
                    <tr><td>
                        <input name="Hometown" size="25" maxlength="200"> Player hometown </input>
                    </tr></td>
                    <tr><td>
                        <input name="Position" size="25" maxlength="200"> Player position </input>
                    </tr></td>
                    <tr><td>
                        <input name="GamesPlayed" size="25" maxlength="200"> Number of games played </input>
                    </tr></td>
                    <tr><td>
                        <input name="Goals" size="25" maxlength="200"> Number of goals </input>
                    </tr></td>
                    <tr><td>
                        <input name="Assists" size="25" maxlength="200"> Number of assists </input>
                    </tr></td>
		    <tr><td>
                        <input name="Wins" size="25" maxlength="200"> Number of wins </input>
                    </tr></td>

                    <tr><td>
                        <input type="submit"></input>
                    </tr></td>
                    </table>
                </form>
            </div>
            <div>
                <p>##############################</p>
            </div>
            <div>
                <p> Enter a Player Id to remove the player from the database. </p>
            </div>
            <div>
                <form method="post" action="/adminPages/adminPlayer.php"> 
                    <table>
                    <tr><td>
                        <input name="PlayerId" size="10" maxlength="7"> Player Id </input>
                    </tr></td>
                    <tr><td>
                        <input type="submit"></input>
                    </td></tr>
                    </table>
                </form>
            </div>

            <div>
                <a href="/adminHome.html"> Back to Admin Home </a>
            </div>
		</main>
	</body>
</html>