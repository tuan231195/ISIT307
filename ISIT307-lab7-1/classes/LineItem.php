<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 3/05/2016
 * Time: 8:06 PM
 */

class LineItem{
    private $order_number;
    private $quantity;
    private $discount;
    private $stockedItem;


    public function init($row)
    {
        $this->order_number = $row['order_number'];
        $this->quantity = $row['quantity'];
        $this->discount = $row['discount'];
        $this->stockedItem = new StockedItem();
        $this->stockedItem->init($row);
    }
    /**
     * @return mixed
     */
    public function getOrderNumber()
    {
        return $this->order_number;
    }

    /**
     * @param mixed $order_number
     */
    public function setOrderNumber($order_number)
    {
        $this->order_number = $order_number;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param mixed $discount
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

    /**
     * @return mixed
     */
    public function getStockedItem()
    {
        return $this->stockedItem;
    }

    /**
     * @param mixed $stockedItem
     */
    public function setStockedItem($stockedItem)
    {
        $this->stockedItem = $stockedItem;
    }



}