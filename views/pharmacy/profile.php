<?php

use app\views\pharmacy\Components;

$components = new Components();
echo $components->viewHeader("Actor");
echo $components->navBar($_SESSION['username']);
echo $components->sideBar('dashboard');

$verifiedClass = $user['verified'] == 0 ? 'not-verified' : 'verified';

?>

<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col verified">
                        <h2 class="<?php echo $verifiedClass ?>">Username</h2>
                        <h3 id="username-formdb"><?php echo $user['username'] ?></h3>
                        <h2 class="<?php echo $verifiedClass ?>">Name</h2>
                        <h3><?php echo $user['name'] ?></h3>
                        <h2 class="<?php echo $verifiedClass ?>">Owner Name</h2>
                        <h3><?php echo $user['ownerName'] ?></h3>
                        <h2 class="<?php echo $verifiedClass ?>">Address</h2>
                        <h3><?php echo $user['address'] ?></h3>
                        <h2 class="<?php echo $verifiedClass ?>">City</h2>
                        <h3><?php echo $user['city'] ?></h3>
                        <h2 class="<?php echo $verifiedClass ?>">Email Address</h2>
                        <h3><?php echo $user['email'] ?></h3>
                        <h2 class="<?php echo $verifiedClass ?>">Mobile Number</h2>
                        <h3><?php echo $user['mobile'] ?></h3>
                        <h2 class="<?php echo $verifiedClass ?>">Delivery Time</h2>
                        <h3><?php echo $user['deliveryTime'] ?> Days</h3>
                    </div>
                    <div class="col">
                        <h2 class="<?php echo $verifiedClass ?>">Pharmacy Registration ID</h2>
                        <h3><?php echo $user['pharmacyRegNo'] ?></h3>
                        <h2 class="<?php echo $verifiedClass ?>">Business Registration ID</h2>
                        <h3><?php echo $user['BusinessRegId'] ?></h3>
                        <h2 class="<?php echo $verifiedClass ?>">Pharmacy Certificate ID</h2>
                        <h3><?php echo $user['pharmacyCertId'] ?></h3>
                        <!--                <h2>Verified: --><?php //echo $user['verified'] ?><!--</h2>-->
                        <?php if ($user['verified'] == 0) { ?>
                            <h2 class="not-verified">Not Verified</h2>
                        <?php } else { ?>
                            <h2 class="verified">Verified</h2>
                        <?php } ?>
                        <h2 class="<?php echo $verifiedClass ?>">Registration Date</h2>
                        <h3><?php echo $user['reg_date'] ?></h3>
                    </div>
                </div>
            </div>
            <div class="col"
                 style="display: flex; flex-direction: column; justify-content: center; align-items: center; margin-top: 50px">
                <img src="/uploads/profilePicture/<?php echo $user['username'] ?>_profilePicture.png"
                     alt="profilePicture" id="profilePicture">
                <img src="/qr/personal/<?php echo $user['username'] ?>_qr.png" alt="qrCode" id="qrCode">
            </div>
        </div>


        <div id='order-new-medicine' style='position: fixed; bottom: 0; right: 0; margin: 1rem;'>
            <a class='btn' onclick='forgetPasssword()'> <i class='fas fa-key'></i> Change Password </a>
        </div>
    </div>
</div>
</body>


<script>
    function forgetPasssword() {
        function validatePassword(newPassword) {
            let password = newPassword;
            let passwordLength = password.length;
            let passwordFormat = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/;

            if (passwordLength === 0) {
                swal('Please enter a password', '', 'error');
            } else if (passwordLength < 8) {
                swal('Password must contain at least 8 characters', '', 'error');
            } else if (!password.match(passwordFormat)) {
                swal('Password must contain at least one uppercase letter, one lowercase letter, one number and one special character', '', 'error');
            }
        }

        function validateOtp(otp) {
            let otpLength = otp.length;
            if (otpLength === 0) {
                swal('Please enter the OTP', '', 'error');
            } else if (otpLength !== 6) {
                swal('OTP must contain 6 digits', '', 'error');
            } else if (isNaN(otp)) {
                swal('OTP must contain only numbers', '', 'error');
            }

        }

        // add loader

        swal({
            title: 'Loading',
            text: 'Please wait...',
            buttons: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
        });

        let username2 = document.getElementById('username-formdb').innerText;
        localStorage.setItem('username-otp', username2);
        // load swal with username input
                let username = localStorage.getItem('username-otp');
        fetch(`/forgotPassword?username=${username}`)
            .then(results => {
                console.log(results);
                return results.json();
            })
            .then(json => {
                if (json.status === 'error') {
                    return swal('Something went wrong', json.message, 'error');
                } else if (json.status === 'success') {
// enter otp and new password
                    let username = json.username;
                    html = '<div class="swal2-content" style="display: flex; flex-direction: column">' +
                        '<p style="margin-bottom: 10px">If you have an account, OTP has been sent to your email</p>' +
                        '<input id="otp" class="swal2-input" placeholder="Enter OTP" name="otp">' +
                        '<input id="new-password" type="password" class="swal2-input" placeholder="Enter new password" name="newPassword">' + '</div>';
                    swal({
                        title: 'Enter OTP and new password',
                        content: {
                            element: 'div',
                            attributes: {
                                innerHTML: html
                            }
                        },
                        buttons: {
                            cancel: true,
                            confirm: true,
                        },
                    }).then((result) => {
                        console.log(result);
                        if (result) {
                            let otp = document.getElementById('otp').value;
                            let newPassword = document.getElementById('new-password').value;
                            let usernameotp = localStorage.getItem('username-otp');
                            localStorage.removeItem('username-otp');

                            validateOtp(otp);
                            validatePassword(newPassword);

                            fetch('/forgotPassword', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    username: usernameotp,
                                    otp: otp,
                                    newPassword: newPassword
                                })
                            }).then(results => {
                                return results.json();
                            }).then(json => {
                                if (json.status === 'error') {
                                    return swal('Something went wrong', json.message, 'error');
                                } else if (json.status === 'success') {
                                    return swal('Password changed successfully', '', 'success');
                                }
                            }).catch(err => {
                                if (err) {
                                    console.log(err);
                                    swal("Oh noes!", "The AJAX request failed!", "error");
                                } else {
                                    swal.stopLoading();
                                    swal.close();
                                }
                            });
                        }
                    });
                }
            }).catch(err => {
            if (err) {
                console.log(err);
                swal("Oh noes!", "The AJAX request failed!", "error");
            } else {
                swal.stopLoading();
                swal.close();
            }
        });
    }
</script>

</html>
