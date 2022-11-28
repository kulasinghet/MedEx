<html lang="en">
<head>
    <title>Supplier Register(2nd page) - MedEx</title>
    <link rel="stylesheet" href="register2.css">
</head>

<body>
<h1>Create Account - Laboratory</h1>
<!--<form action="../../controller/RegisterPage/registerController.php" method="post">-->


<label for="address">Address</label>
<input type="text" name="address" id="address" />
<label for="contactnumber">Contact Number</label>
<input type="text" name="contactnumber" id="contactnumber" />
<label for="business_reg_id">Business Registration Id</label>
<input type="text" name="business_reg_id" id="business_reg_id" />
<label for="business_reg_name">Business Registered Name</label>
<input type="text" name="business_reg_name" id="business_reg_name" />
<label for="laboratory_ceti_id">Laboratory Certificate Id</label>
<input type="text" name="laboratory_ceti_id" id="laboratory_ceti_id" />


<label for="uploadbusinesscerti">Upload Business Registration Certificate</label>
<input type="file" name="uploadbusinesscerti" id="uploadbusinesscerti" accept="image/png,image/jpeg" />
<label for="uploadlaboratoryceti">Upload Laboratory Certificate</label>
<input type="file" name="uploadlaboratoryceti" id="uploadlaboratoryceti" accept="image/png,image/jpeg" />



<input type="submit" value="Register" id="loginButton" />
</form>
</body>
</html>