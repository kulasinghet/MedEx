<?php

use app\views\pharmacy\Components;

$components = new Components();
echo $components->viewHeader("Inventory");
echo $components->navBar($_SESSION['username']);
echo $components->sideBar('inventory');

?>


<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <div class="row">
            <div class="col">
                <p> Inventory </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
