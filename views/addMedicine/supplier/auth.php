<?php
session_start();
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
$med_name = $_POST["name"];
$weight= $_POST["weight"];
$sciname = $_POST["sciname"];
$manid= $_POST["manufacture"];
$id = $_SESSION['id'];

// Get med ID
$result1 = $conn->query("SELECT * from medicine;");
$count1 = $result1->num_rows +1;
$num1 = (string) $count1;
$medid = 'Med000'.$num1;
// Enter detials to DB
$sql1= "INSERT INTO medicine (id,medName, weight, sciName, manId) VALUES ('$medid', '$med_name', '$weight', '$sciname', '$manid')";
$result2 = $conn->query($sql1);
// Get Lab Req Id
$result3 = $conn->query("SELECT * from labreq;");
$count2 = $result3->num_rows +1;
$num2 = (string) $count2;
$reqid = 'Req00'.$num2;

// Enter Lab req to DB

$sql2= "INSERT INTO labreq (id, medId, SupId,status) VALUES ('$reqid','$medid','$id', 0)";
$result4 = $conn->query($sql2);

if($result2 && $result4) {
  $_SESSION['reqid'] = $reqid;
  header("location: ../../addMedicine/supplier/sucess.php");
}else {
  echo '<script type="text/javascript">alert("Something is wrong please try again!");window.location=\'addMed.php\'</script>';
}

?>