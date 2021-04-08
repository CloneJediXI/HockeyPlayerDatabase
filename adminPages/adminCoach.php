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
			<h1> Coach Table Data</h1>
            <p> Form to add and delete data at the bottom of the page. </p>
		</header>
		<main>
            <?php
                $db = mysqli_connect($servername, $username, $password, $dbname);

                // set all the variables from the POST array after checking that they are set and not null
                if(isset($_POST["Name"]) && isset($_POST["StartDate"])) {
                    if($_POST["Name"] != '' && $_POST["StartDate"] != '') {
                        $name = $_POST["Name"];
                        $startDate = $_POST["StartDate"];
                        $query = "INSERT INTO COACH(Name, StartDate)
                         VALUES('$name', '$startDate')";
                        mysqli_query($db, $query);
                    }
                }

                // code to handle the delete function
                if(isset($_POST["CoachId"]) && $_POST["CoachId"] != '') {
                    $query = "SELECT * FROM COACH";
                    $result = mysqli_query($db, $query);
                    $num_rows = mysqli_num_rows($result);

                    for ($i = 0; $i < $num_rows; $i++) { 
                        $row = mysqli_fetch_assoc($result);
                        $id = $row["CoachId"];

                        if($_POST["CoachId"] == $id) {
                            $query = "DELETE FROM COACH WHERE CoachId = $id";
                            mysqli_query($db, $query);
                        }
                    }
                }

                // display Coach table data
                $query = "SELECT * FROM COACH";
                $result = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($result);

                // iterate through the data
                for ($i = 0; $i < $num_rows; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    // get all of the variables
                    $coachId = $row["CoachId"];
                    $name = $row["Name"];
                    $startDate = $row["StartDate"];
                    ?>
                    <div>
                        <table>
                        <tr><td>
                            <?php echo "Coach Id: " . $coachId; ?>
                        </tr></td>
                        <tr><td>
                            <?php echo "Name: " . $name; ?>
                        </tr></td>
                        <tr><td>
                            <?php echo "Start Date: " . $startDate; ?>
                        </tr></td>
                        </table>
                    </div>
                    <div>
                        <p>##############################</p>
                    </div>
                    <?php
                }
            ?>
            <div>
                <p>Fill out the form to add a coach to the database.</p>
            </div>
            <div>
                <form method="post" action="/adminPages/adminCoach.php"> 
                    <table>
                    <tr><td>
                        <input name="Name" size="25" maxlength="200"> Coach Name </input>
                    </tr></td>
                    <tr><td>
                        <input name="StartDate" size="25" maxlength="200"> Start Date </input>
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
                <p> Enter a Coach Id to remove it from the database. </p>
            </div>
            <div>
                <form method="post" action="/adminPages/adminCoach.php"> 
                    <table>
                    <tr><td>
                        <input name="CoachId" size="10" maxlength="7"> Coach Id </input>
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
		<footer>
		</footer>
	</body>
</html>