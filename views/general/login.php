<html lang="en">
<head>
    <title>Login | MedEx</title>
    <!--        <link href="../scss2/vendor/demo.css" rel="stylesheet"/>-->
    <link rel="stylesheet" href="/css/loginPage.css">
    <link href='/css/error-model.css' rel='stylesheet'>
    <link href="/css/dashboard.css" rel="stylesheet">
    <link href="/css/model.css" rel="stylesheet">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!--        <link href='/css/error-model' rel='stylesheet'>-->
</head>

<body>

<div class="container">

    <div class="image">
        <img src="/res/logo/logo.svg" alt="loginPageImage">
        <p id="tagline">Efficiently Managing Medicines for Pharmacies</p>
    </div>

    <div class="sign-in-component">

        <form action="/login" method="post">
            <input type="text" name="username" id="username" placeholder="Username"/>
            <input type="password" name="password" id="password" placeholder="Password"/>

            <input type="submit" value="Log in" id="loginButton"/>

            <div class="register-now">
                <p><a onclick="forgetPasssword()">Forgot Password?</a></p>
            </div>

        </form>

        <hr>

        <div class="register-now">
            <!--            <button id="registerButton" data-modal-target="modal5">Register</button>-->
            <button id="registerButton">
                <a id="registerButtona" onclick="openModal()">Register</a>
            </button>


            <!--            // todo: add a model for register button-->
        </div>
    </div>

</div>


<script>
    function openModal() {
        swal({
            title: "Please choose your account type",
            text: "",
            icon: "info",
            buttons: {
                pharmacy: {
                    text: "Pharmacy",
                    value: "pharmacy",
                },
                manufacturer: {
                    text: "Supplier",
                    value: "supplier",
                },
                distributor: {
                    text: "Delivery Partner",
                    value: "delivery",
                },
                lab: {
                    text: "Lab",
                    value: "lab",
                },
                admin: {
                    text: "Admin",
                    value: "admin",
                },
            },
        })
            .then((value) => {
                    switch (value) {
                        case "pharmacy":
                            // get the base url and redirect to the pharmacy register page
                            window.location.href = '/pharmacy/register';
                            break;
                        case "supplier":
                            window.location.href = '/manufacturer/register';
                            break;
                        case "delivery":
                            window.location.href = '/distributor/register';
                            break;
                        case "lab":
                            window.location.href = '/lab/register';
                            break;
                        case "admin":
                            window.location.href = '/admin/register';
                            break;
                    }
                }
            );
    }

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

        // if the user forgets the password, he/she can click on the forget password and open a model
        swal({
            title: "Please enter your username",
            text: "",
            content: "input",
            button: {
                text: "Submit",
                closeModal: false,
            },
        })
            .then(name => {
                if (!name) throw null;
                let username = name;
                localStorage.setItem('username-otp', username);
                return fetch(`/forgotPassword?username=${username}`);
            })
            .then(results => {
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
                            })
                        }
                    })
                }
            })
            .catch(err => {
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


</body>
</html>
