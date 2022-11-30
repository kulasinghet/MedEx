<html lang="en">
<head>
    <title>Supplier Register - MedEx</title>
    <link rel="stylesheet" href="supregister.css">
</head>

<body>
<h1>Create Account - Supplier</h1>
<!--<form action="../../controller/RegisterPage/registerController.php" method="post">-->

<label for="username">Username</label>
<input type="text" name="username" id="username" />
<label for="email">Email</label>
<input type="text" name="email" id="email" />
<label for="suppliername">Supplier Name</label>
<input type="text" name="supliername" id="suppliername" />
<label for="password">Password</label>
<input type="text" name="password" id="password" />
<label for="retypepassword">Re-type password</label>
<input type="text" name="retypepassword" id="retypepassword" />


<label for="supplier_register_no">Supplier Registration No</label>
<input type="text" name="supplier_register_no" id="supplier_register_no" />
<label for="address">Address</label>
<input type="text" name="address" id="address" />
<label for="contactnumber">Contact Number</label>
<input type="text" name="contactnumber" id="contactnumber" />
<label for="business_reg_id">Business Registration Id</label>
<input type="text" name="business_reg_id" id="business_reg_id" />
<label for="business_reg_name">Business Registered Name</label>
<input type="text" name="business_reg_name" id="business_reg_name" />
<label for="supplier_ceti_id">Supplier Certificate Id</label>
<input type="text" name="spplier_ceti_id" id="supplier_ceti_id" />
<label for="supplier_certi_name">Supplier Certificate Name</label>
<input type="text" name="spplier_certi_name" id="supplier_certi_name" />

<label for="uploadvehiclelicense">Upload Business Registration Certificate</label>
<input type="file" name="uploadvehiclelicense" id="uploadvehiclelicense" accept="image/png,image/jpeg" />
<label for="uploaddrivinglicense">Upload Supplier Certificate</label>
<input type="file" name="uploaddrivinglicense" id="uploaddrivinglicense" accept="image/png,image/jpeg" />



<input type="submit" value="Register" id="loginButton" />

</form>
</body>
</html>