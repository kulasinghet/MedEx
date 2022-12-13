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
$supplier_username= $_POST["username"];
$supplier_password = $_POST["pswd"];
$sql = "SELECT id FROM supplier  WHERE username='$supplier_username' && supplier.password='$supplier_password';";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$supId = $row["id"];
if($result->num_rows > 0) {
  header("location: ../../dashboard/supplier/supplierDashboard.php?id=$supId");
}else {
  echo '<script type="text/javascript">alert("Wrong UserName or Password");window.location=\'login.php\';</script>';
}


?>