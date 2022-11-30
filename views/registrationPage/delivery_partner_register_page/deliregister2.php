<html lang="en">
<head>
    <title>Login - MedEx</title>
    <link rel="stylesheet" href="/css/registerPage/delivery/deliregisterpage.css">
</head>

<body>
<h1>Create Account - Delivery Partner</h1>
<form action="/delivery/register2" method="post">

    <label for="address">Address</label>
    <input type="text" name="address" id="address" />
    <label for="deliveryLocations">Deliverable Cities</label>
    <input type="text" name="deliveryLocations" id="deliveryLocations" />
    <label for="contactnumber">Contact Number</label>
    <input type="text" name="contactnumber" id="contactnumber" />
    <label for="licenseId">Driving License Id</label>
    <input type="text" name="licenseId" id="licenseId" />
    <label for="drivingLicenseName">Driving License Name</label>
    <input type="text" name="drivingLicenseName" id="drivingLicenseName" />
    <label for="vehicleType">Vehicle Type</label>
    <input type="text" name="vehicleType" id="vehicleType" />
    <label for="vehicleNo">Vehicle Registration Number</label>
    <input type="text" name="vehicleNo" id="vehicleNo" />
    <label for="maxLoad">Max Load</label>
    <input type="text" name="maxLoad" id="maxLoad" />
    <label for="refrigeration">Refrigerators</label>
    <input type="checkbox" name="refrigeration" id="refrigeration" />
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