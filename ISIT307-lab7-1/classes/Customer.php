<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 3/05/2016
 * Time: 8:06 PM
 */

class Customer
{
    private $customer_number;
    private $name;
    private $street;
    private $city;
    private $state;
    private $zipcode;
    private $phone;

    public function init($row)
    {
        $this->customer_number = $row['customer_number'];
        $this->name = $row['name'];
        $this->street = $row['street'];
        $this->city = $row['city'];
        $this->state = $row['state'];
        $this->zipcode = $row['zipcode'];
        $this->phone = $row['phone'];
    }

    /**
     * @return mixed
     */
    public function getCustomerNumber()
    {
        return $this->customer_number;
    }

    /**
     * @param mixed $customer_number
     */
    public function setCustomerNumber($customer_number)
    {
        $this->customer_number = $customer_number;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param mixed $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }


}