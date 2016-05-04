<?php
if (!isset($page))
    $page = "";
?>

<nav role="navigation" class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="#" class="navbar-brand"><h3>UOW</h3></a>
            <button type="button" class="navbar-toggle"
                    data-target="#navbarCollapse" data-toggle="collapse">
                <span class="sr-only"> Toggle Navigation </span> <span
                    class="icon-bar"></span> <span class="icon-bar"></span> <span
                    class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbarCollapse">
            <ul class="nav navbar-nav">
                <li <?php if ($page == "home") echo "class='active'" ?>><a href="./"> Home </a></li>
                <li <?php if ($page == "departments") echo "class='active'" ?>><a href="?a=department"> Departments </a>
                </li>
                <li <?php if ($page == "courses") echo "class='active'" ?>><a href="?a=course"> Courses </a></li>
                <li <?php if ($page == "professors") echo "class='active'" ?>><a href="?a=professor"> Professors </a>
                </li>
                <li <?php if ($page == "classes") echo "class='active'" ?>><a href="?a=class"> Classes </a></li>
                <?php
                if (isset($_SESSION['user'])) {
                    ?>
                    <li <?php if ($page == "enrolled") echo "class='active'" ?>><a href="?a=enrolled"> Enrolled </a>
                    </li>
                    <li <?php if ($page == "enquiry") echo "class='active'" ?>><a href="?a=enquiry"> Enquiry </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <ul class="nav navbar-right navbar-nav">
                <li><a href = "?c=search&a=search" class="btn" id="searchBtn"><span
                            class="glyphicon glyphicon-search"></span> Search </a></li>
                <?php
                if (!isset($_SESSION['user'])) {
                    ?>
                    <li><a class="btn" id="loginBtn" data-toggle="modal" data-target="#loginModal"><span
                                class="glyphicon glyphicon-log-in"></span> Login </a></li>
                    <?php

                } else {
                    ?>

                    <li><a href="?c=authorize&a=logout" class="btn" id="logoutBtn"><span
                                class="glyphicon glyphicon-log-out"></span> Logout </a></li>
                    <?php
                }
                ?>
            </ul>


        </div>


    </div>
</nav>

<?php
if (!isset($_SESSION['user'])) {
    require_once "public/include/login.php" ?>
    <script type="text/javascript">
        if (getParameterByName("login") === "true") {
            $("#loginBtn").click();
        }
    </script>
    <?php
}
?>

<div class="container-fluid sliding-images" >
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="public/images/lecture.jpg" alt="Lecture">
            </div>

            <div class="item">
                <img src="public/images/puzzle.jpg" alt="Puzzle">
            </div>

            <div class="item">
                <img src="public/images/skills.jpg" alt="Flower">
            </div>
        </div>

    </div>
</div>