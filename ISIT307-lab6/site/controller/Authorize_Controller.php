<?php if ( ! defined('PATH_SYSTEM')) die ('Bad request!');

class Authorize_Controller extends Base_Controller
{

    private $error_loc;
    private $curpage;
    private $success_loc;
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->curpage = $_GET['curPage'];
        $this->error_loc = "Location: index.php?a=". $this->curpage ."&login=true&error";
        $this->success_loc = "Location: index.php?a=". $this->curpage;

    }

    public function loginAction()
    {

        $authorizeDao = $this->dao->load("authorize");
        $studentid = $_POST['id'];
        $password = $_POST['password'];

        if (!preg_match('^[0-9]{7,}$', $studentid))
        {
            header($this->error_loc);
        }
        else if (strlen($password) < 8)
        {
            header($this->error_loc);
        }

        $match = $authorizeDao->match($studentid, $password);

        if (!$match)
        {
            header($this->error_loc);
        }
        else{
            if (!isset($_SESSION))
            {
                session_start();
            }
            $_SESSION['user'] = $studentid;
            header($this->success_loc);
        }
    }

    public function logoutAction()
    {

        session_destroy();
        header("Location: index.php");
    }

}