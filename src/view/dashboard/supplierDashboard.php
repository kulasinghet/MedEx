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
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <!-- Font awesome kit -->
    <script src="https://kit.fontawesome.com/9b33f63a16.js" crossorigin="anonymous"></script>
  </head>
  <body>
<!-- Side Pannel -->

    <div id="sidebar">
      <div class="sidebar-toggle">
        <i class="fa-solid fa-bars"></i>
      </div>
      <div class="sidebar-inner">
        <div class="sidebar-context">
          <div class="sidebar-logo">
            <a href="#">
              <img src="../../../public/res/logo/Logo-text.png" alt="MedEx Logo with name" width="100%" />
            </a>
          </div>
          <div class="sidebar-list">
            <a class="sidebar-list-itm" href="#">Menu Item</a>
            <a class="sidebar-list-itm" href="#">Menu Item</a>
            <a class="sidebar-list-itm" href="#">Menu Item</a>
            <a class="sidebar-list-itm" href="#">Menu Item</a>
          </div>
        </div>
      </div>
    </div>

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

<!--Graph and other dummy content-->
<div class = "flexbox" style="width: 265px; height: 300px; left: 200px; top: 192px;">
</div>
    <div class="flexbox" style="width: 600px;height: 300px; left: 600px;top: 192px;">
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

 <script src="../../../public/components/graphs/graph.js"></script>

<!--footer-->
<div style="padding-top: 40%; padding-left: 50px;">
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