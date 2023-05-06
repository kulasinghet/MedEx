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
                <input type="password" name="password" id="password" required placeholder="Password"/>
                <input type="password" name="confirmPassword" id="confirmPassword" required placeholder="Re-type password"/>
                <input type="text" name="pharmacyname" id="name" required placeholder="Pharmacy Name"/>

                <!--                <input type="text" name="city" id="city" required placeholder="City"/>-->

            </div>
            <div class="side">
                <input type="text" name="address" id="address" required placeholder="Address"/>
                <select name="city">
                    <option value="" disabled selected>Select City</option>
                    <option value="Ampara">Ampara</option>
                    <option value="Anuradhapura">Anuradhapura</option>
                    <option value="Badulla">Badulla</option>
                    <option value="Batticaloa">Batticaloa</option>
                    <option value="Colombo">Colombo</option>
                    <option value="Galle">Galle</option>
                    <option value="Gampaha">Gampaha</option>
                    <option value="Hambantota">Hambantota</option>
                    <option value="Jaffna">Jaffna</option>
                    <option value="Kalutara">Kalutara</option>
                    <option value="Kandy">Kandy</option>
                    <option value="Kegalle">Kegalle</option>
                    <option value="Kilinochchi">Kilinochchi</option>
                    <option value="Kurunegala">Kurunegala</option>
                    <option value="Mannar">Mannar</option>
                    <option value="Matale">Matale</option>
                    <option value="Matara">Matara</option>
                    <option value="Monaragala">Monaragala</option>
                    <option value="Mullaitivu">Mullaitivu</option>
                    <option value="Nuwara Eliya">Nuwara Eliya</option>
                    <option value="Polonnaruwa">Polonnaruwa</option>
                    <option value="Puttalam">Puttalam</option>
                    <option value="Ratnapura">Ratnapura</option>
                    <option value="Trincomalee">Trincomalee</option>
                    <option value="Vavuniya">Vavuniya</option>
                </select>
                <input type="text" name="ownerName" id="ownerName" required placeholder="Owner Name"/>
                <input type="number" name="contactnumber" id="contactnumber" required placeholder="Contact Number"/>
                <input type="text" name="pharmacyRegNo" id="pharmacyRegNo" required
                       placeholder="Pharmacy Registration Number"/>

            </div>
            <div class="side">
                <input type="text" name="BusinessRegId" id="BusinessRegId" required
                       placeholder="Business Registration ID" />
                <input type="text" name="pharmacyCertId" id="pharmacyCertId" required
                       placeholder="Pharmacy Certificate ID" />
                <span>
                    <label for="uploadbusinesscerti">Upload Business Registration Certificate</label>
                    <div class="file-upload">
                        <input type="file" name="uploadbusinesscerti" id="uploadbusinesscerti"
                               accept="application/pdf" required onchange="handleFileUpload('0')"/>
                        <i class="fa fa-upload" aria-hidden="true"></i>
                    </div>
                </span>
                <span>
                    <label for="uploadpharceti">Upload Pharmacy Certificate</label>
                    <div class="file-upload">
<!--                        // accept="image/png,image/jpeg,application/pdf"-->
                        <input type="file" name="uploadpharceti" id="uploadpharceti" accept="application/pdf" required onchange="handleFileUpload('1')"/>
                        <i class="fa fa-upload" aria-hidden="true"></i>
                    </div>
                </span>
                <span>
                    <label for="uploadprofilepic">Choose a profile picture</label>
                    <div class="file-upload">
                        <input type="file" name="uploadprofilepic" id="uploadprofilepic" accept="image/png"
                               required onchange="handleFileUpload('2')"/>
                        <i class="fa fa-upload" aria-hidden="true"></i>
                    </div>
                </span>
            </div>
        </div>

        <input type="submit" value="Register" id="loginButton"/>
    </form>

    <div class="login-now">
        <p>Already have an account? <a href="/login">Login Now</a></p>
    </div>

    <script>
        function handleFileUpload(id) {
            // change the file-upload class to file-upload--selected
            // so that the user can see what they selected
            console.log("id: " + id);
            var fileUpload = document.getElementsByClassName('file-upload')[id];

            // check if the user has selected a file
            if (fileUpload.children[0].files.length > 0) {
                // check if the file-upload--selected class is already there
                if (fileUpload.className.includes("file-upload--selected")) {
                    // remove the file-upload--selected class
                    fileUpload.className = fileUpload.className.replace(" file-upload--selected", "");
                }
                fileUpload.className += " file-upload--selected";
            } else {
                // remove the file-upload--selected class
                fileUpload.className = fileUpload.className.replace(" file-upload--selected", "");
            }
        }
    </script>

</div>
</body>
</html>
