<?php
class Error_Controller extends Base_Controller
{
    public function indexAction()
    {
        $this->dao->load("classes");

    }
}