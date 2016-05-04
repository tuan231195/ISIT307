<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 3/05/2016
 * Time: 8:31 PM
 */

class Category
{
    private $category_number;
    private $description;
    private $title;


    public function init($row)
    {
        $this->category_number = $row['category_number'];
        $this->description = $row['description'];
        $this->title = $row['title'];
    }
    /**
     * @return mixed
     */
    public function getCategoryNumber()
    {
        return $this->category_number;
    }

    /**
     * @param mixed $category_number
     */
    public function setCategoryNumber($category_number)
    {
        $this->category_number = $category_number;
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


}