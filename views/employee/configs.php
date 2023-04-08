<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin - Configurations</title>

    <link href="../scss/main.css" rel="stylesheet"/>
    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
</head>
<body>
<!-- Section: Fixed Components -->
<div class="sidebar-foldable">
    <div class="sidebar-inner">
        <nav class="sidebar-header">
            <div class="sidebar-logo">
                <a href="#">
                    <img alt="MedEx logo" src="../res/logo/logo-text_light.svg"/>
                </a>
            </div>
        </nav>
        <div class="sidebar-context">
            <h6 class="sidebar-context-title">Menu</h6>
            <ul class="main-buttons">
                <li>
                    <a href="/dashboard"> <i class="fa-solid fa-house"></i> Home </a>
                </li>
                <li>
                    <i class="fa-solid fa-check"></i>
                    Approvals
                    <ul class="hidden">
                        <li><a href="/employee/approvals/pharmacy"> Pharmacy </a></li>
                        <li><a href="/employee/approvals/supplier"> Supplier </a></li>
                        <li><a href="/employee/approvals/lab"> Lab </a></li>
                        <li><a href="/employee/approvals/delivery"> Delivery Partner </a></li>
                    </ul>
                </li>
                <li>
                    <a href="/employee/reports"> <i class="fa-solid fa-newspaper"></i> Reports </a>
                </li>
                <li>
                    <a href="#"> <i class="fa-solid fa-server"></i> Resources </a>
                    <ul class="hidden">
                        <li>Pharmacy</li>
                        <li>Supplier</li>
                        <li>Laboratory</li>
                        <li>Delivery Partner</li>
                    </ul>
                </li>
                <li class="disabled">
                    <a href="/employee/configs"> <i class="fa-solid fa-wrench"></i> Configurations </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<nav>
    <div class="nav-inner">
        <ul>
            <li><a href="#"><i class="fa-solid fa-gear"></i></a></li>
            <li><a href="#"><i class="fa-solid fa-bell"></i></a></li>
            <li><a href="/logout"><i class="fa-solid fa-right-from-bracket"></i></a></li>
        </ul>
        <a class="nav-profile" href="#">
            <div class="nav-profile-image">
                <img alt="Profile image" src="../res/avatar-empty.png"/>
            </div>
        </a>
    </div>
</nav>
<!-- Section: Fixed Components -->

<!-- Section: Dashboard Layout -->
<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <div class="row">
            <div class="col card">
                <div class="card-body">
                    <h5 class="card-title">Staff Privileges</h5>
                    <form>
                        <div class="form-selector">
                            <input type="checkbox" class="form-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">View Analyzed Data</label>
                        </div>
                        <div class="form-selector">
                            <input type="checkbox" class="form-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Approve Pharmacy</label>
                        </div>
                        <div class="form-selector">
                            <input type="checkbox" class="form-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Approve Supplier</label>
                        </div>
                        <div class="form-selector">
                            <input type="checkbox" class="form-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Approve Lab</label>
                        </div>
                        <div class="form-selector">
                            <input type="checkbox" class="form-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Approve Delivery Partner</label>
                        </div>
                        <div class="form-selector">
                            <input type="checkbox" class="form-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Resource Management</label>
                        </div>
                        <div class="form-selector">
                            <input type="checkbox" class="form-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Configure Application</label>
                        </div>

                        <div class="row action-buttons">
                            <div class="col">
                                <button type="submit" class="btn btn--success">Save</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn--danger">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col card">
                <div class="card-body">
                    <h5 class="card-title">Manager Privileges</h5>
                    <form>
                        <div class="form-selector">
                            <input type="checkbox" class="form-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">View Analyzed Data</label>
                        </div>
                        <div class="form-selector">
                            <input type="checkbox" class="form-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Approve Pharmacy</label>
                        </div>
                        <div class="form-selector">
                            <input type="checkbox" class="form-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Approve Supplier</label>
                        </div>
                        <div class="form-selector">
                            <input type="checkbox" class="form-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Approve Lab</label>
                        </div>
                        <div class="form-selector">
                            <input type="checkbox" class="form-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Approve Delivery Partner</label>
                        </div>
                        <div class="form-selector">
                            <input type="checkbox" class="form-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Resource Management</label>
                        </div>
                        <div class="form-selector">
                            <input type="checkbox" class="form-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Configure Application</label>
                        </div>

                        <div class="row action-buttons">
                            <div class="col">
                                <button type="submit" class="btn btn--success">Save</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn--danger">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Section: Dashboard Layout -->
</body>
</html>