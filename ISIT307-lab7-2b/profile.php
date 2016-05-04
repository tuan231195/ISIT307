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
        $db = connect_db();
    ?>
</header>
<body>
<div class="container-fluid">
    <div class="container">
        <?php if(isset($_POST['question-list-submit'])):

            if(sizeof($_POST['question']) < 40 || sizeof($_POST['question']) > 40){
                echo "<h2>Please ensure you select at least 40 questions for your exam</h2>";
            }else {

                $id = $_SESSION['studentid'];
                $sql = "SELECT *, COUNT(*) FROM ATTEMPTS WHERE studentid='" . $id . "'";
                $result = mysqli_query($db,$sql);
                $qlist = "";
                $found = false;

                if($result->num_rows < 5){
                    if($result->num_rows > 0){
                        while($row = mysqli_fetch_assoc($result)){

                            if($row['status'] == "P"){
                                $found = true;
                                break;
                            }
                        }
                    }
                    if($found){
                        echo "<h1>You have already passed this exam</h1>";
                    }else {

                        $attempt = $result->num_rows + 1;
                        $studentid = $_SESSION['studentid'];

                        for ($i = 0; $i < sizeof($_POST['question']); $i++) {
                            if (strlen($qlist) == 0) {
                                $qlist = $_POST['question'][$i];
                            } else {
                                $qlist = $qlist . "," . $_POST['question'][$i];
                            }
                        }
                        $attemptsql = "INSERT INTO QUESTIONSET VALUES (NULL," . "'" . $qlist . "','" . $studentid . "');";
                        if(!$db->query($attemptsql)){
                            echo "ERROR in saving";
                            exit;
                        }else {
                            echo "<h1>Thanks your exam selection has been submitted</h1>";
                        }
                    }
                }else {
                    echo "<h1>You have taken this exam too many times</h1>";
                }
            }

        ?>

        <?php else: ?>
            <h1>Exam Selector Page</h1>
            <?php

                $sql = "SELECT * FROM QUESTIONS";
                $result = mysqli_query($db,$sql);
                $row;
                $counter = 0;
                if(!empty($result)): ?>
                    <form action="" method="POST">
                        <?php while($row = mysqli_fetch_assoc($result)): ?>

                            <div class="container">
                                <?php if($counter < 40): ?>
                                    <input type="checkbox" checked='checked' value="<?php echo $row['questionID']; ?>" name="question[]" />
                                <?php else: ?>
                                    <input type="checkbox" value="<?php echo $row['questionID']; ?>" name="question[]" />
                                <?php endif; ?>
                                <label><?php echo htmlspecialchars($row['question']); ?></label>

                            </div>

                        <?php $counter++; endwhile; ?>
                        <div class="container">
                            <input type="submit" class="btn btn-primary" name="question-list-submit" value="Submit My List" />
                        </div>
                    </form>
                <?php else: ?>
                    <p><strong>There aren't any exam questions yet</strong></p>
                <?php endif; ?>

        <?php endif; ?>
    </div>
</div>


</body>

</html>
