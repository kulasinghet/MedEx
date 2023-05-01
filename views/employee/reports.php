<?php

use app\controllers\employee\EmployeeResListController;
use app\stores\EmployeeStore;
use app\views\employee\EmployeeViewComponents;

const no_of_approvals = 10;

$components = new EmployeeViewComponents();
$store = EmployeeStore::getEmployeeStore();
$filter = $store->flag_g_t; // getting the filter
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
                    <div class="report-itm">
                        <div class="report-inner">
                            <div class="header">
                                <div class="header-icon">
                                    <a>
                                        <i class="fa-solid fa-suitcase-medical"></i>
                                    </a>
                                </div>
                                <div class="header-data">
                                    <h6 class="header-username">Username</h6>
                                    <h5 class="header-subject">Subject</h5>
                                </div>
                            </div>
                            <div class="report-body">
                                <p>Message</p>
                            </div>
                        </div>
                    </div>
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

    //logging
    logger("Logging g28 initial state before loading specialized JS files...");
    for (let property in configs) {
        logger(`> ${property}: ${configs[property]}`);
    }

    document.querySelectorAll('.approval-table tbody tr:not(.empty)').forEach((row) => {
        row.addEventListener('click', (e) => {
            e.stopPropagation();
            if (e.target.tagName === 'TD') {
                let entity = row.getAttribute('data-usr');
                let type = row.getAttribute('data-tp');
                window.location.href = '/employee/res/' + type + '?et=' + entity;
            }
        });
    });
</script>
<script src="/js/g28-forms.js"></script>
<!-- g28 styling framework -->
</body>
</html>
