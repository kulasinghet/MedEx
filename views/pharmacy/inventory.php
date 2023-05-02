<?php

use app\views\pharmacy\Components;
use app\controllers\pharmacy\PharmacyInventoryController;
use app\core\ExceptionHandler;

$components = new Components();
echo $components->viewHeader("Inventory");
echo $components->navBar($_SESSION['username']);
echo $components->sideBar('inventory');

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
                        <input id="search-medicine" placeholder="Search Medicine . . ." required type="search"
                               onchange="showMedicineRowOnSearch(event)">
                        <button type="submit" onclick="showMedicineRowOnSearch(event)">Go</button>
                    </form>
                </div>

                <script>
                    function showMedicineRowOnSearch(event) {

                        // prevent default form submit
                        event.preventDefault();

                        // get search value
                        let search = document.getElementById('search-medicine').value;
                        let orderMedicineRows = document.getElementsByClassName('order-medicine-row');

                        for (let i = 0; i < orderMedicineRows.length; i++) {
                            orderMedicineRows[i].classList.remove('order-medicine-row-after');
                            orderMedicineRows[i].classList.add('order-medicine-row-before');
                        }
                        if (search === "") {
                            for (let i = 0; i < orderMedicineRows.length; i++) {
                                orderMedicineRows[i].classList.remove('order-medicine-row-before');
                                orderMedicineRows[i].classList.add('order-medicine-row-after');
                            }
                        }

                        let flag = false;
                        if (search !== "") {
                            for (let i = 0; i < orderMedicineRows.length; i++) {
                                let medicineId = orderMedicineRows[i].getAttribute('data-id');
                                if (medicineId.toLowerCase().includes(search.toLowerCase())) {
                                    // change class name
                                    orderMedicineRows[i].classList.remove('order-medicine-row-before');
                                    orderMedicineRows[i].classList.add('order-medicine-row-after');
                                    // document.getElementById('clear-filter').classList.remove('clear-filter-icon-hidden');
                                    flag = true;
                                } else {
                                    orderMedicineRows[i].classList.remove('order-medicine-row-after');
                                    orderMedicineRows[i].classList.add('order-medicine-row-before');
                                }
                            }
                            if (flag === false) {
                                swal("No medicine found", "Please try again", "error");
                            }
                        }
                    }
                </script>

                <!--                order table-->
                <div class=" orders">
                    <table id="inventory-table">
                        <thead>
                        <tr>
                            <th>Medicine ID</th>
                            <th>Medicine Name</th>
                            <th>Medicine Scientific Name</th>
                            <th>Remaining Quantity</th>
                            <th>Buying Price</th>
                            <th>Selling Price</th>
                            <th>Remaining Days</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'pharmacy') {
                            try {
                                $username = $_SESSION['username'];
                                $pharmacyInventoryController = new PharmacyInventoryController();
                                $stocks = $pharmacyInventoryController->getInventoryByUsername($username);
                                if ($stocks) {
                                    foreach ($stocks as $stock) {
                                        echo "<tr" . " class='" . $pharmacyInventoryController->remainingDays($stock['remaining_days']) . " order-medicine-row order-medicine-row-after' data-id='" . $stock['medId'] . $stock['sciName'] . $stock['medName'] . "'>";
                                        echo "<td>" . $stock['medId'] . "</td>";
                                        echo "<td>" . $pharmacyInventoryController->transformMedicineName($stock['medId']) . "</td>";
                                        echo "<td>" . $stock['sciName'] . "</td>";
                                        echo "<td>" . $stock['remQty'] . "</td>";
                                        echo "<td>" . $stock['buying_price'] . "</td>";
                                        echo "<td>" . $stock['sellingPrice'] . "</td>";
                                        echo "<td>" . $stock['remaining_days'] . "</td>";
                                        echo "<td>" . "<a class='view-stock' id='" . $stock['medId'] . "'>" . "<i class='fa-solid fa-circle-arrow-right view-order-details' style='color:#333333'></i>" . "</a>" . "</td>";
                                        echo "</a>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colspan='7' style='text-align: center'>You don't have any medicine in your inventory</td>";
                                    echo "</tr>";
                                }
                            } catch (Exception $e) {
                                echo (new ExceptionHandler)->somethingWentWrong();
                            }
                        } else {
                            echo "<tr>";
                            echo "<td colspan='7' style='text-align: center'>You don't have any medicine in your inventory</td>";
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

    <script>
        async function handleViewStockDetailsClick(id) {
            if (id == '') {
                swal("Something went wrong", "Please try again", "error");
            } else {

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


                    const response = await fetch(`/pharmacy/api/medicine-details?medicine-id=${id}`);
                    const data = await response.json();
                    console.log(data);

                    swal.close();

                    const htmlcontentForSwal = `
    <div class="medicine-details" id="medicine-details">
        <form>
            <div class="medicine-details-row">
                <div class="medicine-details-col">
                    <div class="medicine-details-row">
                        <div class="medicine-details-col-4">
                            <h3>Medicine ID</h3>
                        </div>
                        <div class="medicine-details-col-6">
                            <h3 id="medicine-id">${data.medId}</h3>
                        </div>
                    </div>
                    <div class="medicine-details-row">
                        <div class="medicine-details-col-4">
                            <h3>Medicine Name</h3>
                        </div>
                        <div class="medicine-details-col-6">
                            <h3 id="medicine-name">${data.medName}</h3>
                        </div>
                    </div>
                    <div class="medicine-details-row">
                        <div class="medicine-details-col-4">
                            <h3>Scientific Name</h3>
                        </div>
                        <div class="medicine-details-col-6">
                            <h3 id="medicine-scientific-name">${data.sciName}</h3>
                        </div>
                    </div>
                    <div class="medicine-details-row">
                        <div class="medicine-details-col-4">
                            <h3>Remaining Quantity</h3>
                        </div>
                        <div class="medicine-details-col-6">
                            <div class="form-group">
                                <input type="number" class="form-input" id="remQty" value='${data.remQty}' min="1"
                                       name="remQty" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="medicine-details-row">
                        <div class="medicine-details-col-4">
                            <h3>Recieved Date</h3>
                        </div>
                        <div class="medicine-details-col-6">
                            <div class="form-group">
                                <input type="date" class="form-input" id="recievedDate" value='${data.receivedDate}' min="1"
                                       name="recievedDate" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="medicine-details-col">
                    <div class="medicine-details-row">
                        <div class="medicine-details-col-4">
                            <h3>Buying Price</h3>
                        </div>
                        <div class="medicine-details-col-6">
                            <h3 id="buying-price">${data.buying_price}</h3>
                        </div>
                    </div>
                    <div class="medicine-details-row">
                        <div class="medicine-details-col-4">
                            <h3>Selling Price</h3>
                        </div>
                        <div class="medicine-details-col-6">
                            <div class="form-group">
                                <input type="number" class="form-input" id="sellingPrice" value='${data.sellingPrice}' min="1"
                                        name="sellingPrice" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="medicine-details-row">
                        <div class="medicine-details-col-4">
                            <h3>Remaining Days</h3>
                        </div>
                        <div class="medicine-details-col-6">
                            <div class="form-group">
                                <h3 id="remaining-days">${data.remaining_days}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="medicine-details-row">
                        <div class="medicine-details-col-4">
                            <h3>Consumption Rate</h3>
                        </div>
                        <div class="medicine-details-col-6">
                            <div class="form-group">
                                <input type="number" class="form-input" id="consumption" value='${data.consumption_rate}' min="1" disabled name="consumption" step="0.01">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>`;

                    swal({
                        title: "Medicine Details",
                        content: {
                            element: "div",
                            attributes: {
                                innerHTML: htmlcontentForSwal,
                            },
                        },
                        buttons: {
                            cancel: true,
                            update: {
                                text: "Update",
                                value: "update",
                                visible: false,
                                className: "btn btn-success",
                                closeModal: false
                            },
                            confirm: {
                                text: "Edit",
                                value: "edit",
                                visible: true,
                                className: "btn btn-danger",
                                closeModal: true
                            },
                        }
                    }).then((value) => {
                        if (value == 'edit') {


                            const htmlcontentForSwal = `
    <div class="medicine-details" id="medicine-details">
        <form>
            <div class="medicine-details-row">
            <div class="medicine-details-col">
                <div class="medicine-details-row">
                    <div class="medicine-details-col-4">
                        <h3>Medicine ID</h3>
                    </div>
                    <div class="medicine-details-col-6">
                        <h3 id="medicine-id">${data.medId}</h3>
                    </div>
                </div>
                <div class="medicine-details-row">
                    <div class="medicine-details-col-4">
                        <h3>Medicine Name</h3>
                    </div>
                    <div class="medicine-details-col-6">
                        <h3 id="medicine-name">${data.medName}</h3>
                    </div>
                </div>
                <div class="medicine-details-row">
                    <div class="medicine-details-col-4">
                        <h3>Scientific Name</h3>
                    </div>
                    <div class="medicine-details-col-6">
                        <h3 id="medicine-scientific-name">${data.sciName}</h3>
                    </div>
                </div>
                <div class="medicine-details-row">
                    <div class="medicine-details-col-4">
                        <h3>Remaining Quantity</h3>
                    </div>
                    <div class="medicine-details-col-6">
                        <div class="form-group">
                            <input type="number" class="form-input" id="remQty" value='${data.remQty}' min="1"
                                   name="remQty" >
                        </div>
                    </div>
                </div>
                <div class="medicine-details-row">
                    <div class="medicine-details-col-4">
                        <h3>Recieved Date</h3>
                    </div>
                    <div class="medicine-details-col-6">
                        <div class="form-group">
                            <input type="date" class="form-input" id="recievedDate" value='${data.receivedDate}' min="1"
                                   name="recievedDate">
                        </div>
                    </div>
                </div>
            </div>

            <div class="medicine-details-col">
                <div class="medicine-details-row">
                    <div class="medicine-details-col-4">
                        <h3>Buying Price</h3>
                    </div>
                    <div class="medicine-details-col-6">
                        <h3 id="buying-price">${data.buying_price}</h3>
                    </div>
                </div>
                <div class="medicine-details-row">
                    <div class="medicine-details-col-4">
                        <h3>Selling Price</h3>
                    </div>
                    <div class="medicine-details-col-6">
                        <div class="form-group">
                            <input type="number" class="form-input" id="sellingPrice" value='${data.sellingPrice}' min="1"
                                    name="sellingPrice">
                        </div>
                    </div>
                </div>
                <div class="medicine-details-row">
                    <div class="medicine-details-col-4">
                        <h3>Remaining Days</h3>
                    </div>
                    <div class="medicine-details-col-6">
                        <div class="form-group">
                            <h3 id="remaining-days">${data.remaining_days}</h3>
                        </div>
                    </div>
                </div>
                <div class="medicine-details-row">
                    <div class="medicine-details-col-4">
                        <h3>Consumption Rate</h3>
                    </div>
                    <div class="medicine-details-col-6">
                        <div class="form-group">
                            <input type="number" class="form-input" id="consumption" value='${data.consumption_rate}' min="1" name="consumption" step="0.01">
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </form>
    </div>`;

                            swal({
                                title: "Medicine Details",
                                content: {
                                    element: "div",
                                    attributes: {
                                        innerHTML: htmlcontentForSwal,
                                    },
                                },
                                buttons: {
                                    cancel: true,
                                    update: {
                                        text: "Update",
                                        value: "update",
                                        visible: true,
                                        className: "btn btn-success",
                                        closeModal: false
                                    },
                                }
                            }).then((value) => {
                                if (value == 'update') {
                                    const pharmacyName = document.getElementsByClassName('nav-profile-name')[0].innerText;
                                    console.log('pharmacyName', pharmacyName);
                                    const remQty = document.getElementById('remQty').value;
                                    const recievedDate = document.getElementById('recievedDate').value;
                                    const sellingPrice = document.getElementById('sellingPrice').value;
                                    const remainingDays = document.getElementById('remaining-days').innerText;
                                    const medId = document.getElementById('medicine-id').innerText;
                                    const buyingPrice = document.getElementById('buying-price').innerText;
                                    const medName = document.getElementById('medicine-name').innerText;
                                    const sciName = document.getElementById('medicine-scientific-name').innerText;
                                    const consumption = document.getElementById('consumption').value;
                                    const data = {
                                        pharmacyName: pharmacyName,
                                        medId: medId,
                                        medName: medName,
                                        recievedDate: recievedDate,
                                        sciName: sciName,
                                        remQty: remQty,
                                        buyingPrice: buyingPrice,
                                        sellingPrice: sellingPrice,
                                        remainingDays: remainingDays,
                                        consumption: consumption
                                    };

                                    console.log('payload', data);

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


                                    fetch('/pharmacy/api/update-medicine', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                        },
                                        body: JSON.stringify(data),
                                    }).then((response) => {

                                        swal.close();

                                        if (response.status == 200) {
                                            swal("Medicine Updated Successfully", "", "success");
                                            setTimeout(function () {
                                                location.reload();
                                            }, 1000);
                                        } else {
                                            console.log(response);
                                            swal("Something went wrong", "Please try again", "error");
                                        }
                                    }).catch((error) => {
                                        console.log(error);
                                    });
                                }
                            });

                        }
                    }).catch((error) => {
                        console.log(error);
                    });


                } catch (e) {
                    console.log(e);
                    swal("Something went wrong", "Please try again", "error");
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            var viewOrderButtons = document.getElementsByClassName('view-stock');
            for (var i = 0; i < viewOrderButtons.length; i++) {
                viewOrderButtons[i].addEventListener('click', function () {
                    // pass id of the anchor tag to the function
                    handleViewStockDetailsClick(this.id);
                });
            }
        });
    </script>


</div>


</body>

</html>
