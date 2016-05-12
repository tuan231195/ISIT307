<!doctype>
<html>
<head>
    <title>Welcome</title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>

</head>


<?php
require_once('Db_Handler.php');
$dbHandler = new DBHandler();
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit(0);
}

$result = $dbHandler->prepareQuery("SELECT * FROM attempts WHERE studentid = ?", "s", array($_SESSION['studentid']));
if (count($result) > 0 && $result[0]['status'] != 'U') {
    header("Location: ../index.php");
    exit(0);
}


$fname = $_FILES['user-file']['name']; //The original name of the file from the user’s machine.
if (empty($fname)) {
    header("Location: ../index.php");
}


$tmp = $dbHandler->executeQuery("SELECT questionID, answer FROM questions");
$answers = array();
for ($i = 0; $i < count($tmp); $i++) {
    $answers[$tmp[$i]["questionID"]] = $tmp[$i]["answer"];
}


$target_dir = "../uploads/";
$target_file = $target_dir . basename($fname);


$sequence = $_POST["sequence"];
$sequence = explode(",", $sequence);
$correct = 0;
$counter = 0;

if (!($_FILES['user-file']['size'])) {
    echo "<p>ERROR: No actual file uploaded</p>\n";
} else {
    if (file_exists($target_file)) {
        unlink($target_file);
    }

    if (move_uploaded_file($_FILES["user-file"]["tmp_name"], $target_file)) {
    } else {
        die("Error uploading the file");
    }
    $file = fopen($target_file, "r");
    $questions = 0;


    while (!feof($file)) {
        $line = fgets($file);

        sscanf($line, "%d %c", $number, $answer);
        if ($answer === $answers[$sequence[$counter]])
            $correct++;
        $counter++;
        $questions++;
    }
    fclose($file);

}

include('../inc/nav.php');

$num_attempts = 0;
if (count($result) > 0)
    $num_attempts = $result[0]["num_attempts"];
$num_attempts++;
$fail = false;
?>
<body>
<div class="container">
    <div class="page-header"><h5>Your result</h5></div>
    <?php
    if ($questions != 40) {
        echo "You have not answered a correct number of questions.<br/>";
        $fail = true;
    } else {
        if ($correct < 40) {
            echo "You got $correct correct answers <br/>";
            $fail = true;
        } else {
            echo "Congrats! You have passed the exam";
            $status = 'P';
            $_SESSION['pass'] = true;
        }
    }

    if ($fail) {
        if ($num_attempts < 5) {
            $status = 'U';
            echo "<br/><a href = '../exam.php' class = 'btn btn-primary'>Reattempt</a>";
        } else {
            $status = 'F';
            echo "You have failed the exam";
            $_SESSION['pass'] = false;
        }
    }


    if (count($result) == 0) {
        $dbHandler->insertQuery("INSERT INTO attempts(studentid, num_attempts, status, grade) VALUES (?, ?, ?, ?)", "sdsd", array($_SESSION['studentid'], 1, $status, $correct));
    } else {
        $dbHandler->updateQuery("UPDATE attempts SET num_attempts = $num_attempts, grade = $correct, status = '$status'");

    }

    if ($status === 'P')
        echo "You have pass the exam";
    ?>


</div>
</body>
</html>