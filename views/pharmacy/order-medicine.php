<html lang="en">
<head>
    <title>Order Medicine</title>
    <link rel="stylesheet" href="/css/pharmacy/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/pharmacy/sidepanel.css">
    <link rel="stylesheet" href="/css/pharmacy/dashboard.css">
    <link rel="stylesheet" href="/css/pharmacy/table.css">
    <link rel="stylesheet" href="/css/pharmacy/order-medicine.css">
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
        <span id="active">
                <i class='fa fa-shopping-cart' style='color:#333333'></i>
                <a href="/pharmacy/order-medicine">Order Medicine</a>
            </span>
        <hr>
        <span>
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
    <div class="form">
        <form action="/pharmacy/order-medicine" method="post">
            <table>
                <tr>
                    <th>Medicine ID</th>
                    <th>Medicine</th>
                    <th>Medicine Scientific Name</th>
                    <th>Weight</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>



            <?php
            $medicines = (new \app\controllers\supplier\MedicineController())->getAllMedicines();
            foreach ($medicines as $medicine) {
                $medicinePrice = (new \app\controllers\supplier\SupplierMedicineController())->getMedicinePrice($medicine['id']);
//                $medicinePrice = $medicinePrice['price'];
                if ($medicinePrice != null) {

                    echo "<tr>";
                    echo "<td>" . $medicine['id'] . "</td>";
                    echo "<td>" . $medicine['medName'] . "</td>";
                    echo "<td>" . $medicine['sciName'] . "</td>";
                    echo "<td>" . $medicine['weight'] . "</td>";
                    echo "<td>" . $medicinePrice . "</td>";
                    echo "<td><input type='number' name='quantity' id='quantity' placeholder='1 2 3 . . .'></td>";
                    echo "</tr>";
                }
            }

            ?>



            </table>
            <button type="submit" name="order" id="add-medicine">Order</button>



<!--            <button id="add-medicine" type="submit">Add Medicine</button>-->
        </form>
    </div>
</div>

</body>
</html>
