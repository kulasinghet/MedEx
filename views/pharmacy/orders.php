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

                <div class="filter-group">


                    <div class="filter-group">

                        <div class="filter-by-status">
                            <label for="filter-by-status">Filter by status</label>
                            <select name="filter-by-status" id="filter-by-status" onchange="handleFilteringByStatus() ">
                                <option value="Clear" selected>All</option>
                                <option value="Pending">Pending</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Rejected">Rejected</option>
                                <option value="Delivering">On the way</option>
                                <option value="Delivered">Delivered</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div class="filter-by-date">
                            <label for="start-date">Start Date:</label>
                            <input type="date" name="start-date" id="start-date" onchange="handleFiltering()"
                                   value="<?php echo date('Y-m-d'); ?>">
                            <label for="end-date">End Date:</label>
                            <input type="date" name="end-date" id="end-date" onchange="handleFiltering()"
                                   value="<?php echo date('Y-m-d'); ?>">
                            <button class="date-filter" onclick="handleFiltering()">Filter</button>
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
                                        echo "<td>" . $pharmacyOrderHistoryController->transformOrderTotal($order['order_total'], $order['order_status'] ) . "</td>";
                                        echo "<td>" . $pharmacyOrderHistoryController->transformDeliveryDate($order['delivery_date'], $order['order_status'] ) . "</td>";
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
                <a class="btn ' . ($selectedPage == 'order-medicine' ? 'disabled' : '') . '"
                   href="/pharmacy/order-medicine"> <i class="fa-solid fa-truck-moving"></i> Order Medicine </a>
            </div>

        </div>
    </div>
</div>

