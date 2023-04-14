<?php

namespace app\views\pharmacy;

class Components
{
    public function viewHeader($title): string
    {
        $additionalCSS = "";
        if ($title == "Order Medicine") {
            $additionalCSS = "<link href='../css/pharmacy/order-medicine.css' rel='stylesheet'>";
        } else if ($title == "Order History") {
            $additionalCSS = "<link href='../css/pharmacy/orders.css' rel='stylesheet'>";
        }

        return <<<HTML
        <html lang="en">
        <head>
            <meta charset="UTF-8"/>
            <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
            <title>$title | MedEx</title>
            <link href='/css/error-model.css' rel='stylesheet'>
            <link href="../scss/vendor/demo.css" rel="stylesheet"/>
            <link href="../css/table.css" rel="stylesheet"/>
            <link href="../css/pharmacy/dashboard.css" rel="stylesheet"/>

            $additionalCSS
            <link rel="icon" href="../res/logo/logo-box_light.jpg" type="image/svg+xml">
            <!-- Font awesome kit -->
            <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.0/dist/chart.umd.min.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <link href="../css/model.css" rel="stylesheet"/>
            <link rel="icon" href="../res/logo/logo-box_light.jpg" type="image/svg+xml">
            <!-- Font awesome kit -->
            <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">

        </head>
        <body>
        HTML;
    }

    public function navBar($username): string
    {
        $profileURL = "../res/avatar-empty.png";
        if (isset($_SESSION['username'])) {
            $pharmacy = new \app\controllers\entity\Pharmacy($_SESSION['username']);
            if ($pharmacy->getPharmacyProfilePicture($_SESSION['username']) != null) {
                $profileURL = $pharmacy->getPharmacyProfilePicture($_SESSION['username']);
            }
        } {
            return ('
        <nav>
            <div class="nav-search">
                <form onsubmit="preventDefault();" role="search">
                    <label for="search">Search for stuff</label>
                    <input id="search" placeholder="Type anything to search . . ." required type="search"/>
                    <button type="submit">Go</button>
                </form>
            </div>
            <div class="nav-inner">
                <ul>
                    <li><a href="/logout"><i class="fa-solid fa-right-from-bracket"></i></a></li>
              <!--      <li><a href="#"><i class="fa-solid fa-circle-question"></i></a></li> -->
                    <li><a href="/pharmacy/settings"><i class="fa-solid fa-gear"></i></a></li>
         <!--           <li><a href="#"><i class="fa-solid fa-bell"></i></a></li>  -->
                    
                    <div class="nav-profile-inner">
                    <a href="/pharmacy/profile" style="text-decoration: none; color: #071232;">
                        <div class="nav-profile-name">' . $username . '</div>
                        </a>
                    </div>
                    
                </ul>
                <a class="nav-profile" href="/pharmacy/profile">
                    <div class="nav-profile-image">
                        <img alt="Profile image" src="../res/avatar-empty.png"/>
                    </div>
                </a>
            </div>
        </nav>
        ');
        }
    }

    public function sideBar($selectedPage): string
    {
        return ('
        <div class="sidebar">
    <div class="sidebar-inner">
        <nav class="sidebar-header">
            <div class="sidebar-logo">
                <a href="/dashboard">
                    <img alt="MedEx logo" src="../res/logo/logo-text_light.svg"/>
                </a>
            </div>
        </nav>
        <div class="sidebar-context">
            <h6 class="sidebar-context-title">Menu</h6>
            <ul>
                <li>
       
                    <a class="btn ' . ($selectedPage == 'sell-medicine' ? 'disabled' : '') . '" href="/pharmacy/sell-medicine">
                        <i class="fa-solid fa-cash-register"></i> Sell Medicine </a>
                        </li>
                <li>
                    <a class="btn ' . ($selectedPage == 'order-medicine' ? 'disabled' : '') . '" href="/pharmacy/order-medicine"> <i class="fa-solid fa-truck-moving"></i> Order Medicine </a>
                    </li>
                <li>
                    <a class="btn ' . ($selectedPage == 'orders' ? 'disabled' : '') . '" href="/pharmacy/orders"> <i class="fa-solid fa-clock-rotate-left" ></i> Orders </a>
                    </li>
                <li>
                    <a class="btn ' . ($selectedPage == 'inventory' ? 'disabled' : '') . '" href="/pharmacy/inventory"> <i class="fa-sharp fa-solid fa-warehouse"></i> Inventory </a>
                    </li>
                <li>
                    <a class="btn ' . ($selectedPage == 'contact-us' ? 'disabled' : '') . '" href="/pharmacy/contact-us"> <i class="fa-solid fa-phone-volume"></i> Contact Us </a>
                    </li>
            </ul>
        </div>
    </div>
</div>
        ');
    }
}
