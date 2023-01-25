<?php

namespace app\views\pharmacy;

class Components
{
    public function viewHeader($title): string
    {
        return <<<HTML
        <html lang="en">
        <head>
            <meta charset="UTF-8"/>
            <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
            <title>$title</title>
            <link href="../scss2/vendor/demo.css" rel="stylesheet"/>
            <link href="../css/table.css" rel="stylesheet"/>
            <!-- Font awesome kit -->
            <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
        </head>
        <body>
        HTML;
    }

    public function navBar($username)
    {
        {
            return ('
        <nav>
            <div class="nav-search">
                <form onsubmit="preventDefault();" role="search">
                    <label for="search">Search for stuff</label>
                    <input id="search" placeholder="Search..." required type="search"/>
                    <button type="submit">Go</button>
                </form>
            </div>
            <div class="nav-inner">
                <ul>
                    <li><a href="#"><i class="fa-solid fa-circle-question"></i></a></li>
                    <li><a href="#"><i class="fa-solid fa-gear"></i></a></li>
                    <li><a href="#"><i class="fa-solid fa-bell"></i></a></li>
                    
                    <div class="nav-profile-inner">
                        <div class="nav-profile-name">' . $username . '</div>
                    </div>
                    
                </ul>
                <a class="nav-profile" href="#">
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
                        <i class="fa-solid fa-usd"></i> Sell Medicine </a>
                <li>
                    <a class="btn ' . ($selectedPage == 'order-medicine' ? 'disabled' : '') . '" href="/pharmacy/order-medicine"> <i class="fa fa-shopping-cart"></i> Order Medicine </a>
                </li>
                <li>
                    <a class="btn ' . ($selectedPage == 'orders' ? 'disabled' : '') . '" href="/pharmacy/orders"> <i class="fa-solid fa-list"></i> Orders </a>
                <li>
                    <a class="btn ' . ($selectedPage == 'inventory' ? 'disabled' : '') . '" href="/pharmacy/inventory"> <i class="fa-solid fa-box"></i> Inventory </a>
                <li>
                    <a class="btn ' . ($selectedPage == 'contact-us' ? 'disabled' : '') . '" href="/pharmacy/contact-us"> <i class="fa-solid fa-envelope"></i> Contact Us </a>
            </ul>
        </div>
    </div>
</div>
        ');
    }

}
