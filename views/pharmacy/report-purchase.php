<html lang="en">
<head>
    <title>Review Purchases | MedEx</title>
    <!--        <link href="../scss2/vendor/demo.css" rel="stylesheet"/>-->
    <link rel="stylesheet" href="/css/loginPage.css">
    <link href='/css/error-model.css' rel='stylesheet'>
    <link href="/css/dashboard.css" rel="stylesheet">
    <link href="/css/model.css" rel="stylesheet">
    <link href="/css/pharmacy/report.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!--        <link href='/css/error-model' rel='stylesheet'>-->
</head>

<body>

<div class="container">

    <div class="image">
        <img src="/res/logo/logo.svg" alt="loginPageImage">
        <p id="tagline">Efficiently Managing Medicines for Pharmacies</p>
    </div>

    <div class="sign-in-component">
        <h1>Review Purchase</h1>

        <form action="/report/medicine-order" method="post">
            <div class="input-field">

                <?php if (isset($orderId)) { ?>
                    <input  id="input"  type="text" name="orderID" placeholder="Order ID" required value="<?php echo $orderId ?>" style="margin-bottom: 0">
                <?php } else { ?>
                <input id="input" type="text" name="orderID" placeholder="Order ID" required style="margin-bottom: 0">
                <?php } ?>
            </div>

            <div class="star-rating">
                <input id="star-5" type="radio" name="rating" value="5" onclick="handleStarRating(id)"/>
                <label for="star-5" title="5 stars">
                    <i class="fas fa-star"></i>
                </label>
                <input id="star-4" type="radio" name="rating" value="4" onclick="handleStarRating(id)"/>
                <label for="star-4" title="4 stars">
                    <i class="fas fa-star"></i>
                </label>
                <input id="star-3" type="radio" name="rating" value="3" onclick="handleStarRating(id)"/>
                <label for="star-3" title="3 stars">
                    <i class="fas fa-star"></i>
                </label>
                <input id="star-2" type="radio" name="rating" value="2" onclick="handleStarRating(id)"/>
                <label for="star-2" title="2 stars">
                    <i class="fas fa-star"></i>
                </label>
                <input id="star-1" type="radio" name="rating" value="1" onclick="handleStarRating(id)"/>
                <label for="star-1" title="1 star">
                    <i class="fas fa-star"></i>
                </label>
            </div>


            <div class="input-field">
                <input id="input"  type="text" name="comment" placeholder="Comment">
            </div>

<!--            <button type="submit" class="btn" id="registerButton" onclick="hanleRegisterButton()">Report</button>-->
            <button type="submit" class="btn" id="registerButton">Report</button>
        </form>

        <script>
            function handleStarRating(id) {
                // get the id of the selected star
                let starID = id.split("-")[1];

                for (let i = 1; i <= 5; i++) {
                    // get the label element of the star
                    let star = document.getElementById("star-" + i).nextElementSibling;
                    if (i <= starID) {
                        star.querySelector("i").style.color = "#FFD700";
                        star.querySelector("i").style.content = "'\2606'";
                    } else {
                        star.querySelector("i").style.color = "#ddd";
                        star.querySelector("i").style.content = "'\2606'";
                    }
                }
            }

            function hanleRegisterButton() {

                let form = document.querySelector("form");
                let orderID = form.elements["orderID"].value;
                let rating = form.elements["rating"].value;
                let comment = form.elements["comment"].value;

                fetch('http://localhost:8080/report/medicine-order)', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        orderID: orderID,
                        rating: rating,
                        comment: comment
                    }),
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                        swal({
                            title: "Success!",
                            text: "Your report has been submitted successfully!",
                            icon: "success",
                            button: "OK",
                        }).then((value) => {
                            window.location.href = '/pharmacy/dashboard';
                        });
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        swal({
                            title: "Error!",
                            text: "Something went wrong!",
                            icon: "error",
                            button: "OK",
                        });
                    });
            }

        </script>

<!--            // todo: add a model for register button-->
        </div>
    </div>

</div>




<script>
    function openModal() {
        swal({
            title: "Please choose your account type",
            text: "",
            icon: "info",
            buttons: {
                pharmacy: {
                    text: "Pharmacy",
                    value: "pharmacy",
                },
                manufacturer: {
                    text: "Manufacturer",
                    value: "manufacturer",
                },
                distributor: {
                    text: "Distributor",
                    value: "distributor",
                },
                lab: {
                    text: "Lab",
                    value: "lab",
                },
                admin: {
                    text: "Admin",
                    value: "admin",
                },
            },
        })
            .then((value) => {
                switch (value) {
                    case "pharmacy":
                        // get the base url and redirect to the pharmacy register page
                        window.location.href = '/pharmacy/register';
                        break;
                    case "manufacturer":
                        window.location.href = '/manufacturer/register';
                        break;
                    case "distributor":
                        window.location.href = '/distributor/register';
                        break;
                    case "lab":
                        window.location.href = '/lab/register';
                        break;
                    case "admin":
                        window.location.href = '/admin/register';
                        break;
                }
            }
        );
    }
</script>




</body>
</html>
