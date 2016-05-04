<!doctype>
<html>
<head>
    <?php session_start(); ?>

    <?php if(!isset($_SESSION['username'])){ header("Location: http://isit.local/ass7/task2/task2b.php"); } ?>

    <title>Welcome</title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<header>
    <?php include('inc/nav.php');
    require_once('scripts/db.php');
    ?>
</header>
<body>
    <div class="container-fluid">
        <div class="container">
            <?php if(isset($_GET['fail'])): ?>
                <?php if($_GET['fail'] == true): ?>
                    <h1>Failed attempt</h1>
                   <?php $mark = $_GET['mark']; ?>
                    <p>Your mark was: <?php echo $mark; ?>/40</p>
                    <p>Would you like to <a href="http://isit.local/ass7/task2/exam-select.php?retry=true">Retry?</a></p>
                <?php endif; ?>
            <?php endif; ?>
            <?php if(isset($_GET['pass'])): ?>
                <?php if($_GET['pass'] == true): ?>
                    <h1>Congratulations you have passed!</h1>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>
</body>

</html>