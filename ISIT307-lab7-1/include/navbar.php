<nav role="navigation" class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="#" class="navbar-brand"><h3>Shop</h3></a>
            <button type="button" class="navbar-toggle"
                    data-target="#navbarCollapse" data-toggle="collapse">
                <span class="sr-only"> Toggle Navigation </span> <span
                    class="icon-bar"></span> <span class="icon-bar"></span> <span
                    class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbarCollapse">
            <ul class="nav navbar-nav navbar-right">
                <li <?php if ($page == "index") echo "class='active'" ?>><a href="index.php"> Home </a></li>
                <li <?php if ($page == "cart") echo "class='active'" ?>><a href="cart.php"> Your cart </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
