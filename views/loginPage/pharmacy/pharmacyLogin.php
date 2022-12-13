<html lang="en">
    <head>
        <title>Login - MedEx</title>
        <link rel="stylesheet" href="/css/loginPage/loginPage.css">
    </head>

    <body>

<!--        <h1>Login</h1>-->
<!--        <form action="/pharmacy/login" method="post">-->
<!---->
<!--            <label for="username">Username</label>-->
<!--            <input type="text" name="username" id="username" />-->
<!--            <label for="password">Password</label>-->
<!--            <input type="password" name="password" id="password" />-->
<!--            <input type="submit" value="Login" id="loginButton" />-->
<!--        </form>-->

    <div class="container">
        <div class="sign-in-component">
            <div class="sign-in-header">
                <h1>Sign In</h1>
                <h3>Pharmacy</h3>
            </div>
            <form action="/pharmacy/login" method="post">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" />
                <label for="password">Password</label>
                <input type="password" name="password" id="password" />
                <input type="submit" value="Login" id="loginButton" />
            </form>
            <div class="register-now">
                <p>Don't have an account? <a href="/pharmacy/register">Register Now</a></p>
            </div>
            <div class="forget-password">
                <p><a href="/pharmacy/forgotPassword">Forgot Password?</a></p>
            </div>
        </div>
        <div class="image">
            <img src="/res/4957412_Mobile-login-Cristina.jpg" alt="loginPageImage">
        </div>
    </div>

    </body>
</html>

<?php
//
//$app = new App();
//$app -> route('/login', function() use ($app) {
//    $app -> render('loginPage/loginPage.php');
//});
