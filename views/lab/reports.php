<?php
use app\controllers\lab\LabDashboardController;
use app\models\LabModel;
use app\models\LabReportModel;

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
    <!-- Section: Fixed Components -->
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
                <ul>
                    <li>
                        <a class="btn" href="/dashboard"> <i class="fa-solid fa-house"></i>Dashboard
                        </a>
                    </li>
                    <li><a class="btn" href="/lab/requests"><i class="fa fa-check-circle"></i>Accept
                            Requests</a>
                    </li>
                    <li><a class="btn" href="/lab/past-requests"><i class="fa fa-file-text-o"></i>View Past Requests</a>
                    </li>
                    <li><a class="btn disabled" href="/lab/reports"> <i class="fa fa-flask"></i> Generate Reports</a>
                    </li>
                    <li><a class="btn" href="/lab/past-reports"> <i class="fa fa-list-alt"></i> View Past Reports </a>
                    </li>
                    <li> <a class="btn" href="/lab/contact-us"> <i class="fa fa-phone"></i> Contact Us </a></li>
                </ul>
            </div>
        </div>
    </div>
    <nav>

        </div>
        <div class="nav-inner">
            <ul>
                <li><a class="link" href="/login"><i class="fa-solid fa-right-from-bracket"></i></a></li>
            </ul>
            <a class="nav-profile" href="#">
                <div class="nav-profile-image">
                    <img alt="Profile image" src="../res/avatar-empty.png" />
                </div>
            </a>
        </div>
    </nav>
    <!-- Section: Fixed Components -->


    <div class="canvas nav-cutoff sidebar-cutoff">
        <div class="canvas-inner">
            <div class="row">
                <div class="col" style="display: flex; flex-direction: row;">
                    <div class="card g-col-2 g-row-2-start-3"
                        style=" box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 20px; width:90%">
                        <div class="card-body">
                            <div style="padding: 2%;">
                                <h3>Generate Lab Report</h3>
                                <br>
                                <form method="post" action="/lab/generate-report" enctype="multipart/form-data">
                                    Lab Request Id:
                                    <select name='reqid' value='' class='form-input' required>
                                        <?php
                                        $reports = new LabReportModel;
                                        $reports->PendingReportsDropDown($_SESSION['username']);
                                        ?>
                                    </select>
                                    <br>Status:<br>
                                    <input class="form-input" type="radio" name="status" value='1'> Verify
                                    <input class="form-input" type="radio" name="status" value='0'> Unverify
                                    <br><br>
                                    Lab Report<small> (3MB - jpg,jpeg,png,pdf) </small><br><input class="form-input"
                                        type="file" name="LabReport" id="LabReport" required accept="image/*,.pdf"><br>
                                    Comment:<br>
                                    <textarea class="form-input" id="comment" name="comment" rows="10" cols="60">Enter Comment
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