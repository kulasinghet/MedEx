<html lang="en">
<head>
    <title>Order History</title>
    <link rel="stylesheet" href="/css/delivery/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/delivery/sidepanel.css">
    <link rel="stylesheet" href="/css/delivery/dashboard.css">
<!--    <script src="js/pharmacy/.js"></script>-->
</head>

<body>

<!--Nav Bar-->
<div class="navbar">
    <div class="logo">
        <a href="/"><img src="/res/logo/logo.svg" alt="logo"></a>
    </div>
    <div class="links">
        <a href="/dashboard">Dashboard</a>
        <a href="/delivery/profile">Profile</a>
        <a href="/logout">Logout</a>
    </div>
</div>

<!--Side Panel-->
<div class="sidepanel">
    <div class="logo">

        <a href="/delivery/home"><img src="/res/logo/logo.svg" alt="logo"></a>
    </div>
    <div id="links">


        <span id="active">
                <i class='fa fa-history' style='color:#333333'></i>
                <a href="/delivery/orders">Orders</a>
            </span>
        <hr>
        <span>
                <i class='fas fa-warehouse' style='color:#333333'></i>
                <a href="/delivery/history">History</a>
            </span>
        <hr>
        <span>
                <i class='fa fa-phone' style='color:#333333'></i>
                <a id="contact-us" href="/delivery/contact_us">Contact Us</a>
            </span>
    </div>
</div>

<!--content-->
<div id="main-content">
    <div class="card">
        orders
    </div>
</div>

</body>
</html>
