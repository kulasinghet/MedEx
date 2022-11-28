<html lang="en">
    <head>
        <title>Login - MedEx</title>
        <link rel="stylesheet" href="/css/loginPage/loginPage.css">
    </head>

    <body>
        <h1>Login</h1>
        <form action="/employee/login" method="post">

            <label for="username">Username</label>
            <input type="text" name="username" id="username" />
            <label for="password">Password</label>
            <input type="password" name="password" id="password" />
            <input type="submit" value="Login" id="loginButton" />
        </form>
    </body>
</html>

<?php
//
//$app = new App();
//$app -> route('/login', function() use ($app) {
//    $app -> render('loginPage/loginPage.php');
//});
