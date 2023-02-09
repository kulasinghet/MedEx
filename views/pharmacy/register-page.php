<html lang="en">
<head>
    <title>Pharmacy Register - MedEx</title>
<!--        <link rel="stylesheet" href="/css/registerPage/pharmacy/phr_register.css">-->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="/css/pharmacy/register-page.css">
    <link href="../scss/vendor/demo.css" rel="stylesheet"/>
    <script src="/js/pharmacy/login-error.js" defer></script>
</head>

<body>

<div class="container">

    <h1>Create Pharmacy Account</h1>
    <form action="/pharmacy/register" method="post" enctype="multipart/form-data">
    <div class="form-container">

        <div class="side">
            <input type="text" name="username" id="username" required placeholder="Username"/>
            <input type="text" name="email" id="email" required placeholder="Email"/>
            <input type="text" name="password" id="password" required placeholder="Password"/>
            <input type="text" name="confirmPassword" id="confirmPassword" required placeholder="Re-type password"/>



        </div>
            <div class="side">
                <input type="text" name="name" id="name" required placeholder="Pharmacy Name"/>
                <input type="text" name="address" id="address" required placeholder="Address"/>
                <input type="text" name="city" id="city" required placeholder="City"/>
                <input type="text" name="ownerName" id="ownerName" required placeholder="Owner Name"/>
                <input type="text" name="contactnumber" id="contactnumber" required placeholder="Contact Number"/>
            </div>
            <div class="side">


            <input type="text" name="pharmacyRegNo" id="pharmacyRegNo" required placeholder="Pharmacy Registration Number"/>

            <input type="text" name="BusinessRegId" id="BusinessRegId" required placeholder="Business Registration ID"

            <input type="text" name="BusinessRegCertName" id="BusinessRegCertName" required placeholder="Business Registration Certificate Name"

            <input type="text" name="pharmacyCertId" id="pharmacyCertId" required placeholder="Pharmacy Certificate ID"

            <input type="text" name="pharmacyCertName" id="pharmacyCertName" required placeholder="Pharmacy Certificate Name"

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
                <span>
                    <label for="uploadpharceti">Choose a profile picture</label>
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
