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
                        document.getElementById('search-medicine').value = "";
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

					function handleQtyChange(name) {
						let medicineID = name;
						let medicineRow = document.getElementById('order-medicine-row-' + medicineID);
						let quantity = document.getElementById('order-medicine-quantity-' + medicineID).value;
						let price = medicineRow.children[4].innerHTML;
						let totalPrice = parseInt(quantity) * parseInt(price);
						document.getElementById('total-price-' + medicineID).innerHTML = totalPrice.toString();

						let totalOrderValue = 0;
						let totalPrices = document.getElementsByClassName('total-price-column');
						for (let i = 0; i < totalPrices.length; i++) {
							totalOrderValue += parseInt(totalPrices[i].innerHTML);
						}
						document.getElementById('total-order-value').innerHTML = totalOrderValue.toString();

                    }

                    function hideRow(medId) {
                        let row = document.getElementById('order-medicine-row-' + medId);
                        row.className = 'order-medicine-row-before';

                        // get the form element order-medicine-quantity-Med0001
                        let formElement = document.getElementById('order-medicine-quantity-' + medId);
                        // reset the value
                        formElement.value = 0;
                        // reset the total price
                        document.getElementById('total-price-' + medId).innerHTML = '0';

                        // reset the total order value
                        let totalOrderValue = 0;
                        let totalPrices = document.getElementsByClassName('total-price-column');
                        for (let i = 0; i < totalPrices.length; i++) {
                            totalOrderValue += parseInt(totalPrices[i].innerHTML);
                        }
                        document.getElementById('total-order-value').innerHTML = totalOrderValue.toString();

                    }

                </script>



                <!--                <div id="main-content">-->
                <!--                    <div class="form">-->
                <!--                <form action="/pharmacy/order-medicine" method="post">-->
                <table id="order-medicine-table">
                    <tr>
                        <th>Medicine ID</th>
                        <th>Medicine</th>
                        <th style='text-align: center'>Medicine Scientific Name</th>
                        <th style='text-align: center'>Remaining Quantity</th>
                        <th style='text-align: center'>Unit Price (LKR)</th>
                        <th style='text-align: center'>Quantity</th>
                        <th style='text-align: center'>Total Price (LKR)</th>
                        <th style='text-align: center; width: 1%;'></th>
                    </tr>


                    <?php
                    $medicineEntity = new \app\controllers\entity\MedicineEntity();
                    $pharmacyOrderMedicineController = new \app\controllers\pharmacy\PharmacyOrderMedicineController();
                    $medicines = $medicineEntity->getAllMedicines();
                    echo "<form action='/pharmacy/order-medicine' method='post' id='order-medicine-form'>";

                    if ($medicines != null) {
                        foreach ($medicines as $medicine) {
                            echo "<tr class='order-medicine-row-before' data-id='" . $medicine['medName'] . " " . $medicine['sciName'] . " " . $medicine['id'] . "' id='order-medicine-row-" . $medicine['id'] . "'>";
                            echo "<td>" . $medicine['id'] . "</td>";
                            echo "<td>" . $medicine['medName'] . "</td>";
                            echo "<td style='text-align: center'>" . $medicine['sciName'] . "</td>";
                            echo "<td style='text-align: center'>" . $medicine['remQty'] . "</td>";
                            echo "<td style='text-align: center'>" . $pharmacyOrderMedicineController->getPrice($medicine['id']) . "</td>";
                            echo "<td  style='text-align: center'><input type='number' name='" . $medicine['id'] . "' min='0' max='100' placeholder='0' class='order-medicine-quantity' required onchange='handleQtyChange(name)' id='order-medicine-quantity-" . $medicine['id'] . "'></td>";
//                            <input type='number' name='quantity' id='quantity' placeholder='1 2 3 . . .'>
                            echo "<td style='text-align: center' id='total-price-" . $medicine['id'] . "' class='total-price-column'>0</td>";
                            echo "<td style='text-align: center; padding: 0;'><a class='btn' onclick='hideRow(\"" . $medicine['id'] . "\")' style='padding: 0; background-color: transparent; border: none; margin: 0; outline: none; box-shadow: none;'>";
                            echo "<i class='fa fa-times close-row' aria-hidden='true' style='color: red;'></i>";
                            echo "</a></td>";
                            echo "</tr>";

                        }
                        echo "<tr style='background-color: #f2f2f2; font-weight: bold'>";
                        echo "<td colspan='2'> Total Order Value </td>";
                        echo "<td colspan='4'></td>";
                        echo "<td id='total-order-value' style='text-align: center'>0</td>";
                        echo "<td></td>";
                        echo "</tr>";
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
                                orderedMedicines.push(medicineRow);
                            }
						}

						let total = 0;
						for (let key in orderedMedicines) {
                            total += parseInt(orderedMedicines[key].totalPrice);
                        }

                        let medicineInformationForSwal = '<table><th>Medicine ID</th><th>Medicine</th> <th>Medicine Scientific Name</th><th>Price</th><th>Quantity</th><th>Total Price</th>';
                        for (let key in orderedMedicines) {
                            medicineInformationForSwal += '<tr>';
                            medicineInformationForSwal += '<td>' + orderedMedicines[key].medicineId + '</td>';
                            medicineInformationForSwal += '<td>' + orderedMedicines[key].medicineName + '</td>';
                            medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].medicineScientificName + '</td>';
                            medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].medicinePrice + '</td>';
                            medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].medicineQuantity + '</td>';
                            medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].totalPrice + '</td>';
                            medicineInformationForSwal += '</tr>';
                        }
                        medicineInformationForSwal += '<tr style="color: #071232; font-size: 1rem; font-weight: bold"><td>Total</td><td colspan="4"></td><td style="text-align: center">' + total + '</td></tr>';

						if (total > 0) {
							swal({
								title: "Order Summary",
								content: {
									element: "div",
									attributes: {
										innerHTML: medicineInformationForSwal
									}
								},
								buttons: {
									cancel: "Edit Order",
									confirm: "Confirm Order"
								},
							}).then((value) =>
                            {
                                if (value) {
                                    document.getElementById('order-medicine-form').submit();
                                    swal("Order Confirmed", "Your order has been placed", "success");
                                }
                            });
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
