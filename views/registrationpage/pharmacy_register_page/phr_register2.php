<html lang="en">
<head>
    <title>Pharmacy Register(2nd page) - MedEx</title>
    <link rel="stylesheet" href="phr_register2.css">
</head>

<body>
<h1>Create Account - Pharmacy</h1>
<!--<form action="../../controller/RegisterPage/registerController.php" method="post">-->

<label for="ownername">Owner Name</label>
<input type="text" name="ownername" id="ownername" />
<label for="address">Address</label>
<input type="text" name="address" id="address" />
<label for="city">City</label>
<input type="text" name="city" id="city" />
<label for="contactnumber">Contact Number</label>
<input type="text" name="contactnumber" id="contactnumber" />
<label for="pharmacy_register_no">Pharmacy Registration No.</label>
<input type="text" name="pharmacy_register_no" id="pharmacy_register_no" />
<label for="business_reg_id">Business Registration Id</label>
<input type="text" name="business_reg_id" id="business_reg_id" />
<label for="business_reg_name">Business Registered Name</label>
<input type="text" name="business_reg_name" id="business_reg_name" />
<label for="pharmacy_ceti_id">Pharmacy Certificate Id</label>
<input type="text" name="pharmacy_ceti_id" id="pharmacy_ceti_id" />
<label for="pharmacy_ceti_name">Pharmacy Certificate Name</label>
<input type="text" name="pharmacy_ceti_name" id="pharmacy_ceti_name" />



<label for="uploadbusinesscerti">Upload Business Registration Certificate</label>
<input type="file" name="uploadbusinesscerti" id="uploadbusinesscerti" accept="image/png,image/jpeg" />
<label for="uploadpharceti">Upload Pharmacy Certificate</label>
<input type="file" name="uploadpharceti" id="uploadpharceti" accept="image/png,image/jpeg" />



<input type="submit" value="Register" id="loginButton" />
</form>
</body>
</html>