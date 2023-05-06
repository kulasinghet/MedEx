<html lang="en">

<!DOCTYPE html>

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Supplier - Contact Us</title>
    <link href="../scss/vendor/demo.css" rel="stylesheet" />
    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-inner">
            <nav class="sidebar-header">
                <div class="sidebar-logo">
                    <a href="/dashboard">
                        <img alt="MedEx logo" src="../res/logo/logo-text_light.svg" />
                    </a>
                </div>
            </nav>
            <div class="sidebar-context">
                <ul>
                    <li>
                        <a class="btn" href="/dashboard"> <i class="fa-solid fa-house"></i>Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="btn" href="/supplier/add-medicine"> <i class="fa fa-medkit"></i> Add New
                            Medicine
                        </a>
                    </li>
                    <li>
                        <a class="btn" href="/supplier/inventory"> <i class="fa fa-dropbox"></i> Inventory </a>
                    </li>
                    <li>
                        <a class="btn" href="/supplier/update-inventory"> <i class="fa fa-plus-square"></i>
                            Update
                            Inventory
                        </a>
                    </li>
                    <li>
                        <a class="btn" href="/supplier/accept-orders"> <i class="fa fa-check-circle"></i>
                            Accept Orders
                        </a>
                    </li>
                    <li>
                        <a class="btn" href="/supplier/orders"> <i class="fa fa-list-alt"></i> View
                            Accepted
                            Orders
                        </a>
                    </li>
                    <li>
                        <a class="btn" href="/supplier/medicine-requests"> <i class="fa fa-hourglass-half"></i>
                            Medicine
                            Requests </a>
                    </li>

                    <li>
                        <a class="btn disabled" href="/supplier/contact-us"> <i class="fa fa-phone"></i> Contact Us </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <nav>
        <div class="nav-inner">
            <ul>
                <li><a class="link" href="/login"><i class="fa-solid fa-right-from-bracket"></i></a></li>
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

                        <form method="post" action="/supplier/contact-us">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Subject</label>
                                <select name="subject" value='' class='form-input' required>
                                    <option value='Request to Re-evalute Medcine Request' class='option'>Request to
                                        Re-evalute Medcine Request</option>
                                    <option value='Request to Change Profile Details' class='option'>Request to Change
                                        Profile Details</option>
                                    <option value='Inquriy about Pharmacy Order' class='option'>Inquriy about
                                        Pharmacy Order</option>
                                    <option value='Other' class='option'>Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Message</label>
                                <textarea class="form-input" id="message" name="message" rows="3"></textarea>
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