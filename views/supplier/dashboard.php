<?php
use app\controllers\supplier\SupplierDashboardController;
use app\models\SupplierModel;
use app\models\PharmacyOrderModel;
use app\models\SupplierMedicineModel;
use app\models\ManufactureModel;
use app\models\MedicineModel;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Supplier Dashboard</title>
    <link href="../scss/vendor/demo.css" rel="stylesheet" />
    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
</head>

<body>

    <nav>
        <div class="nav-search">
            <form onsubmit="preventDefault();" role="search">
                <label for="search">Search for stuff</label>
                <input autofocus id="search" placeholder="Search..." required type="search" />
                <button type="submit">Go</button>
            </form>
        </div>
        <div class="nav-inner">
            <ul>
                <li><a href="/login"><i class="fa fa-sign-out"></i></a></li>
            </ul>
            <a class="nav-profile" href="#">
                <div class="nav-profile-image">
                    <img alt="Profile image" src="../res/avatar-empty.png" />
                </div>
            </a>
        </div>
    </nav>

    <div class="sidebar">
        <div class="sidebar-inner">
            <nav class="sidebar-header">
                <div class="sidebar-logo">
                    <a href="/dashboard">
                        <img alt="MedEx logo" src="../res/logo/logo-text_light.svg" />
                    </a>
                </div>
            </nav>
            <div class="sidebar-context">
                <ul>
                    <li>
                        <a class="btn  disabled" href="/dashboard"> <i class="fa-solid fa-house"></i>Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="btn" href="/supplier/add-medicine"> <i class="fa fa-medkit"></i> Add New
                            Medicine
                        </a>
                    </li>
                    <li>
                        <a class="btn" href="/supplier/inventory"> <i class="fa fa-dropbox"></i> Inventory </a>
                    </li>
                    <li>
                        <a class="btn" href="/supplier/update-inventory"> <i class="fa fa-plus-square"></i>
                            Update
                            Inventory
                        </a>
                    </li>
                    <li>
                        <a class="btn" href="/supplier/accept-orders"> <i class="fa fa-check-circle"></i>
                            Accept Orders
                        </a>
                    </li>
                    <li>
                        <a class="btn" href="/supplier/orders"> <i class="fa fa-list-alt"></i> View
                            Accepted
                            Orders
                        </a>
                    </li>
                    <li>
                        <a class="btn" href="/supplier/medicine-requests"> <i class="fa fa-hourglass-half"></i>
                            Medicine
                            Requests </a>
                    </li>

                    <li>
                        <a class="btn" href="/supplier/contact-us"> <i class="fa fa-phone"></i> Contact Us </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <nav>
        <div class="nav-search">
            <form onsubmit="preventDefault();" role="search">
                <label for="search">Search for stuff</label>
                <input autofocus id="search" placeholder="Search..." required type="search" />
                <button type="submit">Go</button>
            </form>
        </div>
        <div class="nav-inner">
            <ul>
                <li><a class="link" href="#"><i class="fa-solid fa-gear"></i></a></li>
                <li><a class="link" href="login"><i class="fa-solid fa-right-from-bracket"></i></a></li>
                <li><a class="link" href="#"><i class="fa-solid fa-bell"></i></a></li>
            </ul>
            <a class="nav-profile" href="#">
                <div class="nav-profile-image">
                    <img alt="Profile image" src="../res/avatar-empty.png" />
                </div>
            </a>
        </div>
    </nav>
    <!-- Section: Fixed Components -->

    <!-- Section: Dashboard Layout -->
    <div class="canvas nav-cutoff sidebar-cutoff">
        <div class="canvas-inner">
            <div class="row">
                <div class="col" style="display: flex; flex-direction: row;">
                    <div class="card g-col-2 g-row-2-start-3"
                        style=" box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 20px; width:50%">
                        <div class="card-body">
                            <div style="padding: 2%;">
                                <div style="display: flex; flex-direction: row;">
                                    <h3 style="padding-right:60%">Welcome Back !</h3>
                                </div>
                                <?php
                                $sup = new SupplierModel;
                                $order = new PharmacyOrderModel;
                                $supmed = new SupplierMedicineModel;
                                $sup->getName($_SESSION['username']);
                                $result1 = $order->getSupOrderCount($_SESSION['username']);
                                if ($result1->num_rows > 0) {
                                    while ($row1 = $result1->fetch_assoc()) {
                                        $ordercount = $row1['COUNT(id)'];
                                    }
                                }
                                $result2 = $supmed->getSupMedCount($_SESSION['username']);
                                if ($result2->num_rows > 0) {
                                    while ($row2 = $result2->fetch_assoc()) {
                                        $medcount = $row2['COUNT(medId)'];
                                    }
                                }
                                echo " <h3>" . $_SESSION['name'] . "<br/><br/>To date you have,</h3>
                               <center> <h5><br/>Accepted <b>" . $ordercount . " </b>Orders</h5>" .
                                    "<h5><br/>Supply <b>" . $medcount . " </b>Medicine</h5></center>";
                                ?>
                            </div>
                        </div>

                    </div>

                    <div class="card g-col-2 g-row-2-start-3"
                        style=" box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 20px; width:50%">
                        <div class="card-body">
                            <div style="padding: 2%;">
                                <?php
                                $sup = new SupplierModel;
                                $order = new PharmacyOrderModel;
                                $supmed = new SupplierMedicineModel;
                                $result1 = $order->getPendingOrderCount();
                                if ($result1->num_rows > 0) {
                                    while ($row1 = $result1->fetch_assoc()) {
                                        $ordercount = $row1['COUNT(id)'];
                                    }
                                }
                                echo "<center><br/><br/> <br/><h3> There are " . $ordercount . " New Orders</h3><br>
                                <a href='/supplier/accept-orders' class='btn btn--primary'>View New Orders</a></center>";
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card g-col-2 g-row-2-start-3"
                style=" box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 20px; width:90%">
                <div class="card-body">
                    <div style="padding: 2%;">
                        <?php
                        echo " <h3>Invenotry Running Low</h3>
                          <table style='width: 100%; text-align:center;padding:1%;'>
                                    <tr>
                                        <th>Medicine Name</th>
                                        <th>Scientific Name</th>
                                        <th>Weight/Volume</th>
                                        <th>Mannufacture</th>
                                        <th>Quantity</th>
                                    </tr>";
                        $supmed = new SupplierMedicineModel;
                        $med = new MedicineModel;
                        $man = new ManufactureModel;
                        $result = $supmed->getLowSupMedicine($_SESSION['username']);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $medid = $row["medId"];
                                $medNam = $med->getName($medid);
                                $sciName = $med->getSciname($medid);
                                $weight = $med->getWeight($medid);
                                $volume = $med->getVolume($medid);
                                $quantity = $row["quantity"];
                                $manid = $med->getManufacture($medid);
                                $manname = $man->getManufactureName($manid);
                                if ($weight > 0) {
                                    echo "<tr><td>" . $medNam . "</td><td>" . $sciName . "</td><td>" . $weight . " mg</td><td>" . $manname . "</td><td>" . $quantity . "</td></tr>";
                                } else {
                                    echo "<tr><td>" . $medNam . "</td><td>" . $sciName . "</td><td>" . $volume . " ml</td><td>" . $manname . "</td><td>" . $quantity . "</td></tr>";
                                }
                            }
                            echo "<table>";
                        } else {
                            echo "<tr><td colspan='5' style='padding:2%;'> No Medicine Running Low </td></table>";
                        }
                        echo "<center><a href='/supplier/update-inventory' class='btn btn--primary'>Update Inventory</a></center>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Section: Dashboard Layout -->
</body>

</html>