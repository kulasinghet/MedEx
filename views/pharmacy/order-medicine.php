<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard</title>
    <link href="../scss2/vendor/demo.css" rel="stylesheet"/>
    <link href="../css/table.css" rel="stylesheet"/>
    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
</head>

<body>


<nav>
    <div class="nav-search">
        <form onsubmit="preventDefault();" role="search">
            <label for="search">Search for stuff</label>
            <input autofocus id="search" placeholder="Search..." required type="search"/>
            <button type="submit">Go</button>
        </form>
    </div>
    <div class="nav-inner">
        <ul>
            <li><a href="#"><i class="fa-solid fa-circle-question"></i></a></li>
            <li><a href="#"><i class="fa-solid fa-gear"></i></a></li>
            <li><a href="#"><i class="fa-solid fa-bell"></i></a></li>
        </ul>
        <a class="nav-profile" href="#">
            <div class="nav-profile-image">
                <img alt="Profile image" src="../res/avatar-empty.png"/>
            </div>
        </a>
    </div>
</nav>

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
                    <a class="btn" href="/pharmacy/sell-medicine"> <i class="fa fa-usd"></i> Sell Medicine </a>
                </li>
                <li>
                    <a class="btn disabled" href="/pharmacy/order-medicine"> <i class="fa fa-plus-square"></i> Order
                        Medicine </a>
                </li>
                <li>
                    <a class="btn" href="/pharmacy/orders"> <i class="fa fa-clock-o"></i> Orders </a>
                </li>
                <li>
                    <a class="btn" href="/pharmacy/inventory"> <i class="fa fa-dropbox"></i> Inventory </a>
                </li>
                <li>
                    <a class="btn" href="/pharmacy/contact-us"> <i class="fa fa-phone"></i> Contact Us </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <div class="row">
            <div class="col">

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


            </div>
        </div>
    </div>
</div>

<!--content-->


</body>
</html>
