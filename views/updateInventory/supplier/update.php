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
$quantity= $_POST["qty"];
$price = $_POST["unitp"];
$medid =$_GET['medid'];
$id = $_SESSION['id'];

$sql = "UPDATE supplier_medicine SET quantity ='$quantity', unitPrice ='$price' WHERE supplier_medicine.supId='$medid' && supplier_medicine.medId = '$supId';";
if($conn->query($sql) === TRUE) {
  header("location: ../../dashboard/supplier/supplierDashboard.php?id=$supId");
}else {
  echo '<script type="text/javascript">alert("Wrong UserName or Password");window.location=\'login.php\';</script>';
}


?>