<script>

    function handleFiltering() {
        const filterByStatus = document.getElementById('filter-by-status').value;
        const startDate = new Date(document.getElementById('start-date').value);
        const endDate = new Date(document.getElementById('end-date').value);

        // check if the start date is greater than the end date
        if (startDate > endDate) {
            swal({
                title: "Error",
                text: "Start date cannot be greater than the end date",
                icon: "error",
                button: "OK",
            });
            return;
        }

        const allRows = Array.from(document.getElementById('orders-table').rows).slice(1);
        const filteredRows = [];

        allRows.forEach(row => {
            const deliveryDate = new Date(row.cells[1].innerHTML);
            if ((filterByStatus === 'Clear' || row.classList.contains(filterByStatus))
                && deliveryDate >= startDate && deliveryDate <= endDate) {
                filteredRows.push(row);
            }
        });

        // hide all rows and then show filtered rows
        allRows.forEach(row => {
            row.style.display = 'none';
        });
        filteredRows.forEach(row => {
            row.style.display = 'table-row';
        });

        // change the filter button color and text
        const filterButtons = document.getElementsByClassName('date-filter');
        for (let i = 0; i < filterButtons.length; i++) {
            filterButtons[i].style.backgroundColor = filteredRows.length > 0 ? '#ff0000' : '#fff';
            filterButtons[i].innerHTML = filteredRows.length > 0 ? 'Clear Filter' : 'Filter';
            filterButtons[i].onclick = filteredRows.length > 0 ? function () {
                // clear the filter
                allRows.forEach(row => {
                    row.style.display = 'table-row';
                });
                // change the value of the date inputs
                document.getElementById('start-date').value = new Date().toISOString().slice(0, 10);
                document.getElementById('end-date').value = new Date().toISOString().slice(0, 10);
                filterButtons[i].style.backgroundColor = '#fff';
                filterButtons[i].innerHTML = 'Filter';
                filterButtons[i].onclick = handleFiltering;
            } : handleFiltering;
        }
    }

    function handleFilteringByStatus() {
        const filterByStatus = document.getElementById('filter-by-status').value;
        const startDate = new Date(document.getElementById('start-date').value);
        const endDate = new Date(document.getElementById('end-date').value);
        const today = new Date().toISOString().slice(0, 10);
        const allRows = Array.from(document.getElementById('orders-table').rows).slice(1);

        if (filterByStatus === 'All' && startDate.toISOString().slice(0, 10) === today && endDate.toISOString().slice(0, 10) === today) {
            // Show all orders without any filtering if status is "All" and date range is set to today
            allRows.forEach(row => {
                row.style.display = 'table-row';
            });
            // change the filter by status button value to "Clear"
            document.getElementById('filter-by-status').value = 'Clear';
        } else {
            allRows.forEach(row => {
                console.log(filterByStatus + ' ' + row.classList + ' ' + row.classList.contains(filterByStatus));
                if (filterByStatus === 'Clear') {
                    row.style.display = 'table-row';
                } else if (row.classList.contains(filterByStatus)) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // change the filter button color
        const filterButtons = document.getElementsByClassName('date-filter');
        for (let i = 0; i < filterButtons.length; i++) {
            // add a red color to the button
            filterButtons[i].style.backgroundColor = '#ff0000';
        }

        // after filtering by status, the date filter button should be disabled
        handleFiltering();
    }


</script>

<script>

    //
    // if document is ready add event listener to all class view-order

    document.addEventListener('DOMContentLoaded', function () {
        var viewOrderButtons = document.getElementsByClassName('view-order');
        for (var i = 0; i < viewOrderButtons.length; i++) {
            viewOrderButtons[i].addEventListener('click', function () {
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
                content: {
                    element: "img",
                    attributes: {
                        // add loading gitf from internet
                        src: "https://i.gifer.com/ZZ5H.gif",
                        style: "width:25px; margin-bottom:20px;"
                    },
                }
            })

            const response = await fetch(`/pharmacy/api/order-details?orderId=${$orderId}`);
            const orderData = await response.json();
            // console.log(orderData.totalPrice);
            // {"orderId":"411205testPharmacy977","pharmacyId":"testPharmacy","orderDate":"2023-04-13","totalPrice":"230","orderStatus":"0","deliveryDate":null}

            const response2 = await fetch(`/pharmacy/api/order-medicine-details?orderId=${$orderId}`);
            // const orderedMedicines = await response2.json();

            // while response2 is loading show loading spinner


            const orderedMedicines = await response2.json();

            swal.close();


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
                medicineInformationForSwal = '<table><th>Medicine ID</th><th>Medicine</th> <th>Medicine Scientific Name</th><th>Price</th><th>Quantity</th><th>Total Price</th>';
                for (let key in orderedMedicines) {
                    medicineInformationForSwal += '<tr>';
                    medicineInformationForSwal += '<td>' + orderedMedicines[key].medId + '</td>';
                    medicineInformationForSwal += '<td>' + orderedMedicines[key].medName + '</td>';
                    medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].sciName + '</td>';
                    medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].unitPrice + '</td>';
                    medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].quantity + '</td>';
                    medicineInformationForSwal += '<td style="text-align: center">' + (parseFloat(orderedMedicines[key].unitPrice) * parseFloat(orderedMedicines[key].quantity)).toFixed(2) + '</td>';
                    medicineInformationForSwal += '</tr>';
                }
                medicineInformationForSwal += '<tr style="color: #071232; font-size: 1rem; font-weight: bold"><td>Total</td><td colspan="4"></td><td style="text-align: center">' + orderData.totalPrice + '</td></tr>';
                medicineInformationForSwal += '</table>';
            } else {
                medicineInformationForSwal = '<h4>No Medicine Ordered</h4>';
            }

            if (orderData.orderStatus == 'Pending')
            {
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
                                    cancel: {
                                        text: "No",
                                        value: 'no',
                                        visible: true,
                                        className: "",
                                        closeModal: true,
                                    },
                                    confirm: {
                                        text: "Yes",
                                        value: 'yes',
                                        visible: true,
                                        className: "",
                                        closeModal: true
                                    }
                                },
                            }).then((value) => {
                                switch (value) {
                                    case 'yes':

                                        swal({
                                            title: 'Loading',
                                            text: 'Please wait...',
                                            buttons: false,
                                            closeOnClickOutside: false,
                                            closeOnEsc: false,
                                            content: {
                                                element: "img",
                                                attributes: {
                                                    // add loading gitf from internet
                                                    src: "https://i.gifer.com/ZZ5H.gif",
                                                    style: "width:25px; margin-bottom:20px;"
                                                },
                                            }
                                        });

                                        fetch(`/pharmacy/api/cancel-order?orderId=${$orderId}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                swal.close();
                                                console.log(data);
                                                if (data == 'Order Cancelled') {
                                                    swal("Order Cancelled!", '', "error");
                                                    setTimeout(function () {
                                                        location.reload();
                                                    }, 1000);
                                                } else {
                                                    swal("Something went wrong!", "Contact the administrator!", "error");
                                                }
                                            });
                                        break;
                                    case 'no':
                                        // close the modal
                                        break;
                                }
                            });
                            break;
                        case null:
                            // close the modal
                            break;
                        default:
                            swal("Order Details", "Contact the administrator!", "error");
                    }
                });
            }
            else if (orderData.orderStatus == 'Rejected')
            {
                swal("Order Rejected!", "Contact the administrator!", "error");
            } else if (orderData.orderStatus == 'Cancelled')
            {
                swal("Order Cancelled!", "Contact the administrator!", "error");
            } else if (orderData.orderStatus == 'Accepted')
            {
                swal({
                    title: "Order Summary" + '\t' + $orderId,
                    content: {
                        element: "div",
                        attributes: {
                            innerHTML: orderInformationForSwal + medicineInformationForSwal,
                        }
                    },
                    buttons: {},
                })

            } else if (orderData.orderStatus == 'Delivering')
            {
                console.log('delivering');
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
                        confirm: "Track Order",
                    },
                }).then((value) => {
                    if (value) {

                        let location = fetch('/pharmacy/api/get-location?orderId=' + $orderId)
                            .then(response => response.json())
                            .then(data => {
                                console.log(data);
                                if (data == 'Order Not Found') {
                                    swal("Something went wrong!", "Contact the administrator!", "error");
                                } else {
                                    swal({
                                        title: "Track Order" + '\t' + $orderId,
                                        content: {
                                            element: "div",
                                            attributes: {
                                                innerHTML: '<div id="map" style="width: 100%; height: 400px"></div>',
                                            }
                                        },
                                        buttons: {
                                            cancel: "Close",
                                        },
                                    }).then((value) => {
                                        if (value) {
                                            // close the modal

                                        }
                                    });

                                    let map;
                                    let marker;
                                    let lat = parseFloat(data.latitude);
                                    let lng = parseFloat(data.longitude);
                                    let myLatLng = [lat, lng];

                                    function initMap() {
                                        map = L.map('map').setView(myLatLng, 15);

                                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                            maxZoom: 19,
                                            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
                                        }).addTo(map);

                                        marker = L.marker(myLatLng).addTo(map)
                                            .bindPopup('Delivery Partner is here')
                                            .openPopup();
                                    }

                                    initMap();

                                }
                            });
                    }
                });

            } else
            {
                swal("Something went wrong!", "Contact the administrator!", "error");
            }
        } catch (e) {
            console.log(e);
            swal("Something went wrong!", "Contact the administrator!", "error");
        }
    }

    // end the page
    // end the page
</script>

</body>
</html>
