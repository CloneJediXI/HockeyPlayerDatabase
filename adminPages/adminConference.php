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
			<h1> Conference Table Data</h1>
		</header>
		<main>
            <?php
                // display Conference table data
                $db = mysqli_connect($servername, $username, $password, $dbname);
                $query = "SELECT * FROM CONFERENCE";
                $result = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($result);

                // iterate through the data
                for ($i = 0; $i < $num_rows; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    // get all of the variables
                    $conferenceId = $row["ConferenceId"];
                    $name = $row["NAME"];
                    ?>
                    <div>
                        <table>
                        <tr><td>
                            <?php echo "Conference Id: " . $conferenceId; ?>
                        </td></tr>
                        <tr><td>
                            <?php echo "Name: " . $name; ?>
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
                <a href="adminHome.html"> Back to Admin Home </a>
            </div>
        </main>
		<footer>
		</footer>
	</body>
</html>