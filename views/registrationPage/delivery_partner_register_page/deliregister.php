<html lang="en">
<head>
    <title>DeliveryPartner-Register - MedEx</title>
    <link rel="stylesheet" href="deliregisterpage.css">
</head>
<body>
<div class="container">

    <img class="logo" src="logo.png">

        <h1>  Delivery Partner Registration</h1>
        <form action="#">
            <div class="middle">
<!--           <div class="user__details">-->
<div class="details personal">
    <span class="title">Personal Details</span>
    <div class="field">
 <div class="input_field">
                  <label>Username</label>
                    <input type="text" placeholder="johnWC98" id="username" required>
                   </div>
                      <div class="input_field">
                    <label>First Name</label>
                    <input type="text" placeholder="E.g: John" id="firstname" required>
</div>
<div class="input_field">
                    <label>Last Name</label>
                    <input type="text" placeholder="E.g: Smith" id="lastname" required>
</div>

<div class="input_field">
                    <label>Email</label>
                   <input type="email" id="email" placeholder="johnsmith@hotmail.com" required>

</div>
        <div class="input_field">
                    <label>Contact Number</label>
                    <input type="tel" pattern="[0-9]{3}-[0-9]{7}" placeholder="E.g: 071-2345678" id="contactnumber" required>
</div>
<div class="input_field">
                    <label>Password</label>
                    <input type="password" id="password" placeholder="********" required>
            </div>
            <div class="input_field">
                    <label>Confirm Password</label>

                    <input type="password" id="retypepassword" placeholder="********" required>
            </div>
            <div class="input_field">
                    <label>Address</label>

                    <input type="address" id="address" placeholder="No.12,colombo road, nugegoda" required>
        </div>
        <div class="input_field">
                    <label>Deliverable Cities</label>
                    <input type="deliverablecities" id="deliverablecities" placeholder="colombo,kandy,pilimathalawa,mawanalle" required>
        </div>
        <div class="input_field">
                    <label>Driving License ID</label>
                    <input type="drivinglicenseid" id="drivinglicenseid" placeholder="*************" required>
            </div>
        <div class="details vehicle">
            <span class="title">Vehicle Details</span>
            <div class="field">

    <div class="input_field">
                    <label>Vehicle Type</label>
                    <input type="vehicletype" id="vehicletype" placeholder="Demo Batta" required>
    </div>

    <div class="input_field">
                    <label>Vehicle Register Number</label>
                    <input type="vehicleregno" pattern="[a-zA-Z]{2,3}-[0-9a-zA-Z]{2,3}-[0-9]{4}" id="vehicleregno" placeholder="************" required>
            </div>
    <div class="input_field">
                    <label>Max Load</label>

                    <input type="maxload" id="maxload" placeholder="40Kg" required>
    </div>
<div class="input_field">
                    <label>Refrigerators</label>

                    <input type="checkbox" id="refrigerators" name="refrigerators" required>
            </div>
    <div class="input_field">
                    <label>Upload Vehicle License</label>
                    <input type="file" id="uploadvehiclelicense" name="uploadvehiclelicense" required>
    </div>
    <div class="input_field">
                    <label>Upload Driving License</label>
                    <input type="file" id="uploaddrivinglicense" name="uploaddrivinglicense" required>
            </div>

            </div>
</div>
</div>
</div>
            </div>

    <div class="btn-reg">

            <button type="submit" class="btn" name="reg-btn" id="reg-btn">Register</button>
    <a href="../loginpage/loginpage.php" >already registered?</a>
    </div>


        </div>
            </div>
        </form>

</div>
</body>
</html>