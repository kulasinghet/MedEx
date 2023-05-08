<html lang="en">
<head>
    <title>Welcome | MedEx</title>
    <!--        <link href="../scss2/vendor/demo.css" rel="stylesheet"/>-->
    <link rel="stylesheet" href="/css/loginPage.css">
    <link href='/css/error-model.css' rel='stylesheet'>
    <link href="/css/dashboard.css" rel="stylesheet">
    <link href="/css/model.css" rel="stylesheet">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!--        <link href='/css/error-model' rel='stylesheet'>-->


    <link href="../scss2/vendor/demo.css" rel="stylesheet" />

    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>

</head>

<body>

<div class="container">

    <div class="image">
        <img src="/res/logo/logo.svg" alt="loginPageImage">
        <p id="tagline">Efficiently Managing Medicines for Pharmacies</p>
    </div>

    <div class="sign-in-component">

        <button id="registerButton" style="background-color: #2e60cc; margin-bottom: 2vh;">
            <a id="registerButtona" href="/login" style="background-color: #2e60cc; text-decoration: none">Login</a>
        </button>

        <div class="register-now">
            <!--            <button id="registerButton" data-modal-target="modal5">Register</button>-->
            <button id="registerButton" style="margin-top: 2vh;">
                <a id="registerButtona" onclick="openModal()">Register</a>
            </button>


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
                    text: "Supplier",
                    value: "supplier",
                },
                // distributor: {
                //     text: "Delivery Partner",
                //     value: "delivery",
                // },
                lab: {
                    text: "Lab",
                    value: "lab",
                },
            },
        })
            .then((value) => {
                    switch (value) {
                        case "pharmacy":
                            // get the base url and redirect to the pharmacy register page
                            window.location.href = '/pharmacy/register';
                            break;
                        case "supplier":
                            window.location.href = '/supplier/register';
                            break;
                        // case "delivery":
                        //     window.location.href = '/distributor/register';
                        //     break;
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
