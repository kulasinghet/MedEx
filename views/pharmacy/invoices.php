<?php

use app\controllers\pharmacy\PharmacyOrderHistoryController;
use app\core\ExceptionHandler;
use app\views\pharmacy\Components;

$components = new Components();
echo $components->viewHeader("Invoices");
echo $components->navBar($_SESSION['username']);
echo $components->sideBar('invoices');
?>


<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <div class="row" id="orders-page-row">
            <div class="col" id="orders-page-col">

                <!--                <div class="nav-search">-->
                <!--                    <form onsubmit="preventDefault();" role="search">-->
                <!--                        <label for="search">Search for stuff</label>-->
                <!--                        <input id="search-orders" placeholder="Search Orders ..." required type="search" onchange="handleSearchButtonClick(event)" />-->
                <!--                        <button type="submit" onclick="handleSearchButtonClick()">-->
                <!--                            <i class="fa-solid fa-search"></i>-->
                <!--                    </form>-->
                <!--                </div>-->


                <div class="filter-group">



                    <div class="filter-group">

                        <!--                        <button class="btn btn-primary filter-button" id="pending" onclick="handleFilterButtonClick('Pending')">Pending</button>-->
                        <!---->
                        <!--                        <button class="btn btn-primary filter-button" id="accepted" onclick="handleFilterButtonClick('Accepted')">Accepted</button>-->
                        <!---->
                        <!--                        <button class="btn btn-primary filter-button" id="rejected" onclick="handleFilterButtonClick('Rejected')">Rejected</button>-->
                        <!---->
                        <!--                        <button class="btn btn-primary filter-button" id="delivered" onclick="handleFilterButtonClick('Delivered')">Delivered</button>-->
                        <!---->
                        <!--                        <button class="btn btn-primary filter-button" id="cancelled" onclick="handleFilterButtonClick('Cancelled')">Cancelled</button>-->
                        <!---->
                        <!--                        <i class="fa-solid fa-filter-circle-xmark" style="color: #999999; font-size: 1.5rem; margin-left: 1rem; cursor: pointer;" id="clear-filter" onclick="handleFilterButtonClick('Clear')"></i>-->

                        <div class="filter-by-date">
                            <label for="filter-by-date">Filter by bill date</label>
                            <select name="filter-by-date" id="filter-by-date" onchange="handleFiltering()">
                                <option value="Clear" selected>All</option>
                                <option value="Today">Today</option>
                                <option value="This Week">This Week</option>
                                <option value="This Month">This Month</option>
                                <option value="This Year">This Year</option>
                            </select>
                        </div>



                    </div>
                </div>

                <!--                order table-->
                <div class=" orders">
                    <table id="orders-table">
                        <thead>
                        <tr>
                            <th>Invoice ID</th>
                            <th>Bill Date</th>
                            <th>Bill Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'pharmacy') {
                            try {
                                $username = $_SESSION['username'];
                                $pharmacySellOrderController = new \app\controllers\pharmacy\PharmacySellMedicineController();
                                $sales = $pharmacySellOrderController->getPharmacySellOrders($username);
                                if ($sales) {
                                    foreach ($sales as $sale) {
                                        echo "<tr class='sale-row'>";
                                        echo "<td>" . $sale['invoice_id'] . "</td>";
                                        echo "<td>" . $sale['invoice_date'] . "</td>";
                                        echo "<td>" . $sale['bill_total'] . "</td>";
                                        echo "<td>" . "<a class='view-order' id='" . $sale['invoice_id'] . "'>" . "<i class='fa-solid fa-circle-arrow-right view-order-details' style='color:#333333'></i>" . "</a>" . "</td>";
                                        echo "</a>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colspan='6' style='text-align: center'>You don't have any orders</td>";
                                    echo "</tr>";
                                }
                            } catch (Exception $e) {
                                echo (new ExceptionHandler)->somethingWentWrong();
                            }
                        } else {
                            echo "<tr>";
                            echo "<td colspan='6' style='text-align: center'>You don't have any orders</td>";
                            echo "</tr>";
                            echo (new ExceptionHandler)->somethingWentWrong();
                        }


                        ?>
                        </tbody>
                    </table>
                </div>


            </div>



            <div id="order-new-medicine">
                <a class="btn ' . ($selectedPage == 'order-medicine' ? 'disabled' : '') . '" href="/pharmacy/order-medicine">
<!--                    sell medicine-->
                    <i class="fa-solid fa-circle-plus"></i> Sell Medicine</a>
            </div>

        </div>
    </div>
</div>

<script>
    function handleFiltering() {
        $dateFilter = document.getElementById('filter-by-date').value;

        $allRows = document.getElementById('orders-table').rows;
        $allRows = Array.prototype.slice.call($allRows, 1);

        for (let i = 0; i < $allRows.length; i++) {
            $allRows[i].style.display = 'table-row';
        }

        for (let i = 0; i < $allRows.length; i++) {
            $dateInRow = $allRows[i].cells[1].innerHTML;
            if (checkDeliveryDateInFilter($dateInRow, $dateFilter)) {
                $allRows[i].style.display = 'none';
            }
        }
    }

    function checkDeliveryDateInFilter($orderDate ,$filter) {

        $dateInRow = new Date($orderDate);
        $dateNow = new Date();

        if ($dateInRow) {
            if ($filter == 'Today') {
                if ($dateInRow.getDate() != $dateNow.getDate()) {
                    return true;
                }
            } else if ($filter == 'This Week') {
                if (getWeekNumber($dateInRow) != getWeekNumber($dateNow)) {
                    console.log($dateInRow.getDate() + ' ' + $dateNow.getDate());
                    return true;
                }
            } else if ($filter == 'This Month') {
                if ($dateInRow.getMonth() != $dateNow.getMonth()) {
                    return true;
                }
            } else if ($filter == 'This Year') {
                if ($dateInRow.getFullYear() != $dateNow.getFullYear()) {
                    return true;
                }
            }
        }
        return false;
    }


    function getWeekNumber(d) {
        d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
        d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay()||7));
        var yearStart = new Date(Date.UTC(d.getUTCFullYear(),0,1));
        var weekNo = Math.ceil(( ( (d - yearStart) / 86400000) + 1)/7);
        return weekNo;
    }

