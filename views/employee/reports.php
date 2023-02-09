<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin - Reports</title>

    <link href="../scss/main.css" rel="stylesheet"/>
    <!-- Font awesome kit -->
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/9b33f63a16.js"></script>
</head>
<body>
<!-- Section: Fixed Components -->
<div class="sidebar">
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
            <ul>
                <li>
                    <a class="btn" href="/dashboard"> <i class="fa-solid fa-house"></i> Home </a>
                </li>
                <li>
                    <a class="btn" href="#"> <i class="fa-solid fa-check"></i> Confirmations </a>
                </li>
                <li>
                    <a class="btn disabled" href="employee/reports"> <i class="fa-solid fa-newspaper"></i> Reports </a>
                </li>
                <li>
                    <a class="btn" href="#"> <i class="fa-solid fa-server"></i> Resources </a>
                </li>
                <li>
                    <a class="btn" href="#"> <i class="fa-solid fa-wrench"></i> Configurations </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<nav>
    <div class="nav-search">
        <form onsubmit="preventDefault();" role="search">
            <label for="search">Search for stuff</label>
            <input autofocus id="search" placeholder="Search..." required type="search"/>
            <button type="submit">Go</button>
        </form>
    </div>
    <div class="nav-inner">
        <ul>
            <li><a href="#"><i class="fa-solid fa-circle-question"></i></a></li>
            <li><a href="#"><i class="fa-solid fa-gear"></i></a></li>
            <li><a href="#"><i class="fa-solid fa-bell"></i></a></li>
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
    <div class="canvas-inner grid flow-row-dense">
        <div class="g-col-1-start-1 g-row-2 card">
            <div class="card-body status-view">
                <p class="card-text">
                    *Use the searchbar to filter the list.
                </p>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Inquiry ID</th>
                        <th>Username</th>
                        <th>Subject</th>
                    </tr>
                    <thead>
                    <tbody>
                    <tr>
                        <td>ID2001</td>
                        <td>Thevindu</td>
                        <td>Contact us is not working</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="g-col-1 g-row-3-start-4 card">
            <div class="card-body status-view">
                <h5 class="card-title">Report in Details</h5>
                <div class="row">
                    <div class="col">
                        <table class="status-table">
                            <tbody>
                            <tr>
                                <th>Username</th>
                                <td>Test 1</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col">
                        <table class="status-table">
                            <tbody>
                            <tr>
                                <th>Subject</th>
                                <td>Test 1</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="report-description">
                    <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Section: Dashboard Layout -->
</body>
</html>