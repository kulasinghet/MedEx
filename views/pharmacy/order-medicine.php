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
                    echo "<form action='/pharmacy/order-medicine' method='post' id='order-medicine-form'>";
                    if ($medicines != null) {
                        foreach ($medicines as $medicine) {
                            echo "<tr class='order-medicine-row-before' data-id='" . $medicine['medName'] . " " . $medicine['sciName'] . " " . $medicine['id'] . "'>";
                            echo "<td>" . $medicine['id'] . "</td>";
                            echo "<td>" . $medicine['medName'] . "</td>";
                            echo "<td style='text-align: center'>" . $medicine['sciName'] . "</td>";
                            echo "<td style='text-align: center'>" . $medicine['weight'] . " (mg) " . "</td>";
                            echo "<td style='text-align: center'>" . $pharmacyOrderMedicineController->getPrice($medicine['id']) . "</td>";
                            echo "<td  style='text-align: center'><input type='number' name='" . $medicine['id'] . "' min='0' max='100' placeholder='0' class='order-medicine-quantity' required></td>";
                            echo "</tr>";

                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan='6' style='text-align: center'>No medicines available</td>";
                        echo "</tr>";
                    }
                    echo "</form>";
                    ?>

                </table>
                <?php
                if ($medicines != null) {
                    echo "<div id='order-new-medicine' style='position: fixed; bottom: 0; right: 0; margin: 1rem;'>";
                    echo "<a class='btn' onclick='clickOrderNowButton()'> <i class='fa-solid fa-truck-moving'></i> Order Medicine </a>";
                    echo "</div>";

                }
                ?>


                <script>
                    function clickOrderNowButton() {

						// get all the rows in the form
                        let form = document.getElementById('order-medicine-form').elements;
						let orderedMedicines = [];
						for (let i = 0; i < form.length; i++) {
                            let quantity = form[i].value;

                            if (quantity > 0) {
                                let medicineRow = {
                                    medicineId: document.getElementById('order-medicine-table').rows[i + 1].cells[0].innerHTML,
                                    medicineName: document.getElementById('order-medicine-table').rows[i + 1].cells[1].innerHTML,
                                    medicineScientificName: document.getElementById('order-medicine-table').rows[i + 1].cells[2].innerHTML,
                                    medicineWeight: document.getElementById('order-medicine-table').rows[i + 1].cells[3].innerHTML,
                                    medicinePrice: document.getElementById('order-medicine-table').rows[i + 1].cells[4].innerHTML,
                                    medicineQuantity: quantity,
                                    totalPrice: parseInt(quantity) * parseInt(document.getElementById('order-medicine-table').rows[i + 1].cells[4].innerHTML)
                                }
								console.log(medicineRow);
                                orderedMedicines.push(medicineRow);
                            }
						}

						let total = 0;
						for (let key in orderedMedicines) {
                            total += parseInt(orderedMedicines[key].totalPrice);
                        }

                        let medicineInformationForSwal = '<table><th>Medicine ID</th><th>Medicine</th> <th>Medicine Scientific Name</th><th>Weight</th><th>Price</th><th>Quantity</th><th>Total Price</th>';
                        for (let key in orderedMedicines) {
                            medicineInformationForSwal += '<tr>';
                            medicineInformationForSwal += '<td>' + orderedMedicines[key].medicineId + '</td>';
                            medicineInformationForSwal += '<td>' + orderedMedicines[key].medicineName + '</td>';
                            medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].medicineScientificName + '</td>';
                            medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].medicineWeight + '</td>';
                            medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].medicinePrice + '</td>';
                            medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].medicineQuantity + '</td>';
                            medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].totalPrice + '</td>';
                            medicineInformationForSwal += '</tr>';
                        }
                        medicineInformationForSwal += '<tr style="color: #071232; font-size: 1rem; font-weight: bold"><td>Total</td><td colspan="5"></td><td style="text-align: center">' + total + '</td></tr>';

						console.log(orderedMedicines);

						if (total > 0) {
							swal({
								title: "Order Summary",
								content: {
                                    element: "div",
                                    attributes: {
                                        innerHTML: medicineInformationForSwal
                                    }
                                },
								showCancelButton: true,
								confirmButtonText: "Order Now",
								cancelButtonText: "Cancel",
							})
						} else {
                            swal("No medicine selected", "Please select medicine to order", "error");
                        }

                    }

                </script>

            </div>
        </div>
    </div>
</div>
</div>

<!--content-->


</body>
</html>
