<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 9/04/2016
 * Time: 11:13 PM
 */

class School_DAO extends Base_DAO
{
    public function getSchools()
    {
        $schools = $this->dbHandler ->executeQuery("SELECT * FROM SCHOOL");
        return $schools;
    }

    public function getSchoolsByKeywords($keyword)
    {
        $professor = $this ->dbHandler ->prepareQuery("SELECT  * FROM SCHOOL WHERE schoolname LIKE ?", "s", array("%$keyword%"));
        return $professor;
    }
}