<?php

use \app\controllers\employee\EmployeeInquiriesListController;
use app\stores\EmployeeStore;
use app\views\employee\EmployeeViewComponents;

const no_of_reports = 10;

$components = new EmployeeViewComponents();
$store = EmployeeStore::getEmployeeStore();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin | Reports</title>

    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
    <!-- Simplebar -->
    <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css"/>
    <script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- g28 style -->
    <link rel="stylesheet" href="/scss/main.css" />
    <link rel="stylesheet" href="/scss/vendor/employee.css" />
    <script src="/js/g28-main.js"></script>
</head>
<body>
<!-- Section: Fixed Components -->
<?php
echo $components->createSidebar('inquiries');
echo $components->createNavbar();
$store->renderNotifications();
?>
<!-- Section: Fixed Components -->

<!-- Section: Dashboard Layout -->
<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <!-- Content -->
        <div class="row margin-bottom">
            <div class="col card report-list">
                <div class="card-body list-content">
                    <?php
                    $controller = new EmployeeInquiriesListController();
                    try {
                        $report_list = $controller->getAllReports();
                        if (!empty($report_list)) {
                            foreach ($report_list as $report) {
                                echo $components->createReportItem($report);
                            }
                        } else {
                            echo "<h3 class='text-center'>No reports found!</h3>";
                        }
                    } catch (Exception $e) {
                        echo "Something went wrong! $e";
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- Content -->
    </div>
</div>
<!-- Section: Dashboard Layout -->

<!-- g28 styling framework -->
<script src="/js/employee/reports.js"></script>
<script src="/js/g28-toast.js"></script>
<!-- g28 styling framework -->
</body>
</html>
