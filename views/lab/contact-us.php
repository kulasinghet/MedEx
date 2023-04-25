<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Contact Us</title>
    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
    <!-- g28 style -->
    <link rel="stylesheet" href="../scss/vendor/demo.css" />
    <script src="../js/g28-main.js"></script>
</head>

<body>
    <!-- Section: Fixed Components -->
    <div class="sidebar-collapsible">
        <div class="sidebar-inner">
            <nav class="sidebar-header">
                <div class="sidebar-logo">
                    <a href="#">
                        <img alt="MedEx logo" src="../res/logo/logo-text_light.svg" />
                    </a>
                </div>
            </nav>
            <div class="sidebar-context">
                <ul class="main-buttons">
                    <li>
                        <a href="#"> <i class="fa fa-file-text-o"></i>Lab Requests</a>
                        <ul class="hidden">
                            <li><a href="/lab/requests">Accept Lab Requests</a></li>
                            <li><a href="#">View Accepted Requests</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"> <i class="fa fa-list-alt"></i> Lab Reports</a>
                        <ul class="hidden">
                            <li><a href="/lab/reports"> Generate Lab Reports</a></li>
                            <li><a href="#">View Past Lab Reports </a></li>
                        </ul>
                    </li>
                    <li class="disabled">
                        <a href="lab/contact-us"> <i class="fa fa-phone"></i> Contact Us </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <nav>
        <div class="nav-inner">
            <ul>
                <li><a class="link" href="#"><i class="fa-solid fa-gear"></i></a></li>
                <li><a class="link" href="login"><i class="fa-solid fa-right-from-bracket"></i></a></li>
                <li><a class="link" href="#"><i class="fa-solid fa-bell"></i></a></li>
            </ul>
            <a class="nav-profile" href="#">
                <div class="nav-profile-image">
                    <img alt="Profile image" src="../res/avatar-empty.png" />
                </div>
            </a>
        </div>
    </nav>
    <!-- Section: Fixed Components -->

    <div class="canvas nav-cutoff sidebar-cutoff">
        <div class="canvas-inner">
            <div class="row">
                <div class="col">

                    <div class="contact-us">
                        <h1>Contact Us</h1>

                        <form>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Subject</label>
                                <input type="email" class="form-input" id="exampleFormControlInput1"
                                    placeholder="Subject">
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