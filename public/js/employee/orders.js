// handles the alert when a row item is clicked
async function handleViewOrderDetailsClick(orderId) {
    try {
        // buzzing model
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

        const response = await fetch(`/pharmacy/api/order-details?orderId=${orderId}`);
        const orderData = await response.json();

        const response2 = await fetch(`/employee/orders/medicine-details?orderId=${orderId}`);
        const orderedMedicines = await response2.json();

        swal.close();
        // buzzing model


        // Order model
        let orderInformationForSwal = '';
        if (orderData !== undefined || orderData.length > 0) {
            orderInformationForSwal = `
            <div class="row">
                <div class="col">
                    <table class="status-table">
                        <tbody>
                            <tr>
                                <th>Order Date</th>
                                <td>${(await orderData).orderDate}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>${(await orderData).orderStatus}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                    <table class="status-table">
                        <tbody>
                            <tr>
                                <th>Total Price</th>
                                <td>${(await orderData).totalPrice}</td>
                            </tr>
                            <tr>
                                <th>Delivary Date</th>
                                <td>${(await orderData).deliveryDate}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            `;
        }

        let medicineInformationForSwal = '';
        let acceptedMedicineCount = 0;

        if (orderedMedicines !== undefined || orderedMedicines.length > 0) {

            medicineInformationForSwal = `
<table class="medicine-table">
    <caption>Ordered Medicine Details</caption>
    <thead>
    <tr>
      <th scope="col">Medicine ID</th>
      <th scope="col">Medicine</th>
      <th scope="col">Supplier</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total Price (Rs)</th>
    </tr>
    </thead>
    <tbody>`;

            for (let key in orderedMedicines) {
                let is_supplier_accepted = orderedMedicines[key].supName !== null;
                if (is_supplier_accepted) acceptedMedicineCount++;

                medicineInformationForSwal += `
<tr` + (is_supplier_accepted? ` class="green"` : ` class="red"`) + `>
    <td>` + orderedMedicines[key].medId + `</td>
    <td>` + orderedMedicines[key].medName + `</td>
    <td>` + (orderedMedicines[key].supName?? "N/A") + `</td>
    <td>` + orderedMedicines[key].quantity + `</td>
    <td>` + parseFloat(orderedMedicines[key].unitPrice).toFixed(2) * parseInt(orderedMedicines[key].quantity) + `</td>
</tr>`;
            }

            medicineInformationForSwal += `
<tr style="color: #071232; font-size: 1rem; font-weight: bold">
    <td>Total</td>
    <td colspan="3"></td>
    <td style="text-align: center">` + orderData.totalPrice + `</td>
</tr>`;

            medicineInformationForSwal += '</tbody></table>';
        } else {
            medicineInformationForSwal = '<h4>No Medicine Ordered</h4>';
        }

        localStorage.setItem('orderId', orderId);

        if (orderData.orderStatus === 'Pending' && acceptedMedicineCount === orderedMedicines.length)
        {
            swal({
                title: "Order Summary" + '\t' + orderId,
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
                        fetch(`/employee/orders/action?id=${orderId}&st=Accepted`)
                            .then(r => r.json())
                            .then(data => {
                                swal.close();
                                if (data.success) {
                                    swal({
                                        title: "Order Accepted!",
                                        buttons: {
                                            accept: "Print Order",
                                            cancel: "Close",
                                        },
                                    }).then((value) => {
                                        switch (value) {
                                            case "accept":
                                                let id = localStorage.getItem('orderId');
                                                window.open(`https://medex28.tech/pdf/${id}.pdf`, '_blank');
                                                location.reload();
                                                break;
                                            case "cancel":
                                                location.reload();
                                                break;
                                        }
                                    });
                                } else {
                                    swal("Something went wrong!", "Contact the administrator!", "error");
                                }
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

                                    fetch(`/employee/orders/action?id=${orderId}&st=Rejected`)
                                        .then(r => r.json())
                                        .then(data => {
                                            swal.close();
                                            if (data.success) {
                                                swal("Order Rejected!", '', "success");
                                                setTimeout(function () {
                                                    location.reload();
                                                }, 4000);
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
                    default:
                    // Modal closed without any button clicked
                    // Add your logic here
                }
            });
        } else if (orderData.orderStatus === 'Pending' && acceptedMedicineCount < orderedMedicines.length) {
            swal({
                title: "Order Summary" + '\t' + orderId,
                content: {
                    element: "div",
                    attributes: {
                        innerHTML: orderInformationForSwal + medicineInformationForSwal,
                    }
                },
                buttons: {
                    reject: "Reject",
                    cancel: "Close",
                },
            }).then((value) => {
                switch (value) {
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

                                    fetch(`/employee/orders/action?id=${orderId}&st=Rejected`)
                                        .then(r => r.json())
                                        .then(data => {
                                            swal.close();
                                            if (data.success) {
                                                swal("Order Rejected!", '', "success");
                                                setTimeout(function () {
                                                    location.reload();
                                                }, 4000);
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
                    default:
                    // Modal closed without any button clicked
                    // Add your logic here
                }
            });
        } else if (orderData.orderStatus === 'Processed by Admin' || orderData.orderStatus === 'Rejected') {
            swal({
                title: "Order Summary" + '\t' + orderId,
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