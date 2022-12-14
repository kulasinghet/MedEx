<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link href="../../../public/components/sidebar/src/sidemenu-blob.css" type="text/css" rel="stylesheet"/>
    
    <script src="../../../public/components/sidebar/src/sidemenu-blob.js"></script>
    <title>Supplier | Add New Medicine</title>
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
    <link rel="stylesheet" href="login.css" />
    
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
  <body style = "background-color: #a6cabd;">
  <body>
    <!--Nav Bar-->
<div class='navBar'>
        <div class='navBar__logo'>
            <a href='index.php'><img src='../../../public/res/logo/Logo-text.png' alt='logo' height='40px' width='auto'></a>
        </div>
  <div class='navBar__menu'>
        <ul>
                <li><a href='#'>Home</a></li>
                <li><a href='#'>About</a></li>
                <li><a href='#'>Contact</a></li>
                <li><a href='../../dashboard/supplier/supplierDashboard.php'>Dashboard</a></li>
                <li><a href='../../addMedicine/supplier/addMed.php'>Add New Medicine</a></li>
            </ul>
        </div>
    </div>
    </div>
    <div class='card' style='width: 40%; height: auto; left: 30%; top: 20%;'>
    <div class='card-body'>
      <h2 class='card-title' style='text-align:center;'><img src='../../../public/res/logo/Logo-text.png' alt='logo' height='40px' width='auto'><br>Add New Medicine</h2>
      <p class='card-text'><h1> <?php include('status.php')?></p>
          </div>
        </div>
<!--footer-->
<div style="padding-top: 20%; width: auto; background-color: #a6cabd;">
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