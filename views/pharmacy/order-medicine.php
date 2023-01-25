<?php

use app\views\pharmacy\Components;


$components = new Components();
echo $components->viewHeader("Order Medicine");
echo $components->navBar($_SESSION['username']);
echo $components->sideBar('order-medicine');
?>


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
