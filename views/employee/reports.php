<?php

use \app\controllers\employee\EmployeeReportListController;
use app\stores\EmployeeStore;
use app\views\employee\EmployeeViewComponents;

const no_of_reports = 10;

$components = new EmployeeViewComponents();
$store = EmployeeStore::getEmployeeStore();
$set = $store->flag_g_st; // getting the number of set
$store->flag_g_st = 0; // resetting the set number in the store
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
    <!-- g28 style -->
    <link rel="stylesheet" href="/scss/main.css" />
    <script src="/js/g28-main.js"></script>
</head>
<body>
<!-- Section: Fixed Components -->
<?php
echo $components->createSidebar('res');
echo $components->createNavbar();
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
                    $controller = new EmployeeReportListController();
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
<script type="application/javascript">
    // you can configure variables in here.
    configs.stage = 'dev';
    configs.customFormElmPath = '/scss/components/forms';

    // adding simplebar to the report list
    new SimpleBar(document.querySelector('.report-list .list-content'));

    // manipulating report items
    document.querySelectorAll('.report-itm').forEach((itm) => {
        const report_types = ['pharmacy', 'supplier', 'delivery', 'lab'];

        itm.addEventListener('click', (e) => {
            e.stopPropagation();

            if (e.currentTarget === itm) {
                console.log('/employee/reports/seen?et=' + itm.getAttribute('data-id'));

                // getting a response from the server
                fetch('/employee/reports/seen?et=' + itm.getAttribute('data-id'))
                    .then(r => r.json())
                    .then(response => {
                        if (response.success) {
                            // Access additional attributes
                            const username = response.username;
                            const inquiryId = response.inquiry_id;
                            logger('Report seen by ' + username + ' for inquiry ID ' + inquiryId + '.');

                            // validating the response with the report item
                            if (inquiryId === itm.getAttribute('data-id')) {
                                // removing the user type class from the report item
                                itm.classList.forEach((cls) => {
                                    if (report_types.includes(cls)) {
                                        itm.classList.remove(cls);
                                    }
                                });
                            }
                        }
                    });
            }
        });
    });
</script>
<script src="/js/g28-forms.js"></script>
<!-- g28 styling framework -->
</body>
</html>
