<?php
use app\controllers\supplier\SupplierDashboardController;
use app\models\SupplierMedicineModel;
use app\controllers\supplier\SupplierMedicineController;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Supplier Inventory</title>
    <link href="../scss/vendor/demo.css" rel="stylesheet" />
    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
</head>

<body>

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
                        <a class="btn disabled" href="/supplier/inventory"> <i class="fa fa-dropbox"></i> Inventory </a>
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
        <div class="nav-inner">
            <ul>
                <li><a class="link" href="/login"><i class="fa-solid fa-right-from-bracket"></i></a></li>
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
                <div class="col">
                    <div class="card g-col-2 g-row-2-start-3"
                        style=" box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 20px; width:100% padding: 1%;">
                        <div class="card-body">
                            <div style="padding: 2%;">
                                <h3>Inventory</h3>
                                </br>
                                <div class="nav-search">
                                    <form action="" method="get" onsubmit="preventDefault();" role="search">
                                        <label for="search">Filter Medicine</label>
                                        <input autofocus id="search" name="search" placeholder="Filter By Medicine Name"
                                            type="search" />
                                        <button type="submit">Go</button>
                                    </form>
                                </div>

                                </br></br>
                                <table
                                    style="width: 100%; text-align: center; padding-top: 5%; border-collapse: collapse;">
                                    <tr style="padding: 2%; border-bottom: 1px solid black;">
                                        <th style='padding: 10px;'>Medicine Name</th>
                                        <th>Scientific Name</th>
                                        <th>Weight/Volume</th>
                                        <th>Mannufacture</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                    </tr>
                                    <?php
                                    $supmed = new SupplierMedicineController;
                                    if (isset($_GET['search'])) {
                                        $searchTerm = $_GET['search'];
                                        $supmed->viewallMedFilter($_SESSION['username'], $searchTerm);
                                    } else {
                                        $supmed->viewallMed($_SESSION['username']);
                                    }
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
    <!-- Section: Dashboard Layout -->
</body>

</html>