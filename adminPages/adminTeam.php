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
			<h1> Team Table Data</h1>
            <p>This will list all of the teams from the TEAM table and allow deletions/additions. To add a new team, a DivisionId, CoachId, and ArenaId MUST be provided so I have it set up to display all of the relevent info on this page in addition to the current teams in the database.</p>
		</header>
		<main>
            <?php
                $db = mysqli_connect($servername, $username, $password, $dbname);

                // set all the variables from the POST array after checking that they are set and not null
                if(isset($_POST["Name"]) && isset($_POST["Mascot"]) && isset($_POST["DivisionId"]) &&
                 isset($_POST["ArenaId"]) && isset($_POST["CoachId"])) {
                    if($_POST["Name"] != '' && $_POST["Mascot"] != '' && $_POST["DivisionId"]!= '' && 
                        $_POST["ArenaId"] != '' && $_POST["CoachId"] != '') {
                        $name = $_POST["Name"];
                        $mascot = $_POST["Mascot"];
                        $divisionId = $_POST["DivisionId"];
                        $arenaId = $_POST["ArenaId"];
                        $coachId = $_POST["CoachId"];
                        $query = "INSERT INTO TEAM(Name, Mascot, DivisionId, ArenaId, CoachId)
                         VALUES('$name', '$mascot', '$divisionId', '$arenaId', '$coachId')";
                        mysqli_query($db, $query);
                    }
                }

                // code to handle the delete function
                if(isset($_POST["TeamId"]) && $_POST["TeamId"] != '') {
                    $query = "SELECT * FROM TEAM";
                    $result = mysqli_query($db, $query);
                    $num_rows = mysqli_num_rows($result);

                    for ($i = 0; $i < $num_rows; $i++) { 
                        $row = mysqli_fetch_assoc($result);
                        $id = $row["TeamId"];

                        if($_POST["TeamId"] == $id) {
                            $query = "DELETE FROM TEAM WHERE TeamId = $id";
                            mysqli_query($db, $query);
                        }
                    }
                }

                echo "##################### DIVISION ID'S #####################";
                ?><br><?php
                $query = "SELECT DivisionId, NAME FROM DIVISION";
                $result = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($result);
                for ($i = 0; $i < $num_rows; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    $name = $row["NAME"];
                    $divisionId = $row["DivisionId"];
                    ?>

                    <div>
                    <table>
                    <tr><td>
                        <?php echo "Division Name: " . $name; ?>
                    </td>
                    <td>
                        <?php echo "***" ?>
                    </td>
                    <td>
                        <?php echo "Division Id: " . $divisionId; ?>
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
                ?><br><?php
                echo "##################### ARENA ID'S #####################";
                ?><br><?php
                $query = "SELECT ArenaId, Name FROM ARENA";
                $result = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($result);
                for ($i = 0; $i < $num_rows; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    $name = $row["Name"];
                    $arenaId = $row["ArenaId"];
                    ?>

                    <div>
                    <table>
                    <tr><td>
                        <?php echo "Arena Name: " . $name; ?>
                    </td>
                    <td>
                        <?php echo "***" ?>
                    </td>
                    <td>
                        <?php echo "Arena Id: " . $arenaId; ?>
                    </td></tr>
                    </table>
                    </div>
                    <div>
                        <?php echo "------------------------------------------------------------------" ?>
                    </div>
                    <?php
                }
                ?><br><?php
                echo "##################### COACH ID'S #####################";
                ?><br><?php
                $query = "SELECT CoachId, Name FROM COACH";
                $result = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($result);
                for ($i = 0; $i < $num_rows; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    $name = $row["Name"];
                    $coachId = $row["CoachId"];
                    ?>

                    <div>
                    <table>
                    <tr><td>
                        <?php echo "Coach Name: " . $name; ?>
                    </td>
                    <td>
                    <?php echo "***" ?>
                    </td>
                    <td>
                        <?php echo "Coach Id: " . $coachId; ?>
                    </td>
                    <tr><td>
                    </table>
                    </div>
                    <div>
                        <?php echo "------------------------------------------------------------------" ?>
                    </div>
                    <?php
                }




                // display Team table data
                ?><br><?php
                echo "##################### TEAMS #####################";
                ?><br><?php
                $query = "SELECT * FROM TEAM";
                $result = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($result);

                // iterate through the data
                for ($i = 0; $i < $num_rows; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    // get all of the variables
                    $teamId = $row["TeamId"];
                    $name = $row["Name"];
                    $mascot = $row["Mascot"];
                    $divisionId = $row["DivisionId"];
                    $arenaId = $row["ArenaId"];
                    $coachId = $row["CoachId"];
                    ?>
                    <div>
                        <table>
                        <tr><td>
                            <?php echo "Team Id: " . $teamId; ?>
                        </tr></td>
                        <tr><td>
                            <?php echo "Name: " . $name; ?>
                        </tr></td>
                        <tr><td>
                            <?php echo "Mascot: " . $mascot; ?>
                        </tr></td>
                        <tr><td>
                            <?php echo "Division Id: " . $divisionId; ?>
                        </tr></td>
                        <tr><td>
                            <?php echo "Arena Id: " . $arenaId; ?>
                        </tr></td>
                        <tr><td>
                            <?php echo "Coach Id: " . $coachId; ?>
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
                <p>Fill out the form to add a team to the database.</p>
            </div>
            <div>
                <form method="post" action="/adminPages/adminTeam.php"> 
                    <table>
                    <tr><td>
                        <input name="Name" size="25" maxlength="200"> Team Name </input>
                    </tr></td>
                    <tr><td>
                        <input name="Mascot" size="25" maxlength="200"> Team Mascot </input>
                    </tr></td>
                    <tr><td>
                        <input name="DivisionId" size="25" maxlength="200"> Enter a valid division id </input>
                    </tr></td>
                    <tr><td>
                        <input name="ArenaId" size="25" maxlength="200"> Enter a valid arena id </input>
                    </tr></td>
                    <tr><td>
                        <input name="CoachId" size="25" maxlength="200"> Enter a valid coach id </input>
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
                <p> Enter a Team Id to remove it from the database. </p>
            </div>
            <div>
                <form method="post" action="/adminPages/adminTeam.php"> 
                    <table>
                    <tr><td>
                        <input name="TeamId" size="10" maxlength="7"> Team Id </input>
                    </tr></td>
                    <tr><td>
                        <input type="submit"></input>
                    </td></tr>
                    </table>
                </form>
            </div>

            <div>
                <a href="adminHome.html"> Back to Admin Home </a>
            </div>
        </main>
		<footer>
		</footer>
	</body>
</html>