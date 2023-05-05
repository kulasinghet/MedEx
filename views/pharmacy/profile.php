<?php

use app\views\pharmacy\Components;

$components = new Components();
echo $components->viewHeader("Dashboard");
echo $components->navBar($_SESSION['username']);
echo $components->sideBar('dashboard');

?>

<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <div class="row">
            <div class="col">
                <h1><?php echo $user['username'] ?></h1>
                <h2>Name: <?php echo $user['name'] ?></h2>
                <h2>Owner Name: <?php echo $user['ownerName'] ?></h2>
                <h2>City: <?php echo $user['city'] ?></h2>
                <h2>Email: <?php echo $user['email'] ?></h2>
                <h2>Address: <?php echo $user['address'] ?></h2>
                <h2>Mobile: <?php echo $user['mobile'] ?></h2>
                <h2>Pharmacy Registration Number: <?php echo $user['pharmacyRegNo'] ?></h2>
                <h2>Business Registration ID: <?php echo $user['BusinessRegId'] ?></h2>
                <h2>Pharmacy Certificate ID: <?php echo $user['pharmacyCertId'] ?></h2>
                <h2>Verified: <?php echo $user['verified'] ?></h2>
                <h2>Delivery Time: <?php echo $user['deliveryTime'] ?></h2>
                <h2>Registration Date: <?php echo $user['reg_date'] ?></h2>
            </div>
        </div>
    </div>
</div>
</body>
</html>
