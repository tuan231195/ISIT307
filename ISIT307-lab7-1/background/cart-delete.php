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

if (!isset($_SESSION['cart']))
{
    $_SESSION['cart'] = array();
}


$item_number = $_POST['item_number'];

foreach ($_SESSION['cart'] as $key => $item)
{
    if ($item->getStockedItem()->getItemNumber() == $item_number)
    {
        unset($_SESSION['cart'][$key]);
        $response['code'] = 1;
        echo json_encode($response);
        exit(0);
    }
}

$response['code'] = 0;
echo json_encode($response);
