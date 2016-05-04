<?php
    if (!isset($page))
        $page = "";
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Car Dealer</a>
        </div>
        <ul class="nav navbar-right navbar-nav">
            <li <?php if ($page == "home") echo "class='active'"?>><a href="index.php">Home</a></li>
            <li <?php if ($page == "sell") echo "class='active'"?>><a href="seller.php">Sell cars</a></li>
            <li <?php if ($page == "about") echo "class='active'"?>><a href="about.php">About us</a></li>
            <li <?php if ($page == "contact") echo "class='active'"?>><a href="contact.php">Contact us</a></li>
        </ul>
    </div>
</nav>