</script>

<script>

    //
    // if document is ready add event listener to all class view-order

    document.addEventListener('DOMContentLoaded', function() {
        var viewOrderButtons = document.getElementsByClassName('view-order');
        for (var i = 0; i < viewOrderButtons.length; i++) {
            viewOrderButtons[i].addEventListener('click', function() {
                // pass id of the anchor tag to the function
                handleViewOrderDetailsClick(this.id);
            });
        }
    });

    async function handleViewOrderDetailsClick($orderId) {

        try {

            swal({
                title: 'Loading',
                text: 'Please wait...',
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                animation: false,
                content: {
                    element: "img",
                    attributes: {
                        // add loading gitf from internet
                        src: "https://i.gifer.com/ZZ5H.gif",
                        style: "width:25px; margin-bottom:20px;"
                    },
                }
            });

            const response = await fetch(`/pharmacy/api/sales-order?invoiceId=${$orderId}`);
            const orderData = await response.json();
            console.log(orderData);
            // {"orderId":"411205testPharmacy977","pharmacyId":"testPharmacy","orderDate":"2023-04-13","totalPrice":"230","orderStatus":"0","deliveryDate":null}

            const response2 = await fetch(`/pharmacy/api/sales-order-medicines?invoiceId=${$orderId}`);
            const orderedMedicines = await response2.json();
            console.log(orderedMedicines);

            swal.close();

            // {
            //     "invoiceId": "ID1",
            //     "pharmacyUsername": "testPharmacy",
            //     "invoiceDate": "2023-04-27",
            //     "billTotal": "450"
            // }


            let orderInformationForSwal = '';
            if (orderData != undefined || orderData.length > 0) {
                orderInformationForSwal += '<div class="order-details">';
                orderInformationForSwal += '<div class="order-details-row">';
                orderInformationForSwal += '<h4>Invoice ID</h4>';
                orderInformationForSwal += '<h4>' + orderData.invoiceId + '</h4>';
                orderInformationForSwal += '</div>';
                orderInformationForSwal += '<div class="order-details-row">';
                orderInformationForSwal += '<h4>Pharmacy ID</h4>';
                orderInformationForSwal += '<h4>' + orderData.pharmacyUsername + '</h4>';
                orderInformationForSwal += '</div>';
                orderInformationForSwal += '<div class="order-details-row">';
                orderInformationForSwal += '<h4>Invoiced Date</h4>';
                orderInformationForSwal += '<h4>' + orderData.invoiceDate + '</h4>';
                orderInformationForSwal += '</div>';
                orderInformationForSwal += '<div class="order-details-row">';
                orderInformationForSwal += '<h4>Total Price</h4>';
                orderInformationForSwal += '<h4>' + orderData.billTotal + '</h4>';
                orderInformationForSwal += '</div>';
                orderInformationForSwal += '</div>';
            }

            console.log(orderInformationForSwal);

            let medicineInformationForSwal = '';

            // {
            //     "medId": "Med0001",
            //     "quantity": "3",
            //     "medName": "Panadol",
            //     "sciName": "Paracetamol",
            //     "weight": "500",
            //     "unitPrice": "10"
            // }

            if (orderedMedicines != undefined || orderedMedicines.length > 0) {
                medicineInformationForSwal = '<table><th>Medicine ID</th><th>Medicine</th> <th>Medicine Scientific Name</th><th>Weight</th><th>Price</th><th>Quantity</th><th>Total Price</th>';
                for (let key in orderedMedicines) {
                    medicineInformationForSwal += '<tr>';
                    medicineInformationForSwal += '<td>' + orderedMedicines[key].medId + '</td>';
                    medicineInformationForSwal += '<td>' + orderedMedicines[key].medName + '</td>';
                    medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].sciName + '</td>';
                    medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].weight + '</td>';
                    medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].unitPrice + '</td>';
                    medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].quantity + '</td>';
                    medicineInformationForSwal += '<td style="text-align: center">' + parseInt(orderedMedicines[key].unitPrice) * parseInt(orderedMedicines[key].quantity) + '</td>';
                    medicineInformationForSwal += '</tr>';
                }
                medicineInformationForSwal += '<tr style="color: #071232; font-size: 1rem; font-weight: bold"><td>Total</td><td colspan="5"></td><td style="text-align: center">' + orderData.billTotal + '</td></tr>';
                medicineInformationForSwal += '</table>';
            } else {
                medicineInformationForSwal = '<h4>No Medicine Ordered</h4>';
            }




            if (orderData.billTotal > 0) {
                    console.log("Order Summary" + '\t' + $orderId);
                swal({
                    title: "Order Summary" + '\t' + $orderId,
                    content: {
                        element: "div",
                        attributes: {
                            innerHTML: orderInformationForSwal + medicineInformationForSwal,
                        }
                    },
                    buttons: {
                        cancel: "Close",
                        view: {
                            text: "View Invoice",
                            value: "view",
                        },
                    },
                    animation: false,
                }).then((value) => {
                    switch (value) {
                        case "view":

                            fetch('/pdf/' + $orderId + '.pdf')
                                // open pdf in new tab
                                .then(() => window.open('/pdf/' + $orderId + '.pdf'))
                                // if pdf not found
                                .catch(() => swal("Something went wrong!", "Contact the administrator!", "error"));

                            break;
                    }
                });
            } else {
                swal("Something went wrong! ", "Contact the administrator!", "error");
            }


        } catch (e) {
            console.log("Error: " + e);
            swal("Something went wrong! ", "Contact the administrator!" + '\n' + e, "error");
        }
    }
</script>

</body>

</html>
