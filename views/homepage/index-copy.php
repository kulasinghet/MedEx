<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard</title>

    <link href="../scss2/vendor/demo.css" rel="stylesheet"/>
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
                    <a class="btn" href="#"> <i class="fa-solid fa-house"></i> Menu Item </a>
                </li>
                <li>
                    <a class="btn" href="#"> <i class="fa-solid fa-house"></i> Menu Item </a>
                </li>
                <li>
                    <a class="btn" href="#"> <i class="fa-solid fa-house"></i> Menu Item </a>
                </li>
                <li>
                    <a class="btn" href="#"> <i class="fa-solid fa-house"></i> Menu Item </a>
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
    <div class="canvas-inner grid">
        <article>
            <p>Hello world!</p>
        </article>
    </div>
</div>
<!-- Section: Dashboard Layout -->
</body>
</html>