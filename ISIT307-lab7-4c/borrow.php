<?php
date_default_timezone_set('Australia/Sydney');

session_start();
if (!isset($_SESSION['userid']))
{
    exit(0);
}
if (!isset($_POST['book_number']) || !is_numeric($_POST['book_number']))
{
    exit(0);
}
$book_number = $_POST['book_number'];
require_once("util/Db_Handler.php");
$dbHandler = new DbHandler();
$now = new DateTime();
$now->modify('+24 day');
$now = $now->format("Y-m-d");
$done = $dbHandler->insertQuery("INSERT INTO borrow(book_number, member_id, due_date) values(?, ?, '$now') ", "dd", array($book_number, $_SESSION['userid']));
$response['code'] = $done? 1: 0;
echo json_encode($response);
