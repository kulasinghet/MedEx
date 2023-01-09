<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Laboratory Register - MedEx</title>

    <link href="/scss/main.css" rel="stylesheet"/>
    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
</head>
<body class="register-window">
<div class="canvas canvas-fluid">
    <article>
        <div class="article-body">
            <h4 class="card-title">Create Account - Laboratory</h4>
            <form action="/lab/register" method="post">
                <div class="flex-row">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-input" id="username" name="username" type="text">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-input" id="email" name="email" type="email"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="laboratory_name">Laboratory Name</label>
                    <input class="form-input" id="laboratory_name" name="laboratory_name" type="text">
                </div>
                <div class="flex-row">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-input" id="password" name="password" type="password">
                    </div>
                    <div class="form-group">
                        <label for="retypepassword">Re-type password</label>
                        <input class="form-input" id="retypepassword" name="retypepassword" type="password"/>
                    </div>
                </div>
                <div class="flex-row">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input class="form-input" id="address" name="address" type="text"/>
                    </div>
                    <div class="form-group">
                        <label for="contactnumber">Contact Number</label>
                        <input class="form-input" id="contactnumber" name="contactnumber" type="text"/>
                    </div>
                </div>
                <div class="flex-row">
                    <div class="form-group">
                        <label for="business_registration_id">Business Registration Id</label>
                        <input class="form-input" id="business_registration_id" name="business_registration_id" type="text"/>
                    </div>
                    <div class="form-group">
                        <label for="BusinessRegCertName">Business Registration Certificate Name/label>
                        <input class="form-input" id="BusinessRegCertName" name="BusinessRegCertName" type="text"/>
                    </div>
                </div>
                <div class="flex-row">
                    <div class="form-group">
                        <label for="laboratory_certificate_id">Laboratory Certificate Id</label>
                        <input class="form-input" id="laboratory_certificate_id" name="laboratory_certificate_id" type="text"/>
                    </div>
                    <div class="form-group">
                        <label for="LabCertName">Laboratory Certificate Name</label>
                        <input class="form-input" id="LabCertName" name="LabCertName" type="text"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="uploadbusinesscerti">Upload Business Registration Certificate</label>
                    <input accept="image/png,image/jpeg" class="form-input" id="uploadbusinesscerti" name="uploadbusinesscerti" type="file"/>
                </div>
                <div class="form-group">
                    <label for="uploadlaboratoryceti">Upload Laboratory Certificate</label>
                    <input accept="image/png,image/jpeg" class="form-input" id="uploadlaboratoryceti" name="uploadlaboratoryceti" type="file"/>
                </div>

                <div class="button-group">
                    <button class="btn btn-primary" id="loginButton" type="submit" value="Login">Register</button>
                </div>
                <div class="form-group">
                    <p>Do you have an account? <a href="/lab/login">Login</a></p>
                </div>
            </form>
        </div>
    </article>
</div>
<footer>
    <div class="footer-inner">
        <section>
            <div class="footer-logo">
                <a href="#">
                    <img alt="MedEx Logo with name" src="/res/logo/logo-box_dark.svg"/>
                </a>
            </div>

            <div class="footer-links">
                <a class="link-1" href="#">Home</a>
                <a href="#">About</a>
                <a href="#">Contact</a>
            </div>
        </section>

        <section>
            <h6>Team Members</h6>
            <ul>
                <li>R.D.T.D. Kulasinghe</li>
                <li>I.A.P.P. Wijegunawardana</li>
                <li>W.D.D.N. Dharmathunga</li>
                <li>M.C.W. Samarasinghe</li>
            </ul>
        </section>

        <section>
            <p>© 2022 Group 28, All Right reserved</p>
        </section>
    </div>
</footer>
</body>
</html>