<?php

class Classes_DAO extends Base_DAO
{
    public function getClasses($offset, $num, &$total)
    {
        $total = $this->dbHandler->executeCountQuery("SELECT COUNT(*) FROM CLASSES");
        $classes = $this->dbHandler ->executeQuery("SELECT * FROM CLASSES ORDER BY classcode LIMIT $offset, $num ");
        return $classes;
    }

    public function getClass($classcode)
    {
        $class = $this->dbHandler->prepareQuery("SELECT CLASSES.classname, COUNT(studentid) AS num_students FROM CLASSES LEFT OUTER JOIN ENROLLED ON CLASSES.classcode = ENROLLED.classcode WHERE CLASSES.classcode = ? GROUP BY CLASSES.classname", "s", array($classcode));
        return $class;
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

    public function enroll($studentid, $classcode, $classname)
    {
        $affected_rows = $this->dbHandler->insertQuery("INSERT INTO ENROLLED(studentid, classcode, classname) (SELECT ?, ?, ? FROM ENROLLED WHERE NOT EXISTS (SELECT 1 FROM ENROLLED WHERE studentid = ? AND classcode = ?) LIMIT 0,1)", "sssss", array($studentid, $classcode, $classname, $studentid, $classcode));
        return $affected_rows;
    }


    public function cancel($studentid, $classcode)
    {
        $affected_rows = $this ->dbHandler->deleteQuery("DELETE FROM ENROLLED WHERE classcode = ? AND studentid = ?", "ss", array($classcode, $studentid));
        return $affected_rows;
    }
}