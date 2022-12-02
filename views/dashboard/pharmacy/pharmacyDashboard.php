<!DOCTYPE html>
<html lang="en">
  <head>
    <link href="../../../public/components/sidebar/src/sidemenu-blob.css" type="text/css" rel="stylesheet"/>
    
    <script src="../../../public/components/sidebar/src/sidemenu-blob.js"></script>
    <title>Pharmacy Dashboard</title>
    <link href="../../../public/css/homepage/footer.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/homepage/carousel.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/homepage/navbar.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/homepage/homepage.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/homepage/registerPopup.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/homepage/loginPopup.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/search.css" type="text/css" rel="stylesheet"/>
    <link href="../../../public/css/felxbox.css" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="../../../public/sass/main.css" />
    
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

<!--register popup for the Are you a page?-->
        <div class="register-modal">
            <div class="register-modal-content">
                <span class="register-close-button">×</span>
                <div class="register-modal-content__title">
                    <h1>Are you a?</h1>
                    <button>Pharmacy</button>
                    <button>Supplier</button>
                    <button>Delivery Partner</button>
                    <button>Laboratory</button>
                    <button>Staff</button>
                </div>
            </div>
        </div>
        <div class="login-modal">
            <div class="login-modal-content">
                <span class="login-close-button">×</span>
                <div class="login-modal-content__title">
                    <h1>Are you a?</h1>
                    <button>Pharmacy</button>
                    <button>Supplier</button>
                    <button>Delivery Partner</button>
                    <button>Laboratory</button>
                    <button>Staff</button>
                </div>
            </div>
        </div>
        <div class="navBar__menu">
            <ul>
                <li><a href="/index.php">Home</a></li>
                <li><a href="/index.php?page=about">About</a></li>
                <li><a href="/index.php?page=contact">Contact</a></li>
                <li><button id="login" class="login-trigger">Login</button></li>
                <li><button id="register" class="register-trigger">Register</button></li>
            </ul>
        </div>
    </div>
    <!--search-->
<div class="wrap">
    <div class="search">
       <input type="text" class="searchTerm" placeholder="Start typing anything to search">
       <button type="submit" class="searchButton">
         <i class="fa fa-search"></i>
      </button>
    </div>
 </div>
<!--Graph-->
<div class="card" style="width: 600px; height: 300px; left: 200px; top: 192px;">
  <div class="card-body">
    <h3 class="card-title" style="text-align:center;">Sales This Month </h3>
    <p class="card-text">
      <canvas id="myChart" style="width: 450px; height: 200px; padding: auto;"></canvas>
    </p>
    <script>
      var xValues = [50,60,70,80,90,100,110,120,130,140,150];
var yValues = [7,8,8,9,9,9,10,11,14,14,15];

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
    label: 'Sales',
      fill: false,
      lineTension: 0,
      backgroundColor: "rgb(6, 79, 147)",
      borderColor: "rgb(6, 79, 147)",
      data: yValues
    }]
  },
  options: {
    legend: {display:false},
    scales: {
      yAxes: [{ticks: {min: 6, max:16}}],
    }
  }
});
    </script>

  </div>
</div>
<!--Table-->
<div class="card" style="width: 800px; height: 50%; left: 300px; top: 40%;">
  <div class="card-body">
    <h3 class="card-title" style="text-align:center;">Inventory </h3>
    <p class="card-text">

    </br>
      <?php
    include("dbconnection.php");
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