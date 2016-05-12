<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 6/04/2016
 * Time: 4:15 PM
 */


require_once("db.php");

$db = connect_db();
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM LOGIN WHERE username='" . $username . "' AND password='" . $password . "'";
$result=mysqli_query($db,$sql);
$result;

if(!empty($result)) {
    // Associative array
    $row = mysqli_fetch_assoc($result);

    session_start();
    $_SESSION['username'] = $row['username'];
    $_SESSION['studentid'] = $row['studentid'];

    header("Location: ../index.php");
    exit;
}else {
    header("Location: ../login.php?loginerror=false");
    exit;
}



?>