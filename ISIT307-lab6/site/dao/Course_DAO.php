<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 10/04/2016
 * Time: 3:30 PM
 */

class Course_DAO extends Base_DAO
{
    public function getCourses()
    {
        $courses = $this->dbHandler ->executeQuery("SELECT * FROM COURSES");
        return $courses;
    }

    public function getCoursesFromDepartment($departmentname)
    {
        $courses = $this->dbHandler->prepareQuery("SELECT * FROM COURSES WHERE departmentname = ? ORDER BY departmentname, coursename", "s", array($departmentname));
        return $courses;
    }
    public function getNumClasses($coursename)
    {
        $classnum = $this->dbHandler->prepareCountQuery("SELECT COUNT(classcode) FROM CLASSES WHERE coursename = ?", "s", array($coursename));
        return $classnum;
    }
    public function getNumStudents($coursename)
    {
        $studentnum = $this->dbHandler->prepareCountQuery("SELECT COUNT(studentid) FROM (STUDENT NATURAL JOIN ENROLLED) WHERE classcode IN (SELECT classcode FROM CLASSES WHERE coursename = ?)", "s", array($coursename));
        return $studentnum;
    }
    public function getCoursesByKeywords($keyword)
    {
        $professor = $this ->dbHandler ->prepareQuery("SELECT  DISTINCT * FROM COURSES WHERE coursename LIKE ? or departmentname LIKE ?", "ss", array("%$keyword%",  "%$keyword%"));
        return $professor;
    }
}