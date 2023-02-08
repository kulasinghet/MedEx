<?php

use app\views\pharmacy\Components;

$components = new Components();
echo $components->viewHeader("Contact Us");
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
