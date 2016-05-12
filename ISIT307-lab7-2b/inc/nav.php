<?php
if (!isset($page))
{
    $page = "";
}
?>
<nav class="navbar navbar-default">
    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li <?php if ($page == "index") echo "class='active'" ?>><a href="index.php"> Home </a></li>
            <li <?php if ($page == "exam") echo "class='active'" ?>><a href="exam.php"> Take exam </a>
            <li><a href="login.php?logout=true">Logout</a></li>
        </ul>
    </div>
</nav>