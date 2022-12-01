<html lang="en">
<head>
    <title>Laboratory Register - MedEx</title>
    <link rel="stylesheet" href="/css/registerPage/lab/register.css">
</head>

<body>
<h1>Create Account - Laboratory</h1>
<form action="/lab/register" method="post">

    <label for="id">User ID</label>
    <input type="text" name="id" id="id" />
<label for="username">Username</label>
<input type="text" name="username" id="username" />
<label for="email">Email</label>
<input type="text" name="email" id="email" />
<label for="laboratory_name">Laboratory Name</label>
<input type="text" name="laboratory_name" id="laboratory_name" />
<label for="password">Password</label>
<input type="text" name="password" id="password" />
<label for="retypepassword">Re-type password</label>
<input type="text" name="retypepassword" id="retypepassword" />
<label for="address">Address</label>

<input type="text" name="address" id="address" />
<label for="contactnumber">Contact Number</label>
<input type="text" name="contactnumber" id="contactnumber" />

<label for="business_registration_id">Business Registration Id</label>
<input type="text" name="business_registration_id" id="business_registration_id" />
<label for="BusinessRegCertName">Business Registered Name</label>
<input type="text" name="BusinessRegCertName" id="BusinessRegCertName" />
<label for="laboratory_certificate_id">Laboratory Certificate Id</label>
<input type="text" name="laboratory_certificate_id" id="laboratory_certificate_id" />
    <label for="LabCertName">Laboratory Certificate Name</label>
    <input type="text" name="LabCertName" id="LabCertName" />


<label for="uploadbusinesscerti">Upload Business Registration Certificate</label>
<input type="file" name="uploadbusinesscerti" id="uploadbusinesscerti" accept="image/png,image/jpeg" />
<label for="uploadlaboratoryceti">Upload Laboratory Certificate</label>
<input type="file" name="uploadlaboratoryceti" id="uploadlaboratoryceti" accept="image/png,image/jpeg" />



<input type="submit" value="Register" id="loginButton" />
</form>
</body>
</html>