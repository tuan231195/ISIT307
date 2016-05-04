<!doctype>
<html>
<head>
    <?php session_start(); ?>

    <?php if(!isset($_SESSION['username'])){ header("Location: http://isit.local/ass7/task2/index.php"); } ?>

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

        if(isset($_POST['select-question-set'])){
            $studentid = $_SESSION['studentid'];
            $db = connect_db();
            $set = $_POST['attempt-option'][0];
            $sql = "SELECT * FROM QUESTIONSET WHERE studentid='" . $studentid . "' AND questionsetID='" . $set . "'";
            $results = mysqli_query($db, $sql);


            while($row = mysqli_fetch_assoc($results)){
                $questionList = $row['questionset'];
                break;
            }

            $items = explode(',',$questionList);

            echo "<h2>You selected question set: " . $_POST['attempt-option'][0] . "</h2>"; ?>
            <p>Please upload your answer sheet to this question set</p>
            <form action="scripts/exam-file.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="user-file" class="form-control" />
                <input type="hidden" name="MAX_FILE_SIZE" value="10000" />
                <input type="text" hidden="hidden" name="question-set-select" value="<?php echo $set; ?>" />
                <input type="submit" style='margin-top:2%;' name="user-exam-file" value="Start the Exam" class="btn btn-primary" />
            </form>



        <?php }

      ?>


    </div>
</div>

</body>
</html>