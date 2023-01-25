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

                <!--                <div id="main-content">-->
                <!--                    <div class="form">-->
                <!--                <form action="/pharmacy/order-medicine" method="post">-->
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
                    $medicineEntity = new \app\controllers\entity\MedicineEntity();
                    $medicines = $medicineEntity->getAllMedicines();
                    if ($medicines != null) {
                        foreach ($medicines as $medicine) {
                            echo "<tr>";
                            echo "<td>" . $medicine['id'] . "</td>";
                            echo "<td>" . $medicine['medName'] . "</td>";
                            echo "<td>" . $medicine['sciName'] . "</td>";
                            echo "<td>" . $medicine['weight'] . "</td>";
                            echo "<td>" . $medicine['price'] . "</td>";
                            echo "<td><input type='number' name='quantity' id='quantity' placeholder='1 2 3 . . .'></td>";
                            echo "</tr>";

                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan='6' style='text-align: center'>No medicines available</td>";
                        echo "</tr>";
                    }

                    ?>
                </table>
                <?php
                if ($medicines != null) {
                    echo "<button type='submit' name='order' id='order'>Order</button>";
                }
                ?>
                <!--                        </form>-->
                <!--                    </div>-->
            </div>
        </div>
    </div>
</div>
</div>

<!--content-->


</body>
</html>
