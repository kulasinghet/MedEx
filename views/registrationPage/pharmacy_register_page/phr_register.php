<html lang="en">
<head>
    <title>Pharmacy Register - MedEx</title>
<!--    <link rel="stylesheet" href="phr_register.css">-->
    <link rel="stylesheet" href="/css/registerPage/pharmacy/phr_register.css">
</head>

<body>
    <h1>Create Account - Pharmacy</h1>
        <form action="/pharmacy/register" method="post">

            <label for="id">User ID</label>
            <input type="text" name="id" id="id" />
            <label for="username">Username</label>
            <input type="text" name="username" id="username" />
            <label for="email">Email</label>
            <input type="text" name="email" id="email" />
            <label for="name">Pharmacy Name</label>
            <input type="text" name="name" id="name" />
            <label for="password">Password</label>
            <input type="text" name="password" id="password" />
            <label for="retypepassword">Re-type password</label>
            <input type="text" name="retypepassword" id="retypepassword" />
            <label for="ownerName">Owner Name</label>
            <input type="text" name="ownerName" id="ownerName" />
            <label for="address">Address</label>
            <input type="text" name="address" id="address" />
            <label for="city">City</label>
            <input type="text" name="city" id="city" />
            <label for="contactnumber">Contact Number</label>
            <input type="text" name="contactnumber" id="contactnumber" />


            <label for="pharmacyRegNo">Pharmacy Registration No.</label>
            <input type="text" name="pharmacyRegNo" id="pharmacyRegNo" />
            <label for="BusinessRegId">Business Registration Id</label>
            <input type="text" name="BusinessRegId" id="BusinessRegId" />
            <label for="BusinessRegCertName">Business Registered Name</label>
            <input type="text" name="BusinessRegCertName" id="BusinessRegCertName" />
            <label for="pharmacyCertId">Pharmacy Certificate Id</label>
            <input type="text" name="pharmacyCertId" id="pharmacyCertId" />
            <label for="pharmacyCertName">Pharmacy Certificate Name</label>
            <input type="text" name="pharmacyCertName" id="pharmacyCertName" />



            <label for="uploadbusinesscerti">Upload Business Registration Certificate</label>
            <input type="file" name="uploadbusinesscerti" id="uploadbusinesscerti" accept="image/png,image/jpeg" />
            <label for="uploadpharceti">Upload Pharmacy Certificate</label>
            <input type="file" name="uploadpharceti" id="uploadpharceti" accept="image/png,image/jpeg" />



            <input type="submit" value="Register" id="loginButton" />
        </form>
    </body>
</html>