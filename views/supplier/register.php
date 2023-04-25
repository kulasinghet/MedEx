<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MedEx | Supplier Registration</title>

    <link href="../scss/vendor/demo.css" rel="stylesheet" />
    <link href="../css/supplier/formcss.css" rel="stylesheet" />
    <script src="../js/g28-style.js"></script>
    <!-- Font awesome kit -->
    <script src="https://kit.fontawesome.com/9b33f63a16.js" crossorigin="anonymous"></script>
</head>

<body style="background-color: #e4e8e5; width:100%; height: 100%;">
    <div style="padding:1%;">
        <div class="card g-col-2 g-row-2-start-3"
            style=" box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 20px;">
            <div class="card-body" style="display:flex; flex-direction: row;">
                <div style="width: 25%; padding: 1%; background-color: #B1D4E0; border-radius: 20px;">
                    <img src="/res/register-page.svg" alt="Registeration">
                </div>
                <div style="width: 75%; padding: 2%;">
                    <form action="/supplier/register" method="post" enctype="multipart/form-data"
                        style="display: flex; flex-direction: row; width: 100%;">
                        <div style="width: 50%; padding:2%">
                            <h4> Supplier Registration</h4>
                            <input type="text" name="name" class="form-input" placeholder="Enter Name" required><br>
                            <input type="text" name="username" class="form-input" placeholder="Enter Userame"
                                required><br>
                            <input type="password" name="pswd" class="form-input" placeholder="Enter Password"
                                required><br>
                            <input type="password" name="re-pswd" class="form-input" placeholder="Re-enter Password"
                                required><br>
                            <input type="text" name="email" class="form-input" placeholder="Enter Email" required><br>
                            <input type="text" name="address" class="form-input" placeholder="Enter Address"
                                required><br>
                            <input type="text" name="mobile" class="form-input" placeholder="Enter Mobile Phone Number"
                                required><br>

                        </div>
                        <div style="width: 50%; padding:2%">

                            <input type="text" name="supRegNum" class="form-input"
                                placeholder="Enter Supplier Registration Number" required><br>
                            <input type="text" name="busiRegNum" class="form-input"
                                placeholder="Enter Business Registration Number" required><br>
                            <input type="text" name="supCertId" class="form-input"
                                placeholder="Enter Supplier Certificate ID" required><br>
                            Business Registration Certificate <small>(3Mb - jpg,jpeg,png,pdf) </small><br><input
                                class="form-input" type="file" name="BusRegiCert" id="BusRegiCert" required
                                accept="image/*,.pdf"><br>
                            Supplier Registration Certificate <small>(3Mb - jpg,jpeg,png,pdf) </small><br><input
                                class="form-input" type="file" name="SuppRegiCert" id="SuppRegiCert" required
                                accept="image/*,.pdf"><br>
                            <input type="submit" value="Create Account" class="btn btn--primary">
                        </div>
                    </form>
                    <h6 style="padding:1%; text-align:center">Already have an account? <a href="/login">Log
                            in</a></h6>

                </div>

            </div>
        </div>
    </div>
</body>

</html>