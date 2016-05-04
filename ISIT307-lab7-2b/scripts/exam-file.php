<?php


    require_once('db.php');
    session_start();
    $db = connect_db();
    $set = $_POST['question-set-select'];
    $studentid = $_SESSION['studentid'];
    $file;


    $fname = $_FILES['user-file']['name']; //The original name of the file from the user’s machine.
    $type = $_FILES['user-file']['type']; // The mime type of the file
    $size = $_FILES['user-file']['size']; // The size of the file in bytes.
    $tmpname = $_FILES['user-file']['tmp_name']; // the full filename of the uploaded file.
    $ferror = $_FILES['user-file']['error'];

    if (!($_FILES['user-file']['size'])) {
        echo "<p>ERROR: No actual file uploaded</p>\n";
    } else {


        chdir('/Sites/isit/ass7/task2/');
        $file = fopen($fname,"r");
        $temp;
        $count = 0;
        $fail = false;
        $minus = 0;
        $questions = 0;
        $val;

        while(!feof($file)){
            $line = fgets($file);
            $temp = explode(",", $line);
            $val = trim($temp[1]);

            if($val == "A"){
                $count++;
            }
            unset($temp);
            $questions++;
        }
        fclose($file);
    }



    if($questions < 40){

        $sql = "INSERT INTO ATTEMPTS VALUES(NULL,'" . $studentid . "','" . $set . "','F');";
        $db->query($sql);

        header("Location: http://isit.local/ass7/task2/results.php?fail=true&no-total=true");
    }else {

        if($count < 40){
            $fail = true;
        }
        if ($fail) {

            $sql = "INSERT INTO ATTEMPTS VALUES(NULL,'" . $studentid . "','" . $set . "','F');";
            $db->query($sql);

            header("Location: http://isit.local/ass7/task2/results.php?fail=true&mark=" . $count);
        } else {

            $sql = "INSERT INTO ATTEMPTS VALUES(NULL,'" . $studentid . "','" . $set . "','P');";
            $db->query($sql);
            header("Location: http://isit.local/ass7/task2/results.php?pass=true&mark=" . $count);
        }
    }

?>