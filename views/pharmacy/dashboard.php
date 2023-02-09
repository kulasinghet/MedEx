<?php

use app\views\pharmacy\Components;

$components = new Components();
echo $components->viewHeader("Dashboard");
echo $components->navBar($_SESSION['username']);
echo $components->sideBar('dashboard');

?>

<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <div class="row">
            <div class="col">
                <p> Dashboard </p>
            </div>
        </div>
    </div>
</div>
</body>

</html>