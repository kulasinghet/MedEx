<html lang="en">
<head>
    <title>Login - MedEx</title>
    <link rel="stylesheet" href="deliregisterpage.css">
</head>


<body>
<h1>Create Account - Delivery Partner</h1>
<form action="../../controller/RegisterPage/registerController.php" method="post">

    <label for="username">Username</label>
    <input type="text" name="username" id="username" />
    <label for="firstname">FirstName</label>
    <input type="text" name="firstname" id="firstname" />
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname" />
    <label for="email">Email</label>
    <input type="text" name="email" id="email" />
    <label for="password">Password</label>

    <input type="text" name="password" id="password" />
    <label for="retypepassword">Re-type password</label>
    <input type="text" name="retypepassword" id="retypepassword" />

    <label for="address">Address</label>
    <input type="text" name="address" id="address" />
    <label for="deliverablecities">Deliverable Cities</label>
    <input type="text" name="deliverablecities" id="deliverablecities" />
    <label for="contactnumber">Contact Number</label>
    <input type="text" name="contactnumber" id="contactnumber" />
    <label for="drivinglicenseid">Driving License Id</label>
    <input type="text" name="drivinglicenseid" id="drivinglicenseid" />
    <label for="vehicletype">Vehicle Type</label>
    <input type="text" name="vehicletype" id="vehicletype" />
    <label for="vehicleregno">Vehicle Registration Number</label>
    <input type="text" name="vehicleregno" id="vehicleregno" />
    <label for="maxload">Max Load</label>
    <input type="text" name="maxload" id="maxload" />
    <label for="refrigerators">Refrigerators</label>
    <input type="checkbox" name="refrigerators" id="refrigerators" />
    <!--  <label for="regdate">Registration Date</label>
      <input type="date" name="regdate" id="regdate" />-->
    <label for="uploadvehiclelicense">Upload Vehicle License</label>
    <input type="file" name="uploadvehiclelicense" id="uploadvehiclelicense" accept="image/png,image/jpeg" />
    <label for="uploaddrivinglicense">Upload Driving License</label>
    <input type="file" name="uploaddrivinglicense" id="uploaddrivinglicense" accept="image/png,image/jpeg" />



    <input type="submit" value="Register" id="loginButton" />
</form>
</body>
</html>