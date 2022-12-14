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

$sql = "SELECT pharmacy.name, pharmacy.city FROM pharmacy, deliveryreq WHERE deliveryreq.status=0 && deliveryreq.pharmacyId=pharmacy.id;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table style='border: solid 1px black; text-align:center; width:100%'><tr>
    <th>pharmacy Name</th>
    <th>City</th>		
    </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["name"]."</td><td>" .$row["city"]."</td><td>". "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>