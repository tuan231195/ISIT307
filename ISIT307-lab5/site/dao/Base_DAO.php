<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 9/04/2016
 * Time: 11:30 PM
 */

class Base_DAO
{
    protected $dbHandler;
    public function __construct()
    {
        require_once(PATH_SYSTEM . "/core/Db_Handler.php");
        $this->dbHandler = new DBHandler();
        $this->dbHandler->connect();
    }

    public function __destruct()
    {
        $this->dbHandler -> close();
    }
}
