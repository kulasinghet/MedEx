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

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Supplier - Add Medicine</title>
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
                        <a class="btn" href="/dashboard"> <i class="fa-solid fa-house"></i>Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="btn  disabled" href="/supplier/add-medicine"> <i class="fa fa-medkit"></i> Add New
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

    <!-- Section: Dashboard Layout -->
    <div class="canvas nav-cutoff sidebar-cutoff">
        <div class="canvas-inner">
            <div class="row" style="padding-left:10%">
                <div class="col" style="display: flex; flex-direction: column;">
                    <div class="card g-col-2 g-row-2-start-3"
                        style=" box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 20px; height: 45%; width:70%;">
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
                        style=" box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 20px; width:70%; height: 60%;">
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
                                    Weight (mg): <input type='text' name='weight' class='form-input' placeholder='Enter Weight in mg'><br>
                                    Volume (ml): <input type='text' name='volume' class='form-input' placeholder='Enter Volume in ml'><br>
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