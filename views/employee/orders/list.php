<?php

use app\controllers\employee\EmployeeOrdersListController;
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
    <title>Orders: Pharmacy list</title>

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
echo $components->createSidebar('orders');
echo $components->createNavbar();
$store->renderNotification();
?>
<!-- Section: Fixed Components -->

<!-- Section: Dashboard Layout -->
<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <!-- Toolbox -->
        <div class="toolbox">
            <div class="block row">
                <div class="col">
                    <div class="nav-search">
                        <form onsubmit="preventDefault();" role="search">
                            <label for="filter-by-search">Search for stuff</label>
                            <input autofocus id="filter-by-search" placeholder="Search..." required type="search"/>
                            <button type="submit">Go</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="separator"></div>
            <form class="block row" method="POST" action="">
                <div class="col">
                    <label for="sort-by">Sort by: </label>
                </div>
                <div class="col">
                    <g28-selectbox id="sort-by" class="filtering-selectbox" placeholder="Default">
                        Default, Name, Reg Date
                    </g28-selectbox>
                </div>
            </form>
        </div>
        <!-- Toolbox -->

        <!-- Content -->
        <div class="row margin-bottom">
            <div class="col">
                <table class="table approval-table">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th class="c" style="max-width: 100px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $controller = new EmployeeOrdersListController();
                    try {
                        $res_list = $controller->getOrderList(no_of_reports, $set);
                        if (!empty($res_list)) {
                            for ($i = 0; $i < no_of_reports; $i++) {
                                if (array_key_exists($i, $res_list)) {
                                    echo $components->createResItem($res_list[$i]);
                                } else {
                                    echo "<tr class='empty'>";
                                    echo "<td colspan='5'></td>";
                                    echo "</tr>";
                                }
                            }
                        } else {
                            echo "<tr class='empty'>";
                            echo "<td class='no-data' colspan='5' rowspan='".no_of_reports."'>No records found!</td>";
                            echo "</tr>";
                            for ($i = 0; $i < no_of_reports - 1; $i++) {
                                echo "<tr></tr>";
                            }
                        }
                    } catch (Exception $e) {
                        echo "Something went wrong! $e";
                    }
                    ?>
                    </tbody>
                </table>
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
    configs.scssStylePath = '../scss/';

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
<script src="../js/g28-toast.js"></script>
<!-- g28 styling framework -->
</body>
</html>
