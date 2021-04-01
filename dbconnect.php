 <?php
$servername = "sql108.epizy.com";
$username = "epiz_28161066";
$password = "P8D5mAkIMlj";
$dbname = "epiz_28161066_hockeydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "<script>console.log('connected succesfully')</script>";
?> 