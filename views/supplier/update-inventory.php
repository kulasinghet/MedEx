<?php
use app\controllers\supplier\SupplierDashboardController;
use app\models\SupplierModel;
use app\models\SupplierMedicineModel;
use app\controllers\supplier\SupplierUpdateMedicineController;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Supplier - Update Inventory</title>
    <!-- g28 style -->
    <link rel="stylesheet" href="../scss/vendor/demo.css" />
    <link href="../css/supplier/supplier.css" rel="stylesheet" />
    <script src="../js/g28-main.js"></script>
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
                        <a class="btn" href="/dashboard"> <i class="fa-solid fa-house"></i>Dashboard
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
                        <a class="btn  disabled" href="/supplier/update-inventory"> <i class="fa fa-plus-square"></i>
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
                <li><a class="link" href="/login"><i class="fa-solid fa-right-from-bracket"></i></a></li>
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


    <div class="canvas nav-cutoff sidebar-cutoff">
        <div class="canvas-inner">
            <div class="row">
                <div class="col">
                    <div class="card g-col-2 g-row-2-start-3"
                        style=" box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 20px; width:100% padding: 1%;">
                        <div class="card-body">
                            <div style="padding: 2%;">
                                <h3>Inventory</h3>
                                </br>
                                </br></br>
                                <table style="width: 100%; text-align:center;">
                                    <tr>
                                        <th>Medicine Name</th>
                                        <th>Scientific Name</th>
                                        <th>Weight/Volume</th>
                                        <th>Mannufacture</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                    </tr>

                                    <?php
                                    $supmed = new SupplierUpdateMedicineController;
                                    $supmed->updateInventory($_SESSION['username']);
                                    ?>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>