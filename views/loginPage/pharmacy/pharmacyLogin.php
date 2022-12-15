<html lang="en">
    <head>
        <title>Login - Pharmacy - MedEx</title>
        <link rel="stylesheet" href="/css/pharmacy/loginPage.css">
        <script src="/js/pharmacy/login-error.js" defer></script>
    </head>

    <body>

    <div class="container">
        <div class="sign-in-component">
            <h1>SIGN IN</h1>
            <h2>Pharmacy</h2>

            <form action="/pharmacy/login" method="post">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" />
                <label for="password">Password</label>
                <input type="password" name="password" id="password" />
                <input type="submit" value="Login" id="loginButton" />
            </form>

            <div class="register-now">
                <p>Don't have an account? <a href="/pharmacy/register">Register Now</a></p>
                <p><a href="/pharmacy/forgotPassword">Forgot Password?</a></p>
            </div>
        </div>
        <div class="image">
            <img src="/res/login-illustration.svg" alt="loginPageImage">
        </div>
    </div>


    </body>
</html>