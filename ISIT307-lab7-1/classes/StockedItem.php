<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 3/05/2016
 * Time: 8:06 PM
 */

class StockedItem
{
    private $item_number;
    private $price;
    private $description;
    private $title;
    private $category_number;
    private $image;

    public function init($row)
    {
        $this->description = $row['description'];
        $this->price = $row['price'];
        $this->item_number = $row['item_number'];
        $this->title = $row['title'];
        $this->image = $row['img'];
        $this->category_number = $row['category_number'];
    }
    /**
     * @return mixed
     */
    public function getItemNumber()
    {
        return $this->item_number;
    }

    /**
     * @param mixed $item_number
     */
    public function setItemNumber($item_number)
    {
        $this->item_number = $item_number;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category_number;
    }

    /**
     * @param mixed $category_number
     */
    public function setCategory($category_number)
    {
        $this->category_number = $category_number;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

}

