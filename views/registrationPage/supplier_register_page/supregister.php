<html lang="en">
<head>
    <title>Supplier Register - MedEx</title>
    <link rel="stylesheet" href="/css/registerPage/supplier/supregister.css">
</head>

<body>
<h1>Create Account - Supplier</h1>
<form action="/supplier/register" method="post">

    <label for="id">User ID</label>
    <input type="text" name="id" id="id"/>
    <label for="username">Username</label>
    <input type="text" name="username" id="username"/>
    <label for="email">Email</label>
    <input type="text" name="email" id="email"/>
    <label for="name">Supplier Name</label>
    <input type="text" name="name" id="name"/>
    <label for="password">Password</label>
    <input type="text" name="password" id="password"/>
    <label for="retypepassword">Re-type password</label>
    <input type="text" name="retypepassword" id="retypepassword"/>


    <label for="supplierRegNo">Supplier Registration No</label>
    <input type="text" name="supplierRegNo" id="supplierRegNo"/>
    <label for="address">Address</label>

    <input type="text" name="address" id="address"/>

    <label for="contactnumber">Contact Number</label>
    <input type="text" name="contactnumber" id="contactnumber"/>
    <label for="BusinessRegId">Business Registration Id</label>
    <input type="text" name="BusinessRegId" id="BusinessRegId"/>
    <label for="BusinessRegCertName">Business Registered Name</label>
    <input type="text" name="BusinessRegCertName" id="BusinessRegCertName"/>
    <label for="supplierCertId">Supplier Certificate Id</label>
    <input type="text" name="supplierCertId" id="supplierCertId"/>
    <label for="supplierCertName">Supplier Certificate Name</label>
    <input type="text" name="supplierCertName" id="supplierCertName"/>

    <label for="uploadvehiclelicense">Upload Business Registration Certificate</label>
    <input type="file" name="uploadvehiclelicense" id="uploadvehiclelicense" accept="image/png,image/jpeg"/>
    <label for="uploaddrivinglicense">Upload Supplier Certificate</label>
    <input type="file" name="uploaddrivinglicense" id="uploaddrivinglicense" accept="image/png,image/jpeg"/>


    <input type="submit" value="Register" id="loginButton"/>

</form>
</body>
</html>