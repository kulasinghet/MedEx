<?php

use app\controllers\pharmacy\PharmacyOrderHistoryController;
use app\core\ExceptionHandler;
use app\views\pharmacy\Components;

$components = new Components();
echo $components->viewHeader("Order History");
echo $components->navBar($_SESSION['username']);
echo $components->sideBar('orders');
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

                        <div class="filter-by-status">
                            <label for="filter-by-status">Filter by status</label>
                            <select name="filter-by-status" id="filter-by-status" onchange="handleFiltering() " >
                                <option value="Clear" selected >All</option>
                                <option value="Pending">Pending</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Rejected">Rejected</option>
                                <option value="Delivered">Delivered</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div class="filter-by-date">
                            <label for="filter-by-date">Filter by order date</label>
                            <select name="filter-by-date" id="filter-by-date" onchange="handleFiltering()">
                                <option value="Clear" selected>All</option>
                                <option value="Today">Today</option>
                                <option value="This Week">This Week</option>
                                <option value="This Month">This Month</option>
                                <option value="This Year">This Year</option>
                            </select>
                        </div>

                        <div class="filter-by-delivery-date">
                            <label for="filter-by-delivery-date">Filter by delivery date</label>
                            <select name="filter-by-delivery-date" id="filter-by-delivery-date" onchange="handleFiltering()">
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
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Order Total</th>
                                <th>Delivery Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'pharmacy') {
                                try {
                                    $username = $_SESSION['username'];
                                    $pharmacyOrderHistoryController = new PharmacyOrderHistoryController();
                                    $orders = $pharmacyOrderHistoryController->getOrdersByUsername($username);
                                    if ($orders) {
                                        foreach ($orders as $order) {
                                            echo "<tr" . " class='" . $pharmacyOrderHistoryController->transformOrderStatus($order['order_status']) . "' tag='" . $pharmacyOrderHistoryController->transformOrderStatus($order['order_status']) . "'>";
                                            echo "<td>" . $order['id'] . "</td>";
                                            echo "<td>" . $order['order_date'] . "</td>";
                                            echo "<td>" . $pharmacyOrderHistoryController->transformOrderStatus($order['order_status']) . "</td>";
                                            echo "<td>" . $pharmacyOrderHistoryController->transformOrderTotal($order['order_total']) . "</td>";
                                            echo "<td>" . $pharmacyOrderHistoryController->transformDeliveryDate($order['delivery_date']) . "</td>";
                                            echo "<td>" . "<a class='view-order' id='" . $order['id'] . "'>" . "<i class='fa-solid fa-circle-arrow-right view-order-details' style='color:#333333'></i>" . "</a>" . "</td>";
//                                            echo "<td>" . "<a onclick='handleViewOrderDetailsClick(" . $order['id'] . ")'>" . "<i class='fa-solid fa-circle-arrow-right view-order-details' style='color:#333333'></i>" . "</a>" . "</td>";
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
                <a class="btn ' . ($selectedPage == 'order-medicine' ? 'disabled' : '') . '" href="/pharmacy/order-medicine"> <i class="fa-solid fa-truck-moving"></i> Order Medicine </a>
            </div>

        </div>
    </div>
</div>

<script>
    function handleFiltering() {
        $statusFilter = document.getElementById('filter-by-status').value;
        $dateFilter = document.getElementById('filter-by-date').value;
        $deliveryDateFilter = document.getElementById('filter-by-delivery-date').value;

        $allRows = document.getElementById('orders-table').rows;
        $allRows = Array.prototype.slice.call($allRows, 1);

        for (let i = 0; i < $allRows.length; i++) {
            $allRows[i].style.display = 'table-row';
        }

        if ($statusFilter == 'Clear' && $dateFilter == 'Clear' && $deliveryDateFilter == 'Clear') {
            return;
        }

        for (let i = 0; i < $allRows.length; i++) {

            $row = $allRows[i];

            if ($statusFilter != $row.cells[2].innerHTML && $statusFilter != 'Clear') {
                $row.style.display = 'none';
            }

            if (checkOrderDateInFilter($row.cells[1].innerHTML, $dateFilter) ) {
                $row.style.display = 'none';
            }

            if (checkDeliveryDateInFilter($row.cells[4].innerHTML, $deliveryDateFilter) ) {
                $row.style.display = 'none';
            }
        }


    }

    function checkDeliveryDateInFilter($dateInRow, $filter) {

            $dateInRow = new Date($dateInRow);
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


    function handleSearchButtonClick(event) {

        event.preventDefault();

        $searchInput = document.getElementById('search-orders').value;

        $allRows = document.getElementById('orders-table').rows;
        // drop first row
        $allRows = Array.prototype.slice.call($allRows, 1);

        for (let i = 0; i < $allRows.length; i++) {
            $allRows[i].style.display = 'none';
        }

        for (let i = 0; i < $allRows.length; i++) {
            $row = $allRows[i];
            console.log($row);
            if ($allRows[i].innerHTML.toLowerCase().indexOf($searchInput.toLowerCase()) > -1) {
                $allRows[i].style.display = 'table-row';
            }
        }
    }

    function handleFilterButtonClick($filter) {
        $allRows = document.getElementById('orders-table').rows;
        $allButtons = document.getElementsByClassName('btn-primary');
        // drop first row
        $allRows = Array.prototype.slice.call($allRows, 1);
        console.log($allRows);

        for (let i = 0; i < $allRows.length; i++) {
            $allRows[i].style.display = 'table-row';
        }

        if ($filter == 'Clear') {
            return;
        }

        for (let i = 0; i < $allRows.length; i++) {
            if ($allRows[i].getAttribute('tag') != $filter) {
                $allRows[i].style.display = 'none';
            }
        }
    }

    function checkOrderDateInFilter($orderDate ,$filter) {

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

            const response = await fetch(`/pharmacy/api/order-details?orderId=${$orderId}`);
            const orderData = await response.json();
            // console.log(orderData.totalPrice);
            // {"orderId":"411205testPharmacy977","pharmacyId":"testPharmacy","orderDate":"2023-04-13","totalPrice":"230","orderStatus":"0","deliveryDate":null}

            const response2 = await fetch(`/pharmacy/api/order-medicine-details?orderId=${$orderId}`);
            const orderedMedicines = await response2.json();

            console.log(orderedMedicines);
            console.log(orderData);

            let orderInformationForSwal = '';
            if (orderData != undefined || orderData.length > 0) {
                orderInformationForSwal += '<div class="order-details">';
                orderInformationForSwal += '<div class="order-details-row">';
                orderInformationForSwal += '<h4>Order Date: ' + (await orderData).orderDate + '</h4>';
                orderInformationForSwal += '<h4>Order Status: ' + (await orderData).orderStatus + '</h4>';
                orderInformationForSwal += '</div>';
                orderInformationForSwal += '<div class="order-details-row">';
                orderInformationForSwal += '<h4>Order Total Price: ' + (await orderData).totalPrice + '</h4>';
                orderInformationForSwal += '<h4>Delivary Date: ' + (await orderData).deliveryDate + '</h4>';
                orderInformationForSwal += '</div>';
                orderInformationForSwal += '</div>';

            }

            let medicineInformationForSwal = '';

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
                medicineInformationForSwal += '<tr style="color: #071232; font-size: 1rem; font-weight: bold"><td>Total</td><td colspan="5"></td><td style="text-align: center">' + orderData.totalPrice + '</td></tr>';
                medicineInformationForSwal += '</table>';
            } else {
                medicineInformationForSwal = '<h4>No Medicine Ordered</h4>';
            }

            if (orderData.totalPrice > 0) {
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
                        confirm: "Cancel Order",
                    },
                }).then((value) => {
                    switch (value) {
                        case true:
                            swal("Are you sure? This action cannot be undone!", {
                                buttons: {
                                    cancel: "No",
                                    confirm: "Yes",
                                },
                            }).then((value) => {
                                switch (value) {
                                    case true:
                                        fetch(`/pharmacy/api/cancel-order?orderId=${$orderId}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                console.log(data);
                                                if (data == 'Order Cancelled') {
                                                    swal("Order Cancelled!", "Contact the administrator!", "error");
                                                    location.reload();
                                                } else {
                                                    swal("Something went wrong!", "Contact the administrator!", "error");
                                                }
                                            });
                                        break;
                                    default:
                                        swal("Order Details", "Contact the administrator!", "error");
                                }
                            });
                            break;
                        default:
                            swal("Order Details", "Contact the administrator!", "error");
                    }
                });
            } else if  (orderData.totalPrice == 'Rejected') {
                swal("Order Rejected!", "Contact the administrator!", "error");
            } else if (orderData.totalPrice == 'Cancelled') {
                swal("Order Cancelled!", "Contact the administrator!", "error");
            } else {
                swal("Something went wrong!", "Contact the administrator!", "error");
            }

        } catch (e) {
            console.log("Error: " + e);
            swal("Something went wrong! ", "Contact the administrator!" + '\n' + e, "error");
        }
    }
</script>

</body>

</html>
