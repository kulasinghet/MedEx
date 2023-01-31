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
$id = $_SESSION['id'];
$sql1 = "SELECT name,verified FROM supplier WHERE id = '$id';";
$result1 = $conn->query($sql1);
$sql2 = "SELECT medicine.id,medName, weight,quantity, unitPrice FROM supplier_medicine, medicine WHERE supplier_medicine.supId='$id' && medicine.id=supplier_medicine.medId;";
$result2 = $conn->query($sql2);

if ($result1->num_rows > 0) {
    echo "<h1>";
    while ($row1 = $result1->fetch_assoc()) 
    {
        echo $row1["name"] . "</h1></br>" . "<h3>Profile Status: ";
        if ($row1["verified"])
        {
            echo "<font color='#17A600'>Verfied </font></h3>";
            if ($result2->num_rows > 0) {
                echo "<br><table style='border: solid 1px black; text-align:center; width:100%'><tr>
                <th>Medicine Name</th>
                <th>Weight</th>	
                <th>Cost</th>	 
                <th>Quantity</th>		
                </tr>";
                // output data of each row
                while ($row2 = $result2->fetch_assoc()) {
                    $medid = $row2["id"];
                    echo "<tr><td>" . $row2["medName"] . "</td><td>" . $row2["weight"] . "mg</td><td>Rs." . $row2["unitPrice"] . "</td><td>" . $row2["quantity"] . "</td><td><a href ='../supplier/editdetails.php?medid=$medid&id=$id'>Update</a></td></tr>";
                }
                echo "</table>";
            } 
            else {
                echo "No medicine added";
        } 
        }
            else {
                echo "<font color='#FF5854'>Unverfied - Sorry you cannot update your inventory as you are unverfied</font></h3> (Please contact adminstration)";

            }
        }
} else {
    echo "Error";
}

$conn->close();
?>