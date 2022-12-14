<?php
$id = $_SESSION['id'];
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

$sql1 = "SELECT name,verified FROM supplier WHERE id = '$id';";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    while ($row1 = $result1->fetch_assoc()) 
    {
        echo $row1["name"] . "</h1></br>" . "<h3>Profile Status: ";
        if ($row1["verified"])
        {
        echo "<font color='#17A600'>Verfied </font></h3><br>
            <form action='auth.php' method='post' enctype='multipart/form-data'>
            Medicine Name<br><input type='text' name='name' class='input-box' required><br>
              Weight (mg)<br><input type='text' name='weight' class='input-box' required><br>
              Scientific Name<br><input type='text' name='sciname' class='input-box' required><br>
              Manufacture<br>"; include('manufacture.php'); echo "<br>
              <input type='hidden' name='supid' value='<?php echo $id;?>'>
              <br><input type='submit' value='Add New Medicine' class='button'>
              </form>";
        }
            else {
                echo "<font color='#FF5854'>Unverfied<br>
                Sorry you cannot add medicine as you are unverfied</font></h3>
                (Please contact adminstration)";

            }
        }
} else {
    echo "Error";
}
?>