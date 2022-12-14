<html lang="en">
<head>
    <title>Pharmacy Register - MedEx</title>
    <!--    <link rel="stylesheet" href="phr_register.css">-->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="/css/registerPage/pharmacy/phr_register.css">
    <script src="/js/pharmacy/login-error.js" defer></script>
</head>

<body>

<div class="container">

    <h1>Create Account</h1>
    <h2>Pharmacy</h2>
    <form action="/pharmacy/register" method="post" enctype="multipart/form-data">
    <div class="form-container">

            <div class="left-side">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required/>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" required/>
                <label for="password">Password</label>
                <input type="text" name="password" id="password" required/>
                <label for="retypepassword">Re-type password</label>
                <input type="text" name="retypepassword" id="retypepassword" required/>
                <label for="name">Pharmacy Name</label>
                <input type="text" name="name" id="name" required/>

                <label for="ownerName">Owner Name</label>
                <input type="text" name="ownerName" id="ownerName" required/>
                <label for="address">Address</label>
                <input type="text" name="address" id="address" required/>
                <label for="city">City</label>
                <input type="text" name="city" id="city" required/>

            </div>
            <div class="right-side">



            <label for="contactnumber">Contact Number</label>
            <input type="text" name="contactnumber" id="contactnumber" required/>


            <label for="pharmacyRegNo">Pharmacy Registration No.</label>
            <input type="text" name="pharmacyRegNo" id="pharmacyRegNo" required/>
            <label for="BusinessRegId">Business Registration Id</label>
            <input type="text" name="BusinessRegId" id="BusinessRegId" required/>
            <label for="BusinessRegCertName">Business Registered Name</label>
            <input type="text" name="BusinessRegCertName" id="BusinessRegCertName" required/>
            <label for="pharmacyCertId">Pharmacy Certificate Id</label>
            <input type="text" name="pharmacyCertId" id="pharmacyCertId" required/>
            <label for="pharmacyCertName">Pharmacy Certificate Name</label>
            <input type="text" name="pharmacyCertName" id="pharmacyCertName" required/>

<!---->
<!---->
<!--            <label for="uploadbusinesscerti">Upload Business Registration Certificate</label>-->
<!--            <input type="file" name="uploadbusinesscerti" id="uploadbusinesscerti" accept="image/png,image/jpeg" />-->
<!--            <label for="uploadpharceti">Upload Pharmacy Certificate</label>-->
<!--            <input type="file" name="uploadpharceti" id="uploadpharceti" accept="image/png,image/jpeg" />-->
                <span>
                    <label for="uploadbusinesscerti">Upload Business Registration Certificate</label>
                    <div class="file-upload">
                        <input type="file" name="uploadbusinesscerti" id="uploadbusinesscerti" accept="image/png,image/jpeg" required/>
                        <i class="fa fa-arrow-up" ></i>
                    </div>
                </span>
                <span>
                    <label for="uploadpharceti">Upload Pharmacy Certificate</label>
                    <div class="file-upload">
                        <input type="file" name="uploadpharceti" id="uploadpharceti" accept="image/png,image/jpeg" required/>
                        <i class="fa fa-arrow-up"></i>
                    </div>
                </span>
            </div>
    </div>

            <input type="submit" value="Register" id="loginButton" />
        </form>

    <div class="login-now">
        <p>Already have an account? <a href="/pharmacy/login">Login Now</a></p>
    </div>

</div>
    </body>
</html>