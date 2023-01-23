<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>MedEx | Supplier Registration</title>

    <link rel="stylesheet" href="../scss2/vendor/demo.css"/>
    <script src="../js/g28-style.js"></script>
    <!-- Font awesome kit -->
    <script src="https://kit.fontawesome.com/9b33f63a16.js" crossorigin="anonymous"></script>
</head>
<body style="background-color: #B1D4E0;">
<div style="padding-top: 5%; padding-left: 5%; padding-right: 5%;">
<div class="card g-col-2 g-row-2-start-3">
            <div class="card-body">
            <h4 class="card-title">Supplier Registration Form</h4>
            <div>
            <div style="width:50%; float: left; padding-left: 5%; padding-right: 5%;">
                <form action="" method="post">
            <input type="text" name="name" class="input-box" placeholder="Enter Name" required><br>
     <input type="text" name="username" class="input-box" placeholder="Enter Userame" required><br>
    <input type="password" name="pswd" class="input-box" placeholder="Enter Password" required><br>
   <input type="text" name="email" class="input-box"  placeholder="Enter Email" required><br>
      <input type="text" name="address" class="input-box" placeholder="Enter Address" required><br>
     <input type="text" name="mobile" class="input-box"placeholder="Enter Mobile Phone Number" required><br>
</div>
                <div style="width:50%; float: right; padding-right: 5%; padding-left: 5%;">
        <input type="text" name="supRegNum" class="input-box" placeholder="Enter Supplier Registration Number" required><br>
        <input type="text" name="busiRegNum" class="input-box" placeholder="Enter Business Registration Number" required><br>
       <input type="text" name="supCertId" class="input-box"  placeholder="Enter Supplier Certificate ID" required><br>
        Business Registration Certificate <small>(3Mb - jpg,jpeg,png,pdf) </small><br><input type="file" name="BusRegiCert" id="BusRegiCert" required accept="image/*,.pdf"><br><br>
        Supplier Registration Certificate <small>(3Mb - jpg,jpeg,png,pdf) </small><br><input type="file" name="SuppRegiCert" id ="SuppRegiCert" required accept="image/*,.pdf"><br>
      <br><input type="submit" value="Create Account" class="btn btn--primary">
</div>
</form>
            </div>
            </div>
        </div>
</div>
    
    </body>
</html>