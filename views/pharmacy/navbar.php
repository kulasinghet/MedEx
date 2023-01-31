<html lang="en">
<head>
    <link rel="stylesheet" href="/css/pharmacy/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
          integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

</head>
<body>
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




</body>

