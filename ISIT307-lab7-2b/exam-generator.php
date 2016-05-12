<?php
require_once("scripts/Db_Handler.php");
$dbHandler = new DBHandler();
$questions = $dbHandler->executeQuery("SELECT * from QUESTIONS");
echo json_encode($questions);
?>