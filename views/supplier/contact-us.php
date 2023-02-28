<html lang="en">

<!DOCTYPE html>

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Contact Us</title>

    <link href="../scss/vendor/demo.css" rel="stylesheet" />
    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
</head>

<body>
    <!-- Section: Fixed Components -->
    <div class="sidebar-grouped">
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
                        <a href="/dashboard"> <i class="fa-solid fa-house"></i> Dashboard </a>
                    </li>
                    <li>
                        <a href="#"> <i class="fa fa-dropbox"></i> Inventory </a>
                        <ul class="hidden">
                            <li><a href="/supplier/add-medicine"> Add New Medicine </a></li>
                            <li><a href="/supplier/inventory"> View Inventory </a></li>
                            <li><a href="/supplier/update-inventory"> Update Inventory</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"> <i class="fa fa-check-circle"></i> Orders </a>
                        <ul class="hidden">
                            <li><a href="/supplier/accept-orders"> Accept Orders</a></li>
                            <li><a href="#"> View Orders </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/supplier/medicine-requests"> <i class="fa fa-hourglass-half"></i>Medicine Requests</a>
                    </li>
                    <li class="disabled">
                        <a href="/supplier/contact-us"> <i class="fa fa-phone"></i>Contact Us </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <nav>
        <div class="nav-search">
            <form onsubmit="preventDefault();" role="search">
                <label for="search">Search for stuff</label>
                <input autofocus id="search" placeholder="Search..." required type="search" />
                <button type="submit">Go</button>
            </form>
        </div>
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
    </div>


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