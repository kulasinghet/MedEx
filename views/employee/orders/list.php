<?php

use app\controllers\employee\EmployeeOrdersController;
use app\stores\EmployeeStore;
use app\views\employee\EmployeeViewComponents;

const no_of_reports = 10;

$components = new EmployeeViewComponents();
$store = EmployeeStore::getEmployeeStore();
$set = $store->flag_g_st; // getting the number of set
$store->flag_g_st = 0; // resetting the set number in the store
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Orders: Pharmacy list</title>

    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
    <!-- Simplebar -->
    <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css"/>
    <script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- g28 style -->
    <link rel="stylesheet" href="/scss/main.css" />
    <link rel="stylesheet" href="/scss/vendor/employee.css" />
    <script src="/js/g28-main.js"></script>
</head>
<body>
<!-- Section: Fixed Components -->
<?php
echo $components->createSidebar('orders');
echo $components->createNavbar();
$store->renderNotification();
?>
<!-- Section: Fixed Components -->

<!-- Section: Dashboard Layout -->
<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <!-- Toolbox -->
        <div class="toolbox">
            <div class="block row">
                <div class="col">
                    <div class="nav-search">
                        <form onsubmit="preventDefault();" role="search">
                            <label for="filter-by-search">Search for stuff</label>
                            <input autofocus id="filter-by-search" placeholder="Search..." required type="search"/>
                            <button type="submit">Go</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="separator"></div>
            <form class="block row" method="POST" action="">
                <div class="col">
                    <label for="sort-by">Sort by: </label>
                </div>
                <div class="col">
                    <g28-selectbox id="sort-by" class="filtering-selectbox" placeholder="Default">
                        Default, Pending, Accepted, Rejected
                    </g28-selectbox>
                </div>
            </form>
        </div>
        <!-- Toolbox -->

        <!-- Content -->
        <div class="row margin-bottom">
            <div class="col">
                <table class="table approval-table">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Pharmacy Username</th>
                        <th>Status</th>
                        <th>Order Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $controller = new EmployeeOrdersController();
                    try {
                        $res_list = $controller->getOrderList(no_of_reports, $set);
                        if (!empty($res_list)) {
                            foreach ($res_list as $item) {
                                echo $components->createOrderItem($item);
                            }
//                            for ($i = 0; $i < no_of_reports; $i++) {
//                                if (array_key_exists($i, $res_list)) {
//                                    echo $components->createOrderItem($res_list[$i]);
//                                } else {
//                                    echo "<tr class='empty'>";
//                                    echo "<td colspan='5'></td>";
//                                    echo "</tr>";
//                                }
//                            }
                        } else {
                            echo "<tr class='empty'>";
                            echo "<td class='no-data' colspan='5' rowspan='".no_of_reports."'>No records found!</td>";
                            echo "</tr>";
                            for ($i = 0; $i < no_of_reports - 1; $i++) {
                                echo "<tr></tr>";
                            }
                        }
                    } catch (Exception $e) {
                        echo "Something went wrong! $e";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Content -->
    </div>
</div>
<!-- Section: Dashboard Layout -->

<!-- g28 styling framework -->
<script type="application/javascript">
    // you can configure variables in here.
    configs.stage = 'dev';
    configs.scssStylePath = '../scss/';

    // handles the click event of the table rows
    document.querySelectorAll('.approval-table tbody tr:not(.empty)').forEach((row) => {
        row.addEventListener('click', (e) => {
            e.stopPropagation();
            if (e.target.tagName === 'TD') {
                let id = row.getAttribute('data-id');
                let type = row.getAttribute('data-tp');
                handleViewOrderDetailsClick(id);
            }
        });
    });

    // handles the alert when a row item is clicked
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
            if (orderData !== undefined || orderData.length > 0) {
                orderInformationForSwal += '<div class="order-details">';
                orderInformationForSwal += '<div class="order-details-row">';
                orderInformationForSwal += '<h4>Order Date: ' + (await orderData).orderDate + '</h4>';
                orderInformationForSwal += '<h4>Order Status: ' + (await orderData).orderStatus + '</h4>';
                orderInformationForSwal += '</div>';
                orderInformationForSwal += '<div class="order-details-row">';
                orderInformationForSwal += '<h4>Order Total Price: ' + (await orderData).totalPrice + '</h4>';
                orderInformationForSwal += '<h4>Supplier: ' + (await orderData).supName + '</h4>';
                orderInformationForSwal += '</div>';
                orderInformationForSwal += '</div>';

            }

            let medicineInformationForSwal = '';

            if (orderedMedicines !== undefined || orderedMedicines.length > 0) {
                medicineInformationForSwal = '<table><th>Medicine ID</th><th>Medicine</th> <th>Medicine Scientific Name</th><th>Price</th><th>Quantity</th><th>Total Price</th>';
                for (let key in orderedMedicines) {
                    medicineInformationForSwal += '<tr>';
                    medicineInformationForSwal += '<td>' + orderedMedicines[key].medId + '</td>';
                    medicineInformationForSwal += '<td>' + orderedMedicines[key].medName + '</td>';
                    medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].sciName + '</td>';
                    medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].unitPrice + '</td>';
                    medicineInformationForSwal += '<td style="text-align: center">' + orderedMedicines[key].quantity + '</td>';
                    medicineInformationForSwal += '<td style="text-align: center">' + parseInt(orderedMedicines[key].unitPrice) * parseInt(orderedMedicines[key].quantity) + '</td>';
                    medicineInformationForSwal += '</tr>';
                }
                medicineInformationForSwal += '<tr style="color: #071232; font-size: 1rem; font-weight: bold"><td>Total</td><td colspan="4"></td><td style="text-align: center">' + orderData.totalPrice + '</td></tr>';
                medicineInformationForSwal += '</table>';
            } else {
                medicineInformationForSwal = '<h4>No Medicine Ordered</h4>';
            }

            if (orderData.orderStatus === 'Pending')
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
                        accept: "Accept",
                        reject: "Reject",
                        cancel: "Close",
                    },
                }).then((value) => {
                    switch (value) {
                        case "accept":
                            // Accept button clicked
                            fetch(`/employee/orders/action?id=${$orderId}&st=Accepted`)
                                .then(response => {
                                    window.location.href = response.url;
                                });
                            break;
                        case "reject":
                            // Reject button clicked
                            swal("Are you sure? This action cannot be undone!", {
                                buttons: {
                                    confirm: {
                                        text: "Yes",
                                        value: 'yes',
                                        visible: true,
                                        className: "",
                                        closeModal: true
                                    },
                                    cancel: {
                                        text: "No",
                                        value: 'no',
                                        visible: true,
                                        className: "",
                                        closeModal: true,
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

                                        fetch(`/employee/orders/action?id=${$orderId}&st=Rejected`)
                                            .then(response => {
                                                window.location.href = response.url;
                                            });

                                        // fetch(`/pharmacy/api/cancel-order?orderId=${$orderId}`)
                                        //     .then(response => response.json())
                                        //     .then(data => {
                                        //         swal.close();
                                        //         console.log(data);
                                        //         if (data === 'Order Cancelled') {
                                        //             swal("Order Cancelled!", '', "error");
                                        //             setTimeout(function () {
                                        //                 location.reload();
                                        //             }, 4000);
                                        //         } else {
                                        //             swal("Something went wrong!", "Contact the administrator!", "error");
                                        //         }
                                        //     });
                                        break;
                                    case 'no':
                                        // close the modal
                                        break;
                                }
                            });
                            break;
                        default:
                        // Modal closed without any button clicked
                        // Add your logic here
                    }
                });
            } else if (orderData.orderStatus === 'Processed by Admin') {
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

            } else {
                swal("Something went wrong!", "Contact the administrator!", "error");
            }
        } catch (e) {
            console.log(e);
            swal("Something went wrong!", "Contact the administrator!", "error");
        }
    }
</script>
<script src="/js/g28-forms.js"></script>
<script src="../js/g28-toast.js"></script>
<!-- g28 styling framework -->
</body>
</html>
