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

                <div class="filter-group">

                    <div class="filter-group">

                        <div class="filter-by-date">
                            <label for="start-date">Start Date:</label>
                            <input type="date" name="start-date" id="start-date" onchange="handleFiltering()" value="<?php echo date('Y-m-d'); ?>">
                            <label for="end-date">End Date:</label>
                            <input type="date" name="end-date" id="end-date" onchange="handleFiltering()" value="<?php echo date('Y-m-d'); ?>">
                            <button class="date-filter" onclick="handleFiltering()">Filter</button>
                        </div>

                    </div>
                </div>

                <!--                order table-->
                <div class=" orders">
                    <table id="orders-table">
                        <thead>
                        <tr>
                            <th>Bill ID</th>
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
                <a class="btn ' . ($selectedPage == 'order-medicine' ? 'disabled' : '') . '" href="/pharmacy/sell-medicine">
                    <i class="fa-solid fa-circle-plus"></i> Sell Medicine</a>
            </div>

        </div>
    </div>
</div>

<script>
    function handleFiltering() {
        const startDate = new Date(document.getElementById('start-date').value);
        const endDate = new Date(document.getElementById('end-date').value);

        // check if the start date is greater than the end date
        if (startDate > endDate) {
            swal({
                title: "Error",
                text: "Start date cannot be greater than the end date",
                icon: "error",
                button: "OK",
            })
            return;
        }

        const allRows = Array.from(document.getElementById('orders-table').rows).slice(1);

        allRows.forEach(row => {
            const deliveryDate = new Date(row.cells[1].innerHTML);
            if (deliveryDate >= startDate && deliveryDate <= endDate) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });

        // change the filter button color
        const filterButtons = document.getElementsByClassName('date-filter');
        for (let i = 0; i < filterButtons.length; i++) {
            // add a red color to the button
            filterButtons[i].style.backgroundColor = '#ff0000';
            filterButtons[i].innerHTML = 'Clear Filter';
            filterButtons[i].onclick = function () {
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
                orderInformationForSwal += '<div class="order-details-row" style="width: 100%; justify-content: flex-end;">';
                orderInformationForSwal += '<h4 style="white-space: nowrap; text-align: end">' + orderData.invoiceDate + '</h4>';
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
                    title: "Bill Summary" + '\t' + $orderId,
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
