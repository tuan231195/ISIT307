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

        <?php

                $studentid = $_SESSION['studentid'];
                $db = connect_db();
                $setsql = "SELECT * FROM ATTEMPTS WHERE studentid='" . $studentid . "'";

                $results = mysqli_query($db, $setsql);

                if($results->num_rows > 0){

                    if($results->num_rows >= 5) {

                        echo "<h2>You have failed too many times!</h2>";

                    }else {
                        $sql = "SELECT * FROM ATTEMPTS WHERE studentid='" . $studentid . "'";

                        $results = mysqli_query($db, $sql);
                        if (check_pass($results)) {
                            echo "<h2>You have already passed this test</h2>";
                        } else {

                            $count = 1;

                            $sql = "SELECT * FROM QUESTIONSET WHERE studentid='" . $studentid . "'";
                            $results = mysqli_query($db, $sql);


                            echo "<h3>Please select the question set you would like to use for this exam</h3>";

                            echo "<form action='exam-commence.php' method='POST'>";
                            while ($row = mysqli_fetch_assoc($results)) {
                                echo "<div class='row' style='margin-bottom:2%;'>";
                                echo "<div class='col-sm-3'><input type='checkbox' name='attempt-option[]' value='" . $row['questionsetID'] . "' /></div>";
                                echo "<div class='col-sm-6'>Question Set " . $count . ": " . $row['questionset'] . "</div>";
                                echo "</div>";
                                $count++;
                            }
                            echo "<input type='submit' class='btn btn-primary' name='select-question-set' />";
                            echo "</form>";
                        }
                    }
                }else {
                    $count = 1;

                    $sql = "SELECT * FROM QUESTIONSET WHERE studentid='" . $studentid . "'";
                    $results = mysqli_query($db, $sql);


                    echo "<h3>Please select the question set you would like to use for this exam</h3>";

                    echo "<form action='exam-commence.php' method='POST'>";
                    while ($row = mysqli_fetch_assoc($results)) {
                        echo "<div class='row' style='margin-bottom:2%;'>";
                        echo "<div class='col-sm-3'><input type='checkbox' name='attempt-option[]' value='" . $row['questionsetID'] . "' /></div>";
                        echo "<div class='col-sm-6'>Question Set " . $count . ": " . $row['questionset'] . "</div>";
                        echo "</div>";
                        $count++;
                    }
                    echo "<input type='submit' class='btn btn-primary' name='select-question-set' />";
                    echo "</form>";
                }

        ?>



    </div>
</div>

</body>
</html>