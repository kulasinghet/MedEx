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

$sql = "SELECT medicine.medName, medicine.weight, stock.remQty, stock.sellingPrice FROM medicine,stock WHERE medicine.id=stock.medId && stock.pharmacyId='P0001';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table style='border: solid 1px black; text-align:center; width:100%'><tr>
    <th>Medicine Name</th>
    <th>Weight</th>	
    <th>Remaining</th>	
    <th>Selling Price</th>		
    </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>". $row["medName"]. "</td><td>" .$row["weight"] ."mg</td><td>" .$row["remQty"]."</td><td>Rs." .$row["sellingPrice"]."</td><td>". "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>