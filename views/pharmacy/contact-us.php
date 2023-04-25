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

                <form  action="/pharmacy/contact-us" method="post">
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-input" id="subject" placeholder="Subject" name="subject">
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-input" id="message" rows="3" name="message"></textarea>
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
