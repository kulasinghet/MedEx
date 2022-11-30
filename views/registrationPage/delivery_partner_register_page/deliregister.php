<html lang="en">
<head>
    <title>Login - MedEx</title>
    <link rel="stylesheet" href="/css/registerPage/delivery/deliregisterpage.css">
</head>


<body>
<h1>Create Account - Delivery Partner</h1>
<form action="/delivery/register" method="post">

    <label for="id">User ID</label>
    <input type="text" name="id" id="id" />
    <label for="username">Username</label>
    <input type="text" name="username" id="username" />
    <label for="name">Name</label>
    <input type="text" name="name" id="name" />
    <label for="email">Email</label>
    <input type="text" name="email" id="email" />
    <label for="password">Password</label>
    <input type="text" name="password" id="password" />
    <label for="retypepassword">Re-type password</label>
    <input type="text" name="retypepassword" id="retypepassword" />

    <input type="submit" value="Next" id="loginButton" />
</form>
</body>
</html>