<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medex";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$id =$_GET['id'];
$sql = "SELECT name,verified FROM supplier WHERE id = '$id';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  $row["name"]."</h1></br>" . "<h3>Profile Status: ";
        if($row["verified"]){
            echo "<font color='#17A600'>Verfied </font></h3>";
        }
        else{
            echo "<font color='#FF5854'>Unverfied </font></h3>";
        }
    }
} else {
    echo "Error";
}

$conn->close();
?>