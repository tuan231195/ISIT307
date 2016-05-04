<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 10/04/2016
 * Time: 10:41 PM
 */

class Authorize_DAO extends Base_DAO
{
    public function match($studentid, $password)
    {
        $cnt = $this->dbHandler->prepareCountQuery("SELECT COUNT(*) FROM AUTHORIZE WHERE studentid = ? AND password = ?", "ss", array($studentid, md5($password)));
        return ($cnt == 1);
    }
}