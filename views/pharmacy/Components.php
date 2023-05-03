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
        } else if ($title == "Inventory") {
            $additionalCSS = "<link href='../css/pharmacy/inventory.css' rel='stylesheet'>";
        } else if ($title == "Sell Medicine") {
            $additionalCSS = "<link href='../css/pharmacy/sell-medicine.css' rel='stylesheet'>";
        } else if ($title == "Invoices") {
            $additionalCSS = "<link href='../css/pharmacy/invoices.css' rel='stylesheet'>";
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
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
            <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
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
        $profileURL = "res/avatar-empty.png";
        if (isset($_SESSION['username'])) {
            $pharmacy = new \app\controllers\entity\Pharmacy($_SESSION['username']);
            if ($pharmacy->getPharmacyProfilePicture($_SESSION['username']) != null) {
                $profileURL = $pharmacy->getPharmacyProfilePicture($_SESSION['username']);
            }
        } {
            return ('
        <nav>
            <div class="nav-search">
               
            </div>
            <div class="nav-inner">
                <ul>
                    <li><a href="/logout"><i class="fa-solid fa-right-from-bracket"></i></a></li>
              <!--      <li><a href="#"><i class="fa-solid fa-circle-question"></i></a></li> -->
                    
                    <div class="nav-profile-inner">
                    <a href="/pharmacy/profile" style="text-decoration: none; color: #071232;">
                        <div class="nav-profile-name">' . $username . '</div>
                        </a>
                    </div>
                    
                </ul>
                <a class="nav-profile" href="/pharmacy/profile">
                    <div class="nav-profile-image">
                        <img alt="Profile image" src="' . $profileURL . '"/>
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
                    <a class="btn ' . ($selectedPage == 'invoices' ? 'disabled' : '') . '" href="/pharmacy/invoices"> <i class="fa-solid fa-file-invoice-dollar"></i> Bills </a>
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
