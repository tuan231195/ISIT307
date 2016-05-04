<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 3/05/2016
 * Time: 11:20 PM
 */

require_once("../classes/StockedItem.php");
require_once("../classes/LineItem.php");
session_start();

if (!isset($_POST['item_number']) || !is_numeric($_POST['item_number']))
{
    exit(0);
}
$item_number = $_POST['item_number'];
require_once("../util/Db_Handler.php");

$dbHandler = new DbHandler();
$response = array();
if (!isset($_SESSION['cart']))
{
    $_SESSION['cart'] = array();
}


foreach ($_SESSION['cart'] as $item)
{
    if ($item->getStockedItem()->getItemNumber() == $item_number)
    {

        $response['code'] = 0;
        echo json_encode($response);
        exit(0);
    }
}

$row = $dbHandler->prepareQuery("SELECT * from stock_item WHERE item_number = ?", "d", array($item_number));
$stockItem = new StockedItem();
$stockItem->init($row[0]);
$lineItem = new LineItem();
$lineItem->setQuantity(1);
$lineItem->setStockedItem($stockItem);
$_SESSION['cart'][] = $lineItem;

$response['code'] = 1;
echo json_encode($response);
