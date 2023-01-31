<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link href="../../../public/components/sidebar/src/sidemenu-blob.css" type="text/css" rel="stylesheet"/>
    
    <script src="../../../public/components/sidebar/src/sidemenu-blob.js"></script>
    <title>Supplier Dashboard</title>
    <link href="../../../public/css/homepage/footer.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/homepage/carousel.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/homepage/navbar.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/homepage/homepage.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/homepage/registerPopup.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/homepage/loginPopup.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/search.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/felxbox.css" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="../../../deprecated/scss/main.css" />
    
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
    <!--Nav Bar-->
<div class='navBar'>
        <div class='navBar__logo'>
            <a href='index.php'><img src='../../../public/res/logo/Logo-text.png' alt='logo' height="40%" width="40%"></a>
        </div>
  <div class='navBar__menu'>
        <ul>
                <li><a href='#'>Home</a></li>
                <li><a href='#'>About</a></li>
                <li><a href='#'>Contact</a></li>
                <li><a href='../../dashboard/supplier/supplierDashboard.php'>Dashboard</a></li>
                <li><a href='../../addMedicine/supplier/addMed.php'>Add New Medicine</a></li>
                <li><a href='../../logoutPage/supplier/logout.php'>Logout</a></li>
            </ul>
        </div>
    </div>
    <!--Message-->
    <div class="card" style="width: 50%; height: auto; left: 25%; top: 20%;">
  <div class="card-body">
    <h2 class="card-title" style="text-align:center;"><img src="../../../public/res/logo/Logo-text.png" alt="logo"height="40%" width="40%"><br>New Medicine Request Sent</h2>
    <p class="card-text">
       <h3>Your new medicine request has being sent.</h3>
      <br>Lab request ID: <?php echo $_SESSION['reqid']; ?><br>
       Please send the reqested samples to the lab to approve your request
    </p>
  </div>
</div>
  </body>
</html>