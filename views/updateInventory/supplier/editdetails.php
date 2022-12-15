<!DOCTYPE html>
<html lang="en">
  <head>
    <link href="../../../public/components/sidebar/src/sidemenu-blob.css" type="text/css" rel="stylesheet"/>
    
    <script src="../../../public/components/sidebar/src/sidemenu-blob.js"></script>
    <title>Update Inventory</title>
    <link href="../../../public/css/homepage/footer.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/homepage/carousel.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/homepage/navbar.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/homepage/homepage.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/homepage/registerPopup.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/homepage/loginPopup.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/search.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/felxbox.css" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="../../../public/sass/main.css" />
    <link rel="stylesheet" href="../../../public/css/supplier/formcss.css" />
    
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <!-- Font awesome kit -->
    <script src="https://kit.fontawesome.com/9b33f63a16.js" crossorigin="anonymous"></script>
    <!--chart JS--->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
  </head>
  <body>
sorigin="anonymous"
  ></script>
<!-- Nav Bar-->
    <div class="navBar">
        <div class="navBar__logo">
            <a href="index.php"><img src="../../../public/res/logo/Logo-text.png" alt="logo" height="40px" width="auto"></a>
        </div>

<!--Nav Bar-->
        <div class="navBar__menu">
        <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="../../updateInventory/supplier.php"> Update Inventory</a></li>
                <li><a href="#">Add New Medicine</a></li>
            </ul>
        </div>
    </div>
<!--Profile-->
<div class="card" style="width: 30%; height: auto; left: 35%; top: 20%;">
  <div class="card-body">
    <h2 class="card-title" style="text-align:center;"><img src="../../../public/res/logo/Logo-text.png" alt="logo" height="40px" width="auto"></h2>
    <p class="card-text">
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
      $medid =$_GET['medid'];
      $supId = $_GET['id'];
      $sql1 = "SELECT medName,weight,quantity, unitPrice FROM supplier_medicine, medicine WHERE supplier_medicine.supId='$supId' && supplier_medicine.medId = '$medid' && medicine.id=supplier_medicine.medId;";
      $result1 = $conn->query($sql1);
      while ($row1 = $result1->fetch_assoc()) {
        $medname = $row1['medName'];
        $weight = $row1['weight'];
        $unitp = $row1['unitPrice'];
        $qty = $row1['quantity'];
        echo "<h2>$medname - $weight mg</h2>";
        echo " <form method='post' action='update.php?medid=$medid&id=$supId' enctype='multipart/form-data'> Quantity: <input type='text' name='qty' value='$qty' class='input-box'><br>Unit Price: <input type ='text' name='unitp' value='$unitp'class='input-box'>";
        echo "<input type='submit' value='Update' class='button'>
        </form>";
      }
      ?>
  </p>
  </div>
</div>
<!--footer-->
<div style="padding-top: 30%; width: auto;">
    <footer class="footer-distributed">

        <div class="footer-left">
    
            <h3>Med<span>Ex</span></h3>
    
            <p class="footer-links">
                <a href="#" class="link-1">Home</a>
                <a href="#">About</a>
    
                <a href="#">Contact</a>
            </p>
    
    
        </div>

        <div class="footer-center">
    
    
            <p class="footer-site-tm">
                <span>Team Members</span>
            <li class="tm-color">R.D.T.D. Kulasinghe </li>
            <li class="tm-color">I.A.P.P. Wijegunawardana </li>
            <li class="tm-color">W.D.D.N. Dharmathunga </li>
            <li class="tm-color">M.C.W. Samarasinghe </li>
            </p>
        </div>
    
        <div class="footer-right">
            <p class="footer-site-right">© 2022 Group 28, All Right reserved</p>
    
        </div>
    
    </footer>
    </div>

  </body>
</html>