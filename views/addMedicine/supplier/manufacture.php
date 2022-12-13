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

$sql="SELECT id,name FROM manufacture;"; 
$result = $conn->query($sql);


echo "<select name='manufacture' value='' class='input-box' required>Manufacture Name</option>";

while($row = $result->fetch_assoc()){

echo "<option value=$row[id]> $row[name] </option>"; 

};
?>