<?php
use app\controllers\supplier\SupplierDashboardController;
use app\models\ScietificNameModel;
use app\models\SupplierModel;
use app\models\ManufactureModel;
use app\models\MedicineModel;
use app\models\SupplierMedicineModel;
use app\controllers\supplier\SupplierMedicineController;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Supplier - Add Medicine</title>

    <link href="../scss/vendor/demo.css" rel="stylesheet" />
    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
</head>

<body>
    <!-- Section: Fixed Components -->
    <div class="sidebar-grouped">
        <div class="sidebar-inner">
            <nav class="sidebar-header">
                <div class="sidebar-logo">
                    <a href="#">
                        <img alt="MedEx logo" src="../res/logo/logo-text_light.svg" />
                    </a>
                </div>
            </nav>
            <div class="sidebar-context">
                <ul class="main-buttons">
                    <li>
                        <a href="/dashboard"> <i class="fa-solid fa-house"></i> Dashboard </a>
                    </li>
                    <li>
                        <a href="#"> <i class="fa fa-dropbox"></i> Inventory </a>
                        <ul class="hidden">
                            <li class="disabled"><a href="/supplier/add-medicine"> Add New Medicine </a></li>
                            <li><a href="/supplier/inventory"> View Inventory </a></li>
                            <li><a href="/supplier/update-inventory"> Update Inventory</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"> <i class="fa fa-check-circle"></i> Orders </a>
                        <ul class="hidden">
                            <li><a href="/supplier/accept-orders"> Accept Orders</a></li>
                            <li><a href="/supplier/orders"> View Accepted Orders </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/supplier/medicine-requests"> <i class="fa fa-hourglass-half"></i>Medicine Requests</a>
                    </li>
                    <li>
                        <a href="/supplier/contact-us"> <i class="fa fa-phone"></i>Contact Us </a>
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
            <div class="row" style="padding-left:10%">
                <div class="col" style="display: flex; flex-direction: column;">
                    <div class="card g-col-2 g-row-2-start-3"
                        style=" box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 20px; height: 50%; width:70%; padding-bottom:2%;">
                        <div class="card-body">

                            <div style="padding: 2%;">
                                <h3>Add Existing Medicine</h3>
                                <div class="nav-search">
                                    <form onsubmit="preventDefault();" role="search">
                                        <label for="search">Filter Medicine</label>
                                        <input autofocus id="search" placeholder="Filter Medicine" required
                                            type="search" />
                                        <button type="submit">Go</button>
                                    </form>
                                </div>
                                <?php
                                $sup = new SupplierModel;
                                $sup->getStatus($_SESSION['username']);
                                $sup->getName($_SESSION['username']);
                                if ($_SESSION['stat']) {
                                    $supmed = new SupplierMedicineController;
                                    $supmed->viewOtherMed($_SESSION['username']);

                                } else {
                                    echo "<h5><font color='#FF5854'>Cannot add medicine as you are unverfied </font></h5>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="card g-col-2 g-row-2-start-3"
                        style=" box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 20px; width:70%; height: 80%;">
                        <div class="card-body">
                            <div style="padding: 2%;">
                                <h3>Add New Medicine</h3>
                                <?php
                                $sup = new SupplierModel;
                                $sup->getStatus($_SESSION['username']);
                                $sup->getName($_SESSION['username']);
                                if ($_SESSION['stat']) {
                                    echo "<form action='/supplier/add-medicine' method='post' enctype='multipart/form-data' style='padding-top: 2%; padding-left: 5%; width:70%; height:50%'>
                                    Medicine Name: <input type='text' name='name' class='form-input' placeholder='Enter Medicine Name' required><br>
                                    Weight (mg): <input type='text' name='weight' class='form-input' placeholder='Enter Weight in mg' required><br>
                                    Scietific Name: <select name='sciname' value='' class='form-input' required>Manufacture Name";
                                    $sciname = new ScietificNameModel;
                                    $sciname->SciNameDropdown();
                                    echo "</select><br>                              
                                    Manufacture: <select name='manufacture' value='' class='form-input' required>Manufacture Name";
                                    $man = new ManufactureModel;
                                    $man->ManufactureDropdown();
                                    echo "</select> <br><input type='submit' value='Add New Medicine' class='btn btn-primary'>
                                    </form>";
                                } else {
                                    echo "<h5><font color='#FF5854'>Cannot add medicine as you are unverfied </font></h5>";
                                }
                                ?>
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