<?php

require('dbconnect.php');

?>

<!DOCTYPE html>

<html>

<?php

include('header.html');

?>

<body>

    <h2 class="header">Hockey Player Database</h2>

<div class="inputDesign">

    <input class="inputDesign" type="text" placeholder="Search..">

</div>

<div class="sidenav">

  <a href="#about">Home</a>

  <a href="#services">Services</a>

  <a href="#clients">View</a>

  <a href="#contact">About</a>

</div>



<div class="main">

   
<table>  

<?php

    $query = "SELECT ConferenceId FROM CONFERENCE";

    echo $query;

    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_array($result)) {

        echo '<tr>';

        echo '<td>';

            echo $row['ConferenceId']; 

        echo '</td>';

        echo '</tr>';

    }

?>

</table>

</div>

<div>

<?php



/**$sql = "SELECT * FROM CONFERENCE":

$result = $mysqli_query($conn,$sql);



if (mysqli_num_rows($result)>0) {

 //output table data

 while ($row = mysqli_fetch_array($result)) {

  echo "id: " . $row["ConferenceId"] . " - Name: ".$row["name"];

}



mysqli_free_result($result);

} else {

   echo "0 results";

}



$conn->close();*/

?>



</div>

</body>

</html>



