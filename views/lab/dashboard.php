<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/pharmacy/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/pharmacy/sidepanel.css">
    <link rel="stylesheet" href="/css/pharmacy/table.css">
    <link rel="stylesheet" href="/css/delivery/dashboard.css">
    <!--    <script src="js/pharmacy/.js"></script>-->
</head>

<body >

<div class="navbar">
    <div class="logo">
        <a href="/"><img src="/res/logo/logo.svg" alt="logo"></a>
    </div>
    <div class="links">
        <a href="/">Home</a>
        <a href="/lab/profile">Profile</a>
        <a href="/logout">Logout</a>
    </div>
</div>

<div class="sidepanel">
    <div class="logo">

        <a href="/"><img src="/res/logo/logo.svg" alt="logo"></a>
    </div>
    <div id="links">
        <span>
                <i class='fas fa-warehouse' style='color:#333333'></i>
                <a href="/lab/orders">Orders</a>
            </span>
        <hr>
        <span>
                <i class='fa fa-phone' style='color:#333333'></i>
                <a id="contact-us" href="/lab/contact-us">Contact Us</a>
            </span>
    </div>
</div>


<div id="main-content">

    <table>
        <thead>
        <tr>
            <th>Order ID</th>
            <th>Test Name</th>
            <th>Deadline</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        <?php

        use app\core\Database;

            $db = new Database();
            $sql = "SELECT * FROM labreq;";
            $stmt = $db -> prepare($sql);
            $stmt -> execute();
            $result = $stmt -> get_result();


            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "<td>" . $row['recivedDate'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>

    </div>
</div>
</div>
</body>
</html>