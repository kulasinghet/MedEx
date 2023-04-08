<?php

use app\views\pharmacy\Components;


$components = new Components();
echo $components->viewHeader("Order Medicine");
echo $components->navBar($_SESSION['username']);
echo $components->sideBar('order-medicine');
?>


<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <div class="row" id="inventory-page-row">
            <div class="col" id="inventory-page-col">

                <div class="nav-search">
                    <form onclick= "() => {
						event.preventDefault();
						showMedicineRowOnSearch(event);
                          }">
                        <label for="search-medicine">Search for stuff</label>
                        <input id="search-medicine" placeholder="Search Medicine . . ." required type="search" />
                        <button type="submit" onclick="showMedicineRowOnSearch(event)">Go</button>


                    </form>
                </div>


                <script>
                    function showMedicineRowOnSearch(event) {

						// prevent default form submit
                        event.preventDefault();

						// get search value
                        let search = document.getElementById('search-medicine').value;
                        let orderMedicineRows = document.getElementsByClassName('order-medicine-row-before');
						let flag = false;
						if (search !== "") {
							for (let i = 0; i < orderMedicineRows.length; i++) {
								let medicineId = orderMedicineRows[i].getAttribute('data-id');
								if (medicineId.toLowerCase().includes(search.toLowerCase())) {
									// change class name
									orderMedicineRows[i].className = 'order-medicine-row-after';
									document.getElementById('clear-filter').classList.remove('clear-filter-icon-hidden');
									flag = true;
								}
							}
							if (flag === false) {
                                swal("No medicine found", "Please try again", "error");
                            }
						}
                    }

                </script>



                <!--                <div id="main-content">-->
                <!--                    <div class="form">-->
                <!--                <form action="/pharmacy/order-medicine" method="post">-->
                <table id="order-medicine-table">
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
                    $pharmacyOrderMedicineController = new \app\controllers\pharmacy\PharmacyOrderMedicineController();
                    $medicines = $medicineEntity->getAllMedicines();
                    if ($medicines != null) {
                        foreach ($medicines as $medicine) {
                            echo "<tr class='order-medicine-row-before' data-id='" . $medicine['medName'] . " " . $medicine['sciName'] . " " . $medicine['id'] . "'>";
                            echo "<td>" . $medicine['id'] . "</td>";
                            echo "<td>" . $medicine['medName'] . "</td>";
                            echo "<td>" . $medicine['sciName'] . "</td>";
                            echo "<td>" . $medicine['weight'] . "</td>";
                            echo "<td>" . $pharmacyOrderMedicineController->getPrice($medicine['id']) . "</td>";
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
//                    <div id="order-new-medicine">
//                <a class="btn ' . ($selectedPage == 'order-medicine' ? 'disabled' : '') . '" href="/pharmacy/order-medicine"> <i class="fa-solid fa-truck-moving"></i> Order Medicine </a>
//            </div>
                    echo "<div id='order-new-medicine' style='position: fixed; bottom: 0; right: 0; margin: 1rem;'>";
                    echo "<a class='btn' href='/pharmacy/order-medicine'> <i class='fa-solid fa-truck-moving'></i> Order Medicine </a>";
                    echo "</div>";

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
