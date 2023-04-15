<?php
use app\controllers\lab\LabDashboardController;
use app\controllers\lab\LabRequestsController;

?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Laboratory Requests</title>
    <link href="../scss/vendor/demo.css" rel="stylesheet" />
    <link href="../css/supplier/formcss.css" rel="stylesheet" />
    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
</head>

<body>

    <!-- Section: Fixed Components -->
    <div class="sidebar-collapsible">
        <div class="sidebar-inner">
            <nav class="sidebar-header">
                <div class="sidebar-logo">
                    <a href="#">
                        <img alt="MedEx logo" src="../res/logo/logo-text_light.svg" />
                    </a>
                </div>
            </nav>
            <div class="sidebar-context">
                <ul class="main-buttons">
                    <li>
                        <a href="#"> <i class="fa fa-file-text-o"></i>Lab Requests</a>
                        <ul class="hidden">
                            <li class="disabled"><a href="/lab/requests">Accept Lab Requests</a></li>
                            <li><a href="#">View Accepted Requests</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"> <i class="fa fa-list-alt"></i> Lab Reports</a>
                        <ul class="hidden">
                            <li><a href="/lab/reports"> Generate Lab Reports</a></li>
                            <li><a href="#">View Past Lab Reports </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/lab/contact-us"> <i class="fa fa-phone"></i> Contact Us </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <nav>
        <div class="nav-inner">
            <ul>
                <li><a class="link" href="#"><i class="fa-solid fa-gear"></i></a></li>
                <li><a class="link" href="login"><i class="fa-solid fa-right-from-bracket"></i></a></li>
                <li><a class="link" href="#"><i class="fa-solid fa-bell"></i></a></li>
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
                <div class="col" style="display: flex; flex-direction: column;">
                    <div class="card g-col-2 g-row-2-start-3"
                        style=" box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); border-radius: 20px; width:80%">
                        <div class="card-body">
                            <div style="padding: 2%;">
                                <h3>Pending Requests</h3>
                                </br>
                                <div class="nav-search">
                                    <form onsubmit="preventDefault();" role="search">
                                        <label for="search">Filter Medicine</label>
                                        <input autofocus id="search" placeholder="Filter Medicine" required
                                            type="search" />
                                        <button type="submit">Go</button>
                                    </form>
                                </div>
                                <table style='width: 100%; text-align:center; padding-top:5%' class='scrollable'>
                                    <tr style='padding:1%; border-bottom: 1pt solid black;'>
                                        <th>Request ID</th>
                                        <th>Supplier Name</th>
                                        <th>Medicine Name</th>
                                        <th>Scientific Name</th>
                                        <th>Weight</th>
                                        <th></th>
                                    </tr>
                                    <?php
                                    $req = new LabRequestsController;
                                    $req->viewRequests();
                                    ?>
                                </table>
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