<html lang="en">
    <head>
        <title>Employee Register - MedEx</title>
        <link rel="stylesheet" href="/css/registerPage/employee/employ_register.css">
    </head>

    <body>
        <h1>Create Account - Employee</h1>

            <form action="/employee/register" method="post">

            <label for="username">Username</label>
            <input type="text" name="username" id="username" />
            <label for="email">Email</label>
            <input type="text" name="email" id="email" />
            <label for="fname">First Name</label>
            <input type="text" name="fname" id="fname" />
            <label for="lname">Last Name</label>
            <input type="text" name="lname" id="lname" />
            <label for="age">Age</label>
            <input type="text" name="age" id="age" />
            <label for="password">Password</label>
            <input type="text" name="password" id="password" />
            <label for="nic">NIC No</label>
            <input type="text" name="nic" id="nic" />
            <label for="managerid">Manager Id</label>
            <input type="text" name="managerid" id="managerid" />


            <label for="retypepassword">Re-type password</label>
            <input type="text" name="retypepassword" id="retypepassword" />

            <label for="uploadnic">Upload NIC</label>
            <input type="file" name="uploadnic" id="uploadnic" accept="image/png,image/jpeg" />

            <input type="submit" value="Submit >" id="loginButton" />
            </form>
    </body>
</html>