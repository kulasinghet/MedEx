<html lang="en">
<head>
    <title>Order History</title>
    <link rel="stylesheet" href="/css/pharmacy/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/pharmacy/sidepanel.css">
    <link rel="stylesheet" href="/css/pharmacy/dashboard.css">
    <link rel="stylesheet" href="/css/pharmacy/orders.css">

    <script src="/js/pharmacy/login-error.js" defer></script>
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
        <a href="/pharmacy/profile">Profile</a>
        <a href="/logout">Logout</a>
    </div>
</div>

<!--Side Panel-->
<div class="sidepanel">
    <div class="logo">

        <a href="/pharmacy/home"><img src="/res/logo/logo.svg" alt="logo"></a>
    </div>
    <div id="links">
            <span>
                <i class='fa-solid fa-shop' style='color:#333333'></i>
                <a href="/pharmacy/sell-medicine">Sell Medicine</a>
            </span>
        <hr>
        <span>
                <i class='fa fa-shopping-cart' style='color:#333333'></i>
                <a href="/pharmacy/order-medicine">Order Medicine</a>
            </span>
        <hr>
        <span id="active">
                <i class='fa fa-history' style='color:#333333'></i>
                <a href="/pharmacy/orders">Orders</a>
            </span>
        <hr>
        <span>
                <i class='fas fa-warehouse' style='color:#333333'></i>
                <a href="/pharmacy/inventory">Inventory</a>
            </span>
        <hr>
        <span>
                <i class='fa fa-phone' style='color:#333333'></i>
                <a id="contact-us" href="/pharmacy/contact-us">Contact Us</a>
            </span>
    </div>
</div>

<!--content-->
<div id="main-content">

<!--    --><?php //echo $_SESSION['pharmacyId']; ?>

    <div class="orders">
        <table>
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Order Status</th>
                <th>Order Total</th>
                <th>Delivery Date</th>
                <th></th>
            </tr>
            </thead>
            <tbody>


            <?php

            use app\controllers\pharmacy\PharmacyOrderHistoryController;
            use app\core\ExceptionHandler;
            use app\models\PharmacyOrderModel;

            if (isset($_SESSION['pharmacyId'])) {
                    $pharmacy_id = $_SESSION['pharmacyId'];
                    $orders = (new PharmacyOrderHistoryController)->getOrdersByPharmacyId($pharmacy_id);
                    if ($orders) {
                        foreach ($orders as $order) {
//                            echo "<tr>";
//                            echo "<td>" . $order['order_id'] . "</td>";
//                            echo "<td>" . $order['order_date'] . "</td>";
//                            echo "<td>" . $order['order_status'] . "</td>";
//                            echo "<td>" . $order['order_total'] . "</td>";
//                            echo "</tr>";

                            echo "<tr>";
//                            echo "<a href='/pharmacy/order-details?order_id='" . $order['id'] . "'>";
                            echo "<td>" . $order['id'] . "</td>";
                            echo "<td>" . $order['order_date'] . "</td>";
//                            echo "<td>" . $order['order_status'] . "</td>";
                            echo "<td>" . (new PharmacyOrderHistoryController)->transformOrderStatus($order['order_status']) . "</td>";
                            echo "<td>" . $order['order_total'] . "</td>";
//                            echo "<td>" . $order['delivery_date'] . "</td>";
                            echo "<td>" . (new PharmacyOrderHistoryController)->transformDeliveryDate($order['delivery_date']) . "</td>";
                            echo "<td>" ."<a href='' id='".$order['id']."'>" . "<i class='fa-solid fa-circle-arrow-right view-order-details' style='color:#333333'></i>" ."</a>" . "</td>";
                            echo "</a>";
                            echo "</tr>";

                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan='6'>No Orders</td>";
                        echo "</tr>";
                    }
            } else {
                echo "<tr>";
                echo "<td colspan='6'>No Orders</td>";
                echo "</tr>";
                echo (new ExceptionHandler)->somethingWentWrong();
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
