<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard</title>
    <link href="../scss2/vendor/demo.css" rel="stylesheet"/>
    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
</head>

<body>

<?php

use app\views\pharmacy\Components;

$components = new Components();
echo $components->navBar($_SESSION['username']);
echo $components->sideBar('contact-us');
?>


<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <div class="row">
            <div class="col">
                <p> Contact Us </p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
