<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 3/05/2016
 * Time: 9:29 PM
 */

if (!isset($_GET['category_number']) || !is_numeric($_GET['category_number']))
{
    exit(0);
}
else{
    $category_number = $_GET['category_number'];
}
require_once('../util/Db_Handler.php');
require_once('../classes/StockedItem.php');
$dbHandler = new DbHandler();
$item_rows = $dbHandler -> prepareQuery("select * from stock_item where category_number = ?", "d", array($category_number));

echo json_encode($item_rows);
