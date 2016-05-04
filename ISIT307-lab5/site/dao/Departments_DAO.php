<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 10/04/2016
 * Time: 10:07 AM
 */

class Departments_DAO extends Base_DAO
{
    public function getDepartments()
    {
        $departments = $this->dbHandler ->executeQuery("SELECT * FROM DEPARTMENT");
        return $departments;
    }

    public function getDepartmentsFromSchool($schoolname)
    {
        $departments = $this->dbHandler->prepareQuery("SELECT * FROM DEPARTMENT WHERE SCHOOLNAME = ? ORDER BY DEPARTMENTNAME, SCHOOLNAME", "s", array($schoolname));
        return $departments;
    }
}