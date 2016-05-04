<?php

class Classes_DAO extends Base_DAO
{
    public function getClasses($offset, $num, &$total)
    {
        $total = $this->dbHandler->executeCountQuery("SELECT COUNT(*) FROM CLASSES");
        $classes = $this->dbHandler ->executeQuery("SELECT * FROM CLASSES ORDER BY classcode LIMIT $offset, $num ");
        return $classes;
    }

    public function getClassesFromCourse($cousename, $offset, $num, &$total)
    {
        $total = $this->dbHandler->prepareCountQuery("SELECT COUNT(*) FROM CLASSES WHERE COURSENAME = ?", "s",  array($cousename));
        $classes = $this->dbHandler->prepareQuery("SELECT * FROM CLASSES WHERE COURSENAME = ? ORDER BY classcode LIMIT $offset, $num", "s", array($cousename));
        return $classes;
    }

    public function getClassesTaughtByProfessor($professorId)
    {
        $classes = $this ->dbHandler->prepareQuery("SELECT * FROM CLASSES WHERE professorid = ? ORDER BY classcode", "s", array($professorId));
        return $classes;
    }
    public function getClassesTakenByStudent($studentId)
    {
        $classes = $this ->dbHandler->prepareQuery("SELECT ClASSES.* FROM (CLASSES NATURAL JOIN ENROLLED) WHERE studentid = ?", "s", array($studentId));
        return $classes;
    }


    public function getNumStudents($classcode)
    {
        $studentnum = $this->dbHandler->prepareCountQuery("SELECT COUNT(STUDENT.studentid) FROM (STUDENT NATURAL JOIN ENROLLED) WHERE classcode = ?", "s", array($classcode));
        return $studentnum;
    }
}