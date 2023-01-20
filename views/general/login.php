<html lang="en">
<head>
    <title>Login | MedEx</title>
    <!--        <link href="../scss2/vendor/demo.css" rel="stylesheet"/>-->
    <link rel="stylesheet" href="/css/loginPage.css">
    <link href='/css/error-model' rel='stylesheet'>
    <link href="/css/model.css" rel="stylesheet">


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
            <a href="#popUp" id="openPopUp"> Register </a>
        </div>
    </div>

</div>


<script src="/js/model.js" defer></script>

<aside id="popUp" class="popup">
    <div class="popUpContainer">
        <header>
            <a href="#!" class="closePopUp">X</a>
            <h2>Who are you?</h2>
        </header>
        <article>
            <div class="entity-choose">
                <div class="entity">
                    <a href="/pharmacy/register">
                        <img src="/res/images/pharmacist.png" alt="pharmacist">
                        <p>Pharmacy</p>
                    </a>
                </div>
                <div class="entity">
                    <a href="/supplier/register">
                        <img src="/res/images/supplier.png" alt="supplier">
                        <p>Supplier</p>
                    </a>
                </div>
                <div class="entity">
                    <a href="/delivery/register">
                        <img src="/res/images/fast-delivery.png" alt="delivery">
                        <p>Delivery</p>
                    </a>
                </div>
                <div class="entity">
                    <a href="/lab/register">
                        <img src="/res/images/microscope.png" alt="lab">
                        <p>Lab</p>
                    </a>
                </div>


            </div>
        </article>
    </div>
    <a href="#!" class="closePopUpOutSide"></a>
</aside


</body>
</html>