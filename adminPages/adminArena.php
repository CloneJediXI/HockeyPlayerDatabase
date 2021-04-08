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
			<h1> Arena Table Data</h1>
            <p> Form to add and delete data at the bottom of the page. </p>
		</header>
		<main>
            <?php
                $db = mysqli_connect($servername, $username, $password, $dbname);

                // set all the variables from the POST array after checking that they are set and not null
                if(isset($_POST["Name"]) && isset($_POST["Capacity"]) && isset($_POST["City"]) &&
                 isset($_POST["StateOrProvince"]) && isset($_POST["Country"])) {
                    if($_POST["Name"] != '' && $_POST["Capacity"] != '' && $_POST["City"]!= '' && 
                        $_POST["StateOrProvince"] != '' && $_POST["Country"] != '') {
                        $name = $_POST["Name"];
                        $capacity = $_POST["Capacity"];
                        $city = $_POST["City"];
                        $stateOrProvince = $_POST["StateOrProvince"];
                        $country = $_POST["Country"];
                        $query = "INSERT INTO ARENA(Name, Capacity, City, StateOrProvince, Country)
                         VALUES('$name', '$capacity', '$city', '$stateOrProvince', '$country')";
                        mysqli_query($db, $query);
                    }
                }

                // code to handle the delete function
                if(isset($_POST["ArenaId"]) && $_POST["ArenaId"] != '') {
                    $query = "SELECT * FROM ARENA";
                    $result = mysqli_query($db, $query);
                    $num_rows = mysqli_num_rows($result);

                    for ($i = 0; $i < $num_rows; $i++) { 
                        $row = mysqli_fetch_assoc($result);
                        $id = $row["ArenaId"];

                        if($_POST["ArenaId"] == $id) {
                            $query = "DELETE FROM ARENA WHERE ArenaId = $id";
                            mysqli_query($db, $query);
                        }
                    }
                }
                
                // display Arena table data
                $query = "SELECT * FROM ARENA";
                $result = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($result);

                // iterate through the data
                for ($i = 0; $i < $num_rows; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    // get all of the variables
                    $arenaId = $row["ArenaId"];
                    $name = $row["Name"];
                    $capacity = $row["Capacity"];
                    $city = $row["City"];
                    $stateOrProvince = $row["StateOrProvince"];
                    $country = $row["Country"];
                    ?>
                    <div>
                        <table>
                        <tr><td>
                            <?php echo "Arena Id: " . $arenaId; ?>
                        </tr></td>
                        <tr><td>
                            <?php echo "Name: " . $name; ?>
                        </tr></td>
                        <tr><td>
                            <?php echo "Capacity: " . $capacity; ?>
                        </tr></td>
                        <tr><td>
                            <?php echo "City: " . $city; ?>
                        </tr></td>
                        <tr><td>
                            <?php echo "State or Province: " . $stateOrProvince; ?>
                        </tr></td>
                        <tr><td>
                            <?php echo "Country: " . $country; ?>
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
                <p>Fill out the form to add an arena to the database.</p>
            </div>
            <div>
                <form method="post" action="/adminPages/adminArena.php"> 
                    <table>
                    <tr><td>
                        <input name="Name" size="25" maxlength="200"> Arena Name </input>
                    </tr></td>
                    <tr><td>
                        <input name="Capacity" size="25" maxlength="200"> Capacity </input>
                    </tr></td>
                    <tr><td>
                        <input name="City" size="25" maxlength="200"> City </input>
                    </tr></td>
                    <tr><td>
                        <input name="StateOrProvince" size="25" maxlength="200"> State or Province </input>
                    </tr></td>
                    <tr><td>
                        <input name="Country" size="25" maxlength="200"> Country </input>
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
                <p> Enter an Arena Id to remove it from the database. </p>
            </div>
            <div>
                <form method="post" action="/adminPages/adminArena.php"> 
                    <table>
                    <tr><td>
                        <input name="ArenaId" size="10" maxlength="7"> Arena Id </input>
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