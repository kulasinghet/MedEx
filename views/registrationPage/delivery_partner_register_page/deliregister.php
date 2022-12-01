<html lang="en">
<head>
    <title>Login - MedEx</title>
    <link rel="stylesheet" href="/css/registerPage/delivery/deliregisterpage.css">
</head>


<body>
<h1>Create Account - Delivery Partner</h1>
<form action="/delivery/register" method="post">

    <div class="form">
        <div class="left-side-form">
            <div>
                <label for="id">User ID</label>
                <input type="text" name="id" id="id" />
            </div>

            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" />
            </div>

            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" />
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" />
            </div>

            <div>
                <label for="password">Password</label>
                <input type="text" name="password" id="password" />
            </div>

            <div>
                <label for="retypepassword">Re-type password</label>
                <input type="text" name="retypepassword" id="retypepassword" />
            </div>
        </div>

        <div class="right-side-form">

            <div>
                <label for="address">Address</label>
                <input type="text" name="address" id="address" />
            </div>

            <div>
                <label for="deliverablecities">Deliverable Cities</label>
                <input type="text" name="deliverablecities" id="deliverablecities" />
            </div>

            <div>
                <label for="contactnumber">Contact Number</label>
                <input type="text" name="contactnumber" id="contactnumber" />
            </div>

            <div>
                <label for="drivinglicenseid">Driving License Id</label>
                <input type="text" name="drivinglicenseid" id="drivinglicenseid" />
            </div>

            <div>
                <label for="vehicletype">Vehicle Type</label>
                <input type="text" name="vehicletype" id="vehicletype" />
            </div>

            <div>
                <label for="vehicleregno">Vehicle Registration Number</label>
                <input type="text" name="vehicleregno" id="vehicleregno" />
            </div>

            <div>
                <label for="maxload">Max Load</label>
                <input type="text" name="maxload" id="maxload" />
            </div>

            <div>
                <label for="refrigerators">Refrigerators</label>
                <input type="checkbox" name="refrigerators" id="refrigerators" />
            </div>

            <div>
                <label for="uploadvehiclelicense">Upload Vehicle License</label>
                <input type="file" name="uploadvehiclelicense" id="uploadvehiclelicense" accept="image/png,image/jpeg" />
            </div>

            <div>
                <label for="uploaddrivinglicense">Upload Driving License</label>
                <input type="file" name="uploaddrivinglicense" id="uploaddrivinglicense" accept="image/png,image/jpeg" />
            </div>


        </div>


    <input type="submit" value="Register" id="regButton" />
    </div>
</form>

</body>
</html>