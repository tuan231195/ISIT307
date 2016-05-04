<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 10/04/2016
 * Time: 3:08 PM
 */

class Professor_DAO extends Base_DAO
{
    public function getProfessors($offset, $num, &$total)
    {
        $total = $this->dbHandler->executeCountQuery("SELECT COUNT(*) FROM PROFESSOR");
        $professors = $this->dbHandler ->executeQuery("SELECT * FROM PROFESSOR ORDER BY ProfessorId LIMIT $offset, $num");
        return $professors;
    }

    public function getProfessorsFromSchool($schoolname)
    {
        $professors = $this->dbHandler->prepareQuery("SELECT * FROM PROFESSOR WHERE SCHOOLNAME = ? ORDER BY ProfessorId, SCHOOLNAME", "s", array($schoolname));
        return $professors;
    }

    public function getProfessor($professorid)
    {
        $professor = $this ->dbHandler ->prepareQuery("SELECT * FROM PROFESSOR WHERE professorid = ?", "s", array($professorid));
        return $professor;
    }

    public function getProfessorByKeywords($keyword, $offset, $num, &$total)
    {
        $professor = $this ->dbHandler ->prepareQuery("SELECT SQL_CALC_FOUND_ROWS DISTINCT * FROM PROFESSOR WHERE professorid LIKE ? or fname LIKE ? or sname LIKE ? LIMIT $offset, $num", "sss", array("%$keyword%",  "%$keyword%" , "%$keyword%"));
        $total = $this->dbHandler->executeCountQuery("SELECT FOUND_ROWS()");
        return $professor;
    }
}