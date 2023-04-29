<html lang="en">
<head>
    <title>Login | MedEx</title>
    <!--        <link href="../scss2/vendor/demo.css" rel="stylesheet"/>-->
    <link rel="stylesheet" href="/css/loginPage.css">
    <link href='/css/error-model.css' rel='stylesheet'>
    <link href="/css/dashboard.css" rel="stylesheet">
    <link href="/css/model.css" rel="stylesheet">

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

        <form action="/login" method="post">
            <input type="text" name="username" id="username" placeholder="Username"/>
            <input type="password" name="password" id="password" placeholder="Password"/>

            <input type="submit" value="Log in" id="loginButton"/>

            <div class="register-now">
                <p><a href="/pharmacy/forgotPassword">Forgot Password?</a></p>
            </div>

        </form>

        <hr>

        <div class="register-now">
<!--            <button id="registerButton" data-modal-target="modal5">Register</button>-->
            <button id="registerButton">
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
