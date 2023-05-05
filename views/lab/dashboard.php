<?php
use app\controllers\lab\LabDashboardController;
use app\models\LabModel;
use app\models\LabRequestModel;
use app\models\LabReportModel;

?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Laboratory Dashboard</title>
    <link href="../scss/vendor/demo.css" rel="stylesheet" />
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
                        <a class="btn disabled" href="/dashboard"> <i class="fa-solid fa-house"></i>Dashboard
                        </a>
                    </li>
                    <li><a class="btn" href="/lab/requests"><i class="fa fa-check-circle"></i>Accept Requests</a>
                    </li>
                    <li><a class="btn" href="/lab/past-requests"><i class="fa fa-file-text-o"></i>View Past Requests</a>
                    </li>
                    <li><a class="btn" href="/lab/reports"> <i class="fa fa-flask"></i> Generate Reports</a></li>
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
                        style=" box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 20px; width:50%">
                        <div class="card-body">
                            <div style="padding: 2%;">
                                <div style="display: flex; flex-direction: row;">
                                    <h3 style="padding-right:60%">Welcome Back !</h3>
                                </div>
                                <?php
                                $lab = new LabModel;
                                $labreq = new LabRequestModel;
                                $labreport = new LabReportModel;
                                $result1 = $labreq->getAcceptedReqCount($_SESSION['username']);
                                if ($result1->num_rows > 0) {
                                    while ($row1 = $result1->fetch_assoc()) {
                                        $request = $row1['COUNT(id)'];
                                    }
                                }
                                $result2 = $labreport->getLabReportCount($_SESSION['username']);
                                if ($result2->num_rows > 0) {
                                    while ($row2 = $result2->fetch_assoc()) {
                                        $reportcount = $row2['COUNT(reqId)'];
                                    }
                                }
                                echo " <h3>" . $_SESSION['username'] . "<br/><br/>To date you have,</h3>
                               <center> <h5><br/>Accepted <b>" . $request . " </b>Lab Requests</h5>" .
                                    "<h5><br/>Issued <b>" . $reportcount . " </b>Lab Reports</h5></center>";
                                ?>
                            </div>
                        </div>

                    </div>
                    <div class="card g-col-2 g-row-2-start-3"
                        style=" box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 20px; width:50%">
                        <div class="card-body">
                            <div style="padding: 2%;">
                                <?php
                                $req = new LabRequestModel;
                                $result1 = $req->getNotAcceptedReqCount();
                                if ($result1->num_rows > 0) {
                                    while ($row1 = $result1->fetch_assoc()) {
                                        $reqcount = $row1['COUNT(id)'];
                                    }
                                }
                                echo "<center><br/><br/> <br/><h3> There are " . $reqcount . " New Lab Requests</h3><br>
                                <a href='/lab/requests' class='btn btn--primary'>View New Requests</a></center>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>