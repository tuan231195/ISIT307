<?php
if (!defined('PATH_SYSTEM')) die ('Bad request!');

class Class_Controller extends Base_Controller
{
    private static $SUCCESS = 0;
    private static $EXISTS = 1;
    private static $NOT_EXISTS = 2;
    private static $FULL = 3;
    public function enrolledAction()
    {
        if (!isset($_SESSION))
        {
            session_start();
        }

        if (!isset($_SESSION['user']) || !isset($_POST['classcode']))
        {
            header("Location: index.php");
            exit(0);
        }
        $classDao = $this->dao->load("classes");
        $class = $classDao->getClass($_POST['classcode']);
        if (count($class)> 0 && array_key_exists("classname", $class[0]))
        {
            if ($class[0]['num_students'] >= 5){
                $returnJson = array("result" => self::$FULL);

            }
            else{
                $affectedRows = $classDao->enroll($_SESSION['user'],$_POST['classcode'], $class[0]['classname']);
                if ($affectedRows > 0)
                {
                    $returnJson = array("result" => self::$SUCCESS, "classcode" => $_POST['classcode'], "classname" => $class[0]['classname'], "num_students"=> ($class[0]['num_students'] + 1));
                }
                else{
                    $returnJson = array("result" => self::$EXISTS);
                }
            }
        }
        else{
            $returnJson = array("result" => self::$NOT_EXISTS);
        }
        echo json_encode($returnJson);
    }

    public function cancelAction(){
        if (!isset($_SESSION))
        {
            session_start();
        }

        if (!isset($_SESSION['user']) || !isset($_POST['classcode']))
        {
            header("Location: index.php");
            exit(0);
        }
        $classDao = $this->dao->load("classes");
        $affectedRows = $classDao->cancel($_SESSION['user'], $_POST['classcode']);
        if ($affectedRows > 0)
        {
            $returnJson = array("result" => self::$SUCCESS);
        }
        else{
            $returnJson = array("result" => self::$NOT_EXISTS);
        }
        echo json_encode($returnJson);

    }

}