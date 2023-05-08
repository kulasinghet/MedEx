<?php

use app\views\pharmacy\Components;


$components = new Components();
echo $components->viewHeader("Sell Medicine");
echo $components->navBar($_SESSION['username']);
echo $components->sideBar('sell-medicine');
?>


<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <div class="row" id="inventory-page-row">
            <div class="col" id="inventory-page-col">

                <div class="nav-search">
                    <form onclick="() => {
						event.preventDefault();
						showMedicineRowOnSearch(event);
                          }">
                        <label for="search-medicine">Search for stuff</label>
                        <input id="search-medicine" placeholder="Search Medicine . . ." required type="search"/>
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
                        // reset search value

                    }

                    function handleQtyChange(name) {
                        let medicineID = name;
                        let medicineRow = document.getElementById('order-medicine-row-' + medicineID);
                        let quantity = document.getElementById('order-medicine-quantity-' + medicineID).value;
                        let price = medicineRow.children[4].innerHTML;
                        let totalPrice = parseFloat(quantity) * parseFloat(price);

                        document.getElementById('total-price-' + medicineID).innerHTML = totalPrice.toFixed(2).toString();

                        let totalOrderValue = 0;
                        let totalPrices = document.getElementsByClassName('total-price-column');
                        for (let i = 0; i < totalPrices.length; i++) {
                            totalOrderValue += parseFloat(totalPrices[i].innerHTML);
                        }
                        document.getElementById('total-order-value').innerHTML = totalOrderValue.toFixed(2).toString();
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
                            totalOrderValue += parseFloat(totalPrices[i].innerHTML);
                        }
                        document.getElementById('total-order-value').innerHTML = totalOrderValue.toFixed(2).toString();

                    }

                </script>

                <table id="order-medicine-table">
                    <tr>
                        <th style="width: 1%;">Medicine ID</th>
                        <th style="width: 46%; white-space: nowrap">Medicine</th>
                        <th style='width: 46%; white-space: nowrap'>Medicine Scientific Name</th>
                        <th style='text-align: center; width: 1%;'>Remaining Quantity</th>
                        <th style='text-align: center; width: 1%;'>Unit Price (LKR)</th>
                        <th style='text-align: center; width: 1%;'>Quantity</th>
                        <th style='text-align: center; width: 1%;'>Total Price (LKR)</th>
                        <th style='text-align: center; width: 1%;'></th>
                    </tr>


                    <?php
                    $stock = new \app\models\Stock();
                    $medicines = $stock->getStock($_SESSION['username']);
                    echo "<form action='/pharmacy/sell-medicine' method='post' id='order-medicine-form'>";

                    if ($medicines != null) {
                        foreach ($medicines as $medicine) {
                            $maxMedicineQty = 'max="' . $medicine['remQty'] . '"';
                            echo "<tr class='order-medicine-row-before' data-id='" . $medicine['medName'] . " " . $medicine['sciName'] . " " . $medicine['medId'] . "' id='order-medicine-row-" . $medicine['medId'] . "'>";
                            echo "<td>" . $medicine['medId'] . "</td>";
                            echo "<td>" . $medicine['medName'] . "</td>";
                            echo "<td>" . $medicine['sciName'] . "</td>";
                            echo "<td style='text-align: center'>" . $medicine['remQty'] . "</td>";
                            echo "<td style='text-align: center'>" . $medicine['sellingPrice'] . "</td>";
                            echo "<td  style='text-align: center'><input type='number' name='" . $medicine['medId'] . "' min='0' placeholder='0' class='order-medicine-quantity' required onchange='handleQtyChange(name)' id='order-medicine-quantity-" . $medicine['medId'] . "' " . $maxMedicineQty . "'></td>";
//                            <input type='number' name='quantity' id='quantity' placeholder='1 2 3 . . .'>
                            echo "<td style='text-align: center' id='total-price-" . $medicine['medId'] . "' class='total-price-column'>";
                            echo "0</td>";
                            echo "<td style='text-align: center; padding: 0;'><a class='btn' onclick='hideRow(\"" . $medicine['medId'] . "\")' style='padding: 0; background-color: transparent; border: none; margin: 0; outline: none; box-shadow: none;'>";
                            echo "<i class='fa fa-times close-row' aria-hidden='true' style='color: red;'></i>";
                            echo "</a></td>";
                            echo "</tr>";
                        }
                        echo "<tr style='background-color: #f2f2f2; font-weight: bold'>";
                        echo "<td colspan='2'> Total Bill Value </td>";
                        echo "<td colspan='4'></td>";
                        echo "<td id='total-order-value' style='text-align: center'>0</td>";
                        echo "<td></td>";
                        echo "</tr>";
                    } else {
                        echo "<tr>";
                        echo "<td colspan='7' style='text-align: center'>No medicines available</td>";
                        echo "</tr>";
                    }
                    echo "<input type='hidden' name='customer_money' id='customer_money' value='0'>";
                    echo "</form>";
                    ?>

                </table>
                <?php
                if ($medicines != null) {
                    echo "<div id='order-new-medicine' style='position: fixed; bottom: 0; right: 0; margin: 1rem;'>";
                    echo "<a class='btn' onclick='clickOrderNowButton()'> <i class='fa-solid fa-truck-moving'></i> Sell Medicine </a>";
                    echo "</div>";

                }
                ?>


                <script>
                    function checkMedicineQuantityisVaild() {
                        console.log("checkMedicineQuantityisVaild");

                        let form = document.getElementById('order-medicine-form').elements;
                        let flag = false;
                        for (let i = 0; i < form.length; i++) {
                            let quantity = form[i].value;
                            if (quantity > 0) {
                                flag = true;
                            }
                        }
                        if (flag === false) {
                            swal("No medicine selected", "Please select at least one medicine", "error");
                        }

                        for (let i = 0; i < form.length; i++) {
                            let quantity = form[i].value;
                            let maxQuantity = document.getElementById('order-medicine-table').rows[i + 1].cells[3].innerHTML;
                            if (parseInt(quantity) > parseInt(maxQuantity)) {
                                console.log("quantity > maxQuantity");
                                return false;
                            }
                        }
                        return true;
                    }

                    function clickOrderNowButton() {

                        if (checkMedicineQuantityisVaild()) {
                        } else {
                            console.log("Invalid quantity");
                            swal("Invalid quantity", "Please enter a valid quantity", "error");
                            return;
                        }

                        // get all the rows in the form
                        let form = document.getElementById('order-medicine-form').elements;
                        let orderedMedicines = [];
                        for (let i = 0; i < form.length; i++) {
                            let quantity = form[i].value;

                            if (quantity > 0) {
                                let medicineRow = {
                                    medicineId: document.getElementById('order-medicine-table').rows[i + 1].cells[0].innerHTML,
                                    medicineName: document.getElementById('order-medicine-table').rows[i + 1].cells[1].innerHTML,
                                    remQty: document.getElementById('order-medicine-table').rows[i + 1].cells[3].innerHTML,
                                    medicinePrice: document.getElementById('order-medicine-table').rows[i + 1].cells[4].innerHTML,
                                    medicineQuantity: quantity,
                                    totalPrice: parseInt(quantity) * parseInt(document.getElementById('order-medicine-table').rows[i + 1].cells[4].innerHTML)
                                }
                                orderedMedicines.push(medicineRow);
                            }
                        }

                        let total = 0;
                        for (let key in orderedMedicines) {
                            total += parseFloat(orderedMedicines[key].totalPrice);
                        }
                        console.log(orderedMedicines);

                        let medicineInformationForSwal = '<table><th>Medicine ID</th><th>Medicine</th><th>Unit Price (LKR)</th><th>Quantity</th><th>Total Price (LKR)</th>';
                        for (let key in orderedMedicines) {
                            medicineInformationForSwal += '<tr>';
                            medicineInformationForSwal += '<td>' + orderedMedicines[key].medicineId + '</td>';
                            medicineInformationForSwal += '<td>' + orderedMedicines[key].medicineName + '</td>';
                            medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].medicinePrice + '</td>';
                            medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].medicineQuantity + '</td>';
                            medicineInformationForSwal += '<td style="text-align: center">' + parseFloat(orderedMedicines[key].totalPrice).toFixed(2) + '</td>';
                            medicineInformationForSwal += '</tr>';
                        }
                        medicineInformationForSwal += '<tr style="color: #071232; font-size: 1rem; font-weight: bold"><td>Total</td><td colspan="3"></td><td style="text-align: center">' + parseFloat(total).toFixed(2).toString() + '</td></tr>';

                        console.log(total)
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
                            }).then((value) => {
                                if (value) {
                                    // show a swal with the option to enter the customer payment then document.getElementById('order-medicine-form').submit();
                                    //                                    swal("Order Confirmed", "Your order has been placed", "success");
                                    swal({
                                        title: "Payment",
                                        text: "Enter the customer payment",
                                        content: {
                                            element: "input",
                                            attributes: {
                                                placeholder: "Enter the customer payment (LKR)",
                                                type: "number",
                                                min: 0
                                            }
                                        },
                                        buttons: {
                                            cancel: "Cancel",
                                            confirm: "Confirm"
                                        },
                                    }).then((value) => {
                                        if (value) {
                                            let customerPayment = value;
                                            let customerChange = parseFloat(customerPayment) - parseFloat(total);
                                            if (customerChange < 0) {
                                                swal("Invalid payment", "Please enter a valid payment", "error");
                                                return;
                                            }
                                            // $customer_money input field should be customerChange
                                            document.getElementById('customer_money').value = customerPayment;
                                            swal({
                                                title: "Customer Change",
                                                text: "Customer change is LKR. " + customerChange.toFixed(2).toString(),
                                                icon: "success",
                                                buttons: {
                                                    confirm: "OK"
                                                },
                                            }).then((value) => {
                                                if (value) {

                                                    swal({
                                                        title: "Order Confirmed",
                                                        text: "Your order is being processed",
                                                        icon: "success",
                                                        buttons: {},
                                                        // does not allow the user to close the swal by clicking outside
                                                        closeOnClickOutside: false,
                                                        // does not allow the user to close the swal by pressing the escape key
                                                        closeOnEsc: false,
                                                        closeOnCancel: false,
                                                        closeOnConfirm: false,
                                                    });

                                                            // get all the medicine ids and quantities
                                                            let medicineIds = [];
                                                            let medicineQuantities = [];
                                                            for (let key in orderedMedicines) {
                                                                medicineIds.push(orderedMedicines[key].medicineId);
                                                                medicineQuantities.push(orderedMedicines[key].medicineQuantity);
                                                            }
                                                            console.log(customerPayment);
                                                            console.log(customerChange);
                                                            console.log(total);
                                                            console.log(medicineIds);
                                                            console.log(medicineQuantities);
                                                            // document.getElementById('order-medicine-form').submit();

                                                            fetch('http://146.190.15.95/pharmacy/sell-medicine', {
                                                                method: 'POST',
                                                                headers: {
                                                                    'Content-Type': 'application/json'
                                                                },
                                                                body: JSON.stringify({
                                                                    customerPayment: parseFloat(customerPayment).toFixed(2),
                                                                    customerChange: parseFloat(customerChange).toFixed(2),
                                                                    total: parseFloat(total).toFixed(2),
                                                                    medicineIds: medicineIds,
                                                                    medicineQuantities: medicineQuantities
                                                                })
                                                            }).then((response) => {
                                                                if (response.ok) {
                                                                    swal("Order Confirmed", "Your order has been placed", "success");
                                                                    setTimeout(function () {
                                                                        window.location.href = "http://146.190.15.95/pharmacy/invoices";
                                                                    }, 2000);
                                                                } else {
                                                                    swal("Order Failed", "Your order has not been placed", "error");
                                                                }
                                                            }).catch((error) => {
                                                                swal("Order Failed", "Your order has not been placed", "error");
                                                            });

                                                }
                                            });
                                        }
                                    });
                                }
                            });

                        } else {
                            swal("No medicine selected", "Please select medicine to sell", "error");
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
