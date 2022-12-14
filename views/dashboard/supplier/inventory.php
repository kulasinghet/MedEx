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
$sql = "SELECT medName, weight,quantity, unitPrice FROM supplier_medicine, medicine WHERE supplier_medicine.supId='$id' && medicine.id=supplier_medicine.medId;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table style='border: solid 1px black; text-align:center; width:100%'><tr>
    <th>Medicine Name</th>
    <th>Weight</th>	
    <th>Cost</th>	 
    <th>Quantity</th>		
    </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>". $row["medName"]. "</td><td>" .$row["weight"] ."mg</td><td>Rs." .$row["unitPrice"]."</td><td>" .$row["quantity"]."</td><td>". "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

