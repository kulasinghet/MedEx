<?php
////session_start();
////if(isset($_SESSION["user_username"])){
////    header("location:./dashboard.php");
////}
//
//
//?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delivery Partner -Login</title>
    <link rel="stylesheet" href="/css/delivery/loginpage.css">
</head>
<body>
<div class="container" id="container">

    <div class="form-container sign-in-container">
        <form method="post" action="/delivery/login">
            <img class="logo" src="/res/logo/logo.svg"><br>
            <h3>Delivery Partner -Sign in</h3>
            <span>Don't have an account? <a href="/delivery/register">sign up</a></span><br>

            <input type="text" id="username" name="username" placeholder="username" />

            <input type="password" id="password" name="password" placeholder="Password" />
            <div class="radio">
            <input type="checkbox" name="rememberme" id="rememberme" />

            <label>Remember me</label>
            </div>
            <a href="#">Forgot password?</a>

            <button type="submit" name="login-btn">Log In</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">

                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
            <img class="del" src="/res/delivery.png">
            </div>
        </div>
    </div>
</div>
</body>
</html>


