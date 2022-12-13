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
$supplier_name = $_POST["name"];
$supplier_username= $_POST["username"];
$supplier_password = $_POST["pswd"];
$email= $_POST["email"];
$address = $_POST["address"];
$mobile = $_POST["mobile"];
$supplier_Reg = $_POST["supRegNum"];
$Business_Reg = $_POST["busiRegNum"];
$supplier_cert = $_POST["supCertId"];

// Get id
$result1 = $conn->query("SELECT * from supplier;");
$count = $result1->num_rows +1;
$num = (string) $count;
$supId = 'S000'.$num;

// Uploading file

$file1 = $_FILES["BusRegiCert"];
$file2 = $_FILES["SuppRegiCert"];
$file_ext1 = explode('.', $file1['name']);
$file_ext1 = strtolower(end($file_ext1));
$file_ext2 = explode('.', $file2['name']);
$file_ext2 = strtolower(end($file_ext2));


if($file1['size']<= 3145728 && $file2['size']<= 3145728){
  $BusRegiCert_Name_New = "business0".$num.".".$file_ext1;
  $SuppRegiCert_Name_New = "supplier0".$num.".".$file_ext2;
  $filedestination1 = 'uploads/businessRegCert/'. $BusRegiCert_Name_New;
  $filedestination2 = 'uploads/supplierRegCert/'. $SuppRegiCert_Name_New;
  move_uploaded_file($file1['tmp_name'], $filedestination1);
  move_uploaded_file($file2['tmp_name'], $filedestination2);
}

// Enter detials to DB

$sql1= "INSERT INTO supplier (id, username, password, name, supplierRegNo, BusinessRegId, supplierCertId, BusinessRegCertName, supplierCertName, verified) VALUES ('$supId', '$supplier_username', '$supplier_password', '$supplier_name', '$supplier_Reg', '$Business_Reg', '$supplier_cert', '$BusRegiCert_Name_New', '$SuppRegiCert_Name_New', 0)";
$result2 = $conn->query($sql1);
$sql2 = "INSERT INTO supplier_contact (id, email, address, mobile) VALUES ('$supId', '$email', '$address', '$mobile')";
$result2 = $conn->query($sql2);

if($result1 && $result2) {
  header("location: ../../registerPage/supplier/sucess.php");
}else {
  echo '<script type="text/javascript">alert("Something is wrong please try again!");window.location=\'register.php\';</script>';
}


?>