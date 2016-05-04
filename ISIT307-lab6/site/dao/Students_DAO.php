<?php

class Students_DAO extends Base_DAO
{
    public function getStudents()
    {
        $students = $this->dbHandler->executeQuery("SELECT * FROM Student");
        return $students;
    }

    public function getStudentsTaughtByProfessor($professorId)
    {
        $students = $this->dbHandler->prepareQuery("SELECT DISTINCT STUDENT.* FROM (STUDENT NATURAL JOIN ENROLLED) WHERE classcode IN (SELECT classcode FROM CLASSES WHERE professorid = ?)", "s", array($professorId));
        return $students;
    }
}