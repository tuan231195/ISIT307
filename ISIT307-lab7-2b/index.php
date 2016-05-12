<?php
session_start();
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit(0);
}
?>
<!doctype>
<html>
<head>
    <title>Welcome</title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css" />

</head>

<header>
    <?php
        $page = "index";
        include('inc/nav.php');
        require_once('scripts/Db_Handler.php');
        $dbHandler = new DBHandler();
        $statusArr = $dbHandler -> prepareQuery("SELECT * FROM attempts WHERE studentid = ?", "s", array($_SESSION['studentid']));
        if (count($statusArr) == 0)
        {
            $status = "U";
            $num_attempts = 0;
            $grade = 0;
        }
        else
        {
            $status = $statusArr[0]["status"];
            $grade = $statusArr[0]["grade"];
            $num_attempts = $statusArr[0]["num_attempts"];
        }
    ?>
</header>
<body>
<div class="container-fluid">
    <div class="container">
        <h2>Hello <?php echo  $_SESSION['username']?></h2>
        <br/>
        <br/>
        <br/>

        <div class = "page-header">
            <h3>Your exam result</h3>
        </div>
        <table class = "table table-responsive table-bordered">
            <tr>
                <th>Number of attempts</th>
                <th>Status</th>
                <th>Grade</th>
                <th>Action</th>
            </tr>
            <tr>
                <td><?=$num_attempts?></td>

                <td><?=$status?></td>
                <td><?=$grade?></td>
                <td>
                    <?php if ($status != 'U'):?>
                        <button type = "button" class = "btn btn-primary" disabled>Exam not available</button>
                    <?php else:?>
                        <a href = "exam.php" class = "btn btn-primary">Take exam</a>
                    <?php endif;?>

                </td>
            </tr>
        </table>
    </div>
</div>


</body>

</html>
