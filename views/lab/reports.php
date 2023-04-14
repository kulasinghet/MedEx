<?php
use app\controllers\lab\LabDashboardController;
use app\models\LabModel;

?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Laboratory Dashboard</title>
    <link href="../scss/vendor/demo.css" rel="stylesheet" />
    <link href="../css/supplier/formcss.css" rel="stylesheet" />
    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
</head>

<body>

    <nav>
        <div class="nav-search">
            <form onsubmit="preventDefault();" role="search">
                <label for="search">Search for stuff</label>
                <input autofocus id="search" placeholder="Search..." required type="search" />
                <button type="submit">Go</button>
            </form>
        </div>
        <div class="nav-inner">
            <ul>
                <li><a href="login"><i class="fa fa-sign-out"></i></a></li>
            </ul>
            <a class="nav-profile" href="#">
                <div class="nav-profile-image">
                    <img alt="Profile image" src="../res/avatar-empty.png" />
                </div>
            </a>
        </div>
    </nav>

    <div class="sidebar">
        <div class="sidebar-inner">
            <nav class="sidebar-header">
                <div class="sidebar-logo">
                    <a href="/dashboard">
                        <img alt="MedEx logo" src="../res/logo/logo-text_light.svg" />
                    </a>
                </div>
            </nav>
            <div class="sidebar-context">
                <h6 class="sidebar-context-title">Menu</h6>
                <ul>
                    <li>
                        <a class="btn" href="/lab/requests"> <i class="fa fa-check"></i> Accept Lab Requests
                        </a>
                    </li>
                    <li>
                        <a class="btn disabled" href="/lab/reports"> <i class="fa fa-file-text-o"></i> Provide Lab
                            Reports </a>
                    </li>

                    <li>
                        <a class="btn" href="/lab/contact-us"> <i class="fa fa-phone"></i> Contact Us </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="canvas nav-cutoff sidebar-cutoff">
        <div class="canvas-inner">
            <div class="row">
                <div class="col" style="display: flex; flex-direction: row;">
                    <div class="card g-col-2 g-row-2-start-3"
                        style=" box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 20px; width:80%">
                        <div class="card-body">
                            <div style="padding: 2%;">
                                <h3>Generate Lab Report</h3>
                                <br>
                                <form>
                                    Lab Request Id:<br>
                                    <select name='manufacture' value='' class='input-box option' required>Lab Request
                                        <option>Req0001</option>
                                        <option>Req0001</option>
                                    </select>
                                    <br><br>
                                    Status:<br>
                                    <input type="radio" name="status" value='0'> Verify
                                    <input type="radio" name="status" value='1'> Unverify
                                    <br><br>
                                    Comment:<br>
                                    <textarea id="comment" name="comment" rows="10" cols="60">Enter Message
                                   </textarea>
                                    <br>
                                    <input type='submit' value='Submit' class='btn btn--primary'>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>