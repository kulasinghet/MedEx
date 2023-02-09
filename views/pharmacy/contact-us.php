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
            <div class="col ">

                <div class="contact-us">
                <h1>Contact Us</h1>

                <form>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Subject</label>
                        <input type="email" class="form-input" id="exampleFormControlInput1" placeholder="Subject">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Message</label>
                        <textarea class="form-input" